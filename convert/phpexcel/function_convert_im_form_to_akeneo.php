<?php
session_start();
// include("../../../insert_log.php");
include("function_attribute.php");
include('Parsedown.php');
function readableBytes($bytes) {
  $i = floor(log($bytes) / log(1024));
  $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
  return sprintf('%.02F', $bytes / pow(1024, $i)) * 1 . ' ' . $sizes[$i];
}
function convert_BooleanText_to_Boolean($BooleanText){
  if(strtoupper($BooleanText)=="YES"){
    return TRUE;
  }elseif(strtoupper($BooleanText)=="NO"){
    return FALSE;
  }else{
    return $BooleanText;
  }
}
//start
$time_start = microtime(true);
// Record file to FTP
$request = "record";
$file_content_type =  "cleaned_description";
$fullpath = '../../../attachment/'.$_POST["job_number"].'/Cleaned/';
mkdir($fullpath, 0777, true);
$fullpath_normal = '../../../attachment/'.$_POST["job_number"].'/Cleaned/';
mkdir($fullpath, 0777, true);
$fullpath_normal_template = '../../../attachment/'.$_POST["job_number"].'/Template/';
mkdir($fullpath_normal_template, 0777, true);
// get varliable from input form
$parents = array();
$childs = array();
$shade_generate = array();
$job_number = $_POST["job_number"];
$launch_date  = $_POST["launch_date"];
$id = $_POST["id"];
$status_file = "Complete";
$nickname = $_SESSION["nickname"];
$skutype = $_POST["skutype"];
$bu_create = $_POST["bu_create"];
$ug_id = $_POST["ug_id"];
$g_year = $_POST["g_year"];
$g_month = $_POST["g_month"];
$g_running = $_POST["g_running"];
$allow_cod = $_POST["allow_cod"];
$allow_installment = $_POST["allow_installment"];
$parent_no_running = $skutype.$bu_create.$ug_id.$g_year.$g_month;
$check_loop = 0;
$header_get_categories_cds = "category_path_id_cds"; // system will get value [category] from this column in db
$header_get_categories_rbs = "category_path_id_rbs"; // system will get value [category] from this column in db
$sheet_name = $_POST["sheet_name"];
$bu_ticket = $_POST["bu"];
$shade_generate_code = array();
$shade_generate_en = array();
$shade_generate_th = array();
$shade_generate_hex_cod = array();
$use_markdown_engine = $_POST["use_markdown_engine"];
if($use_markdown_engine=="Yes"){
  $Parsedown = new Parsedown();
}
?>
<div class="container-fluid" style="margin:35px;margin-bottom:15px;">
<div class="row">
<?php echo "<p style='margin-left:15px'>Generate <strong style='color:#8e44ad'>PIM </strong> Template for <strong>".$job_number."</strong> id <strong>".$id."</strong></p>"; ?>
</div>
<div class="row">
<div class="col-6">
<?php
//setup connection
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$file_name =$_FILES['linesheet_akeneo_file']['name'];
$file_size =$_FILES['linesheet_akeneo_file']['size'];
$file_tmp  =$_FILES['linesheet_akeneo_file']['tmp_name'];
$file_type =$_FILES['linesheet_akeneo_file']['type'];
echo "<strong>Filename : </strong> ".$file_name."<br>";
echo "<strong>size : </strong>".readableBytes($file_size)."<br>";
echo "<strong>type : </strong>".$file_type."<br>";
//upload IM form to FTP
if($_POST["record_linesheet"]=="Yes"){
  $sql = "INSERT INTO file_manage (
    file_name,
    file_path,
    file_size,
    file_request,
    file_type,
    file_owner,
    upload_status,
    job_number,
    file_lastname)
    VALUES(
      '".$file_name."',
      '".$fullpath_normal."',
      '".$file_size."',
      '".$request."',
      '".$file_content_type."',
      '".$nickname."',
      '".$status_file."',
      '".$job_number."',
      '".$file_type."')";
      $query = mysqli_query($con,$sql);
      if($query) {
        $upload_file_result = 'Uploaded Cleaned File - Success Path : '.$fullpath.$file_name.'<br>';
      }else{
        $upload_file_result = $con->error;
      }
    }
    move_uploaded_file($file_tmp,$fullpath.$file_name);
    $tmpfname = $fullpath.$file_name;
    echo '<script>console.log("'.$tmpfname.'");</script>';
    //setting template --------
    $query = "SELECT * FROM pim_additional_setting_convert " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row= mysqli_fetch_array($result)) {
      if($row["additional_data"] == 'caution_cds'){
        $caution_cds_th = $row["label_th"];
        $caution_cds_en = $row["label_en"];
      }
      if($row["additional_data"] == 'location_code'){
        $location_code_en = $row["label_en"];
        $location_code_th = $row["label_th"];
      }
      if($row["additional_data"] == 'location_linesheet_code'){
        $location_ls_code_en = $row["label_en"];
        $location_ls_code_th = $row["label_th"];
      }
    }
    unset($row);
    unset($result);
    unset($query);
    // Read linesheet
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    //- Create template export file
    $export_workbook = new Spreadsheet();
    $export_workbook->getActiveSheet()->setTitle('Template');
    $query_att_trans = "SELECT * FROM pim_attr_convert_option_lu where review_status == 'Approved'  " or die("Error:" . mysqli_error($con));
    $result_att_trans = mysqli_query($con, $query_att_trans);
    $query = "SELECT * FROM pim_attribute_convert_im_form where is_create_first = 'Yes'" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $ep_sheet_row = 1;
    $ep_sheet_col = 1;
    //
    while($row= mysqli_fetch_array($result)) {
      //-@ check attibute is upload
      if($row["split_th_en"]=="Yes"){
        // count comma and split bu and insert column
        unset($bu);
        $bu = explode(",", $row["BU"]);
        if( $row["BU"] == "Main"){
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$row["pim_code"]."-".$location_code_en); //insert header
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"].$location_ls_code_en); //inser linesheet code next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //insert attribute translate next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
          $ep_sheet_col++;
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$row["pim_code"]."-".$location_code_th); //insert header
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"].$location_ls_code_th); //inser linesheet code next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //inser attribute translate next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
          $ep_sheet_col++;
        }else{
          foreach ($bu as $bu_value) {
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$row["pim_code"]."-".$location_code_en."-".$bu_value); //insert header
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"].$location_ls_code_en); //inser linesheet code next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //inser attribute translate next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
            $ep_sheet_col++;
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$row["pim_code"]."-".$location_code_th."-".$bu_value);  //insert header
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"].$location_ls_code_th); //inser linesheet code next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //inser attribute translate next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
            $ep_sheet_col++;
          }
        }
      }else{
        // count comma and split bu and insert column
        unset($bu);
        $bu = explode(",", $row["BU"]);
        if( $row["BU"] == "Main"){
          $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col ,1, $row["pim_code"]);
          $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"]); //inser linesheet code next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //inser attribute translate next row
          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
          $ep_sheet_col++;
        }else{
          foreach ($bu as $bu_value) {
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col ,1, $row["pim_code"]."-".$bu_value);
            $export_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,2,$row["linesheet_code"]); //inser linesheet code next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,3,$row["linesheet_type"]); //inser linesheet type next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,4,$row["lookup_value_en"]); //inser attribute translate next row
            $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,5,$row["split_th_en"]); //insert attribute setting split th en for attribute
            $ep_sheet_col++;
          }
        }
      }
    }
    echo '<script>console.log("Draf Template Success..");</script>';
    //-Read Linesheet ----------------------------------------
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tmpfname);
    echo '<script>console.log("Load '.$sheet_name.' Complete - IOFactory:tmpfname..");</script>';
    $ws_linesheet = $spreadsheet->getSheetByName($sheet_name); //อ่านขอมูจาก sheet แรก
    echo '<script>console.log("Getting '.$sheet_name.' ..");</script>';
    $form_version = $ws_linesheet->getCell("B2")->getValue();
    $lastRowImform = $ws_linesheet->getHighestRow();
    $lastColumnImform  = $ws_linesheet->getHighestColumn();
    $lastColumnIndexImform = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($lastColumnImform);
    //-check row header im form
    for ($row = 1; $row <= $lastRowImform; $row++)
    {
      $target_row = $ws_linesheet->getCellByColumnAndRow(1, $row)->getValue(); // loop หา row ทีมีคำ่า item ใน column แก
      if($target_row=="No"){
        $header_row = $row;
        break;
      }
    }
    for ($row = 0; $row <= $lastRowImform; $row++)
    {
      $target_row = $ws_linesheet->getCellByColumnAndRow(1, $row)->getValue(); // loop หา row ทีมีคำ่า item ใน column แก
      if($target_row=="item"){
        $im_form_code_row = $row;
        break;
      }
    }
    unset($target_row);
    unset($row);
    //-set Im form spacific column IM form
    for ($column = 1; $column <= $lastColumnIndexImform; $column++)
    {
      $target_column = $ws_linesheet->getCellByColumnAndRow($column, $im_form_code_row)->getValue();
      $target_column = trim($target_column ," ");
      //  global ${"IMFORM_column_number_$target_column"};
      ${"IMFORM_column_number_$target_column"} = $column;
      if($target_column==""){
        $lastColumnIndexImform = $column-1;
        break;
      }
    }
    //debug  funciton name - individul transfer 22.1 to 22.2
    if( $form_version=="New omni linesheet Version ONE 22.1"){
      //clone
      $IMFORM_column_number_product_name_en_clone= $IMFORM_column_number_product_name_th;
      $IMFORM_column_number_product_name_th_clone= $IMFORM_column_number_product_name_en;
      $IMFORM_column_number_product_detail_en_clone= $IMFORM_column_number_product_detail_th;
      $IMFORM_column_number_product_detail_th_clone= $IMFORM_column_number_product_detail_en;
      //past clone
      $IMFORM_column_number_product_name_en= $IMFORM_column_number_product_name_en_clone;
      $IMFORM_column_number_product_name_th= $IMFORM_column_number_product_name_th_clone;
      $IMFORM_column_number_product_detail_en= $IMFORM_column_number_product_detail_en_clone;
      $IMFORM_column_number_product_detail_th= $IMFORM_column_number_product_detail_th_clone;
      $IMFORM_column_number_group_name= $IMFORM_column_number_product_name_en_clone;
    }
    //END -debug  funciton name - individul transfer 22.1 to 22.2
    unset($target_column);
    unset($column);
    // - lookup linesheet to template
    echo '</div><div class="col-6">';
    echo '<script>console.log("header Row : '.$header_row.'");</script>';
    //- set last row IM form
    $ws_template = $export_workbook->getSheetByName('Template');
    $lastRow_template =   $ws_template->getHighestRow();
    $lastColumn_template  =   $ws_template->getHighestColumn();
    $lastColumnIndex_template = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($lastColumn_template);
    echo '<script>console.log("Last row sheet / data : '.$lastRowImform.'/'.$lastRow_template.'");</script>';
    echo '<script>console.log("Last column im form : '.$lastColumnIndexImform.'");</script>';
    // - set one selection value
    $store_stock = $ws_linesheet->getCell("CP6")->getValue();
    //-set Im form spacific column Template
    for($col_template = 1; $col_template  <=  $lastColumnIndex_template  ; $col_template++){
      $column_header_template_pim_code = $ws_template->getCellByColumnAndRow($col_template, 1)->getValue(); // read linesheet code from template
      $column_header_template = $ws_template->getCellByColumnAndRow($col_template, 2)->getValue(); // read linesheet code from template
      $column_header_template_ls_type = $ws_template->getCellByColumnAndRow($col_template, 3)->getValue(); // read linesheet type from template
      $column_header_template_att_trans = $ws_template->getCellByColumnAndRow($col_template, 4)->getValue(); // read linesheet dropdown lookup translate
      $column_header_template_split_trans = $ws_template->getCellByColumnAndRow($col_template, 5)->getValue(); // read linesheet split_trans header
      ${"TEMPLATE_column_number_$column_header_template_pim_code"} = $col_template;
      // @ - enrich date
      // - array type
      if($column_header_template_ls_type=="array"){
        // loop row im form
        for ($column_ls = 1; $column_ls <= $lastColumnIndexImform+1; $column_ls++)
        {
          $column_header_linesheet = $ws_linesheet->getCellByColumnAndRow($column_ls,  $im_form_code_row)->getValue();
          if($column_header_linesheet <> "" and $column_header_template <> ""){
            $column_header_template_replace_location = str_replace($location_ls_code_en,"",$column_header_template);
            $column_header_template_replace_location = str_replace($location_ls_code_th,"",$column_header_template_replace_location);
            if($column_header_linesheet == $column_header_template or $column_header_linesheet == $column_header_template_replace_location){
              //loop row template in loop IM form
              for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template;$row_template++){
                $row_get_ls = $header_row+$row_template-$lastRow_template;
                $target_cell = $ws_linesheet->getCellByColumnAndRow($column_ls, $row_get_ls)->getValue();
                if($target_cell<>null and substr( $target_cell, 0, 1 ) <> "="){
                  //special condition - gender
                  if($column_header_linesheet=="gender_value"){
                    $target_cell = convert_gender();
                  }
                  //debug  funciton name - individul transfer 22.1 to 22.2
                  if( $form_version=="New omni linesheet Version ONE 22.1"){
                    if($column_header_linesheet=="product_name_en"){
                      $target_cell = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_en, $row_get_ls)->getValue();
                    }
                  }
                  //end
                  if($column_header_template_att_trans=="Yes"){ //lookup th > en value
                    $query_att_trans = "SELECT * FROM pim_attr_convert_option_lu where linesheet_code = '".$column_header_template."' or linesheet_code = '".$column_header_template_replace_location."'" or die("Error:" . mysqli_error($con));
                    $result_att_trans = mysqli_query($con, $query_att_trans);
                    while($row_att_trans= mysqli_fetch_array($result_att_trans)) {
                      if($row_att_trans["option_th"]==$target_cell ){
                        $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,convert_BooleanText_to_Boolean($row_att_trans["option_code"]));
                      }
                    }
                  }elseif($column_header_template_split_trans=="Yes"){ //split th en
                    $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,convert_BooleanText_to_Boolean($target_cell));
                  }else{
                    $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,convert_BooleanText_to_Boolean($target_cell));
                  }
                }
              } // end loop row template
            }
          }
        }
      }
      if($column_header_template_ls_type=="range"){
        for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template;$row_template++){
          $target_cell = $ws_linesheet->getCell($column_header_template)->getValue();
          if($target_cell<>null and substr( $target_cell, 0, 1 ) <> "="){
            $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,convert_BooleanText_to_Boolean($target_cell));
          }
        }
      }
      if($column_header_template_ls_type=="convert_setting"){
        for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template;$row_template++){
          $target_cell = $_POST[$column_header_template];
          if($target_cell<>null and substr( $target_cell, 0, 1 ) <> "="){
            $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,$target_cell);
          }
        }
      }
      if($column_header_template_ls_type=="function"){
        for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template;$row_template++){
          $row_get_ls = $header_row+$row_template-$lastRow_template;
          $column_header_template = $ws_template->getCellByColumnAndRow($col_template, 2)->getValue();
          $target_value = call_user_func($column_header_template);
          $export_workbook ->getActiveSheet()->setCellValueByColumnAndRow($col_template,$row_template,$target_value);
        }
      }
    }
    unset($col_template);
    // create parent tempalte ---------------
    if(!empty($parents)){
      $export_modal_workbook = new Spreadsheet();
      $export_modal_workbook->getActiveSheet()->setTitle('modal_template');
      $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow(1,1,"parent");
      $query = "SELECT * FROM pim_attribute_convert_im_form where grouping_column = 'common' and is_create_first='Yes'" or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      $col_parent = 2;
      $ep_sheet_col = 2;
      while($col= mysqli_fetch_array($result)) {
        if($col["split_th_en"]=="Yes"){
          unset($bu);
          $bu = explode(",", $col["BU"]);
          if( $col["BU"] == "Main"){
            $export_modal_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$col["pim_code"]."-".$location_code_en); //insert header
            $ep_sheet_col++;
            $export_modal_workbook-> getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$col["pim_code"]."-".$location_code_th); //insert header
            $ep_sheet_col++;
          }else{
            foreach ($bu as $bu_value) {
              $check_loop++;
              $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$col["pim_code"]."-".$location_code_en."-".$bu_value); //insert header
              $ep_sheet_col++;
              $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col,1,$col["pim_code"]."-".$location_code_th."-".$bu_value);  //insert header
              $ep_sheet_col++;
            }
          }
        }else{
          unset($bu);
          $bu = explode(",", $col["BU"]);
          if( $col["BU"] == "Main"){
            $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col ,1, $col["pim_code"]);
            $ep_sheet_col++;
          }else{
            foreach ($bu as $bu_value) {
              $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow($ep_sheet_col ,1, $col["pim_code"]."-".$bu_value);
              $ep_sheet_col++;
            }
          }
        }
        $col_modal++;
      }
      $row_parent=2;
      $ws_template_modal = $export_modal_workbook->getSheetByName('modal_template');
      $lastRow_template_modal =   $ws_template_modal->getHighestRow();
      $lastColumn_template_modal  =   $ws_template_modal->getHighestColumn();
      $lastColumnIndex_template_modal = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($lastColumn_template_modal);
      foreach($parents as $parent){
        $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow(1,$row_parent,$parent);
        for($col_modal_template = 1; $col_modal_template  <=  $lastColumnIndex_template_modal; $col_modal_template++)
        {
          $col_name_child_template = $ws_template_modal->getCellByColumnAndRow($col_modal_template , 1)->getValue();
          $col_name_child_template_pim_code = str_replace("-CDS","",$col_name_child_template);
          $col_name_child_template_pim_code = str_replace("-en_US","_en",$col_name_child_template_pim_code);
          $col_name_child_template_pim_code = str_replace("-th_TH","_th",$col_name_child_template_pim_code);
          for($row_child_template = 2; $row_child_template  <=  $lastColumnIndex_template; $row_child_template++)
          {
            $parent_sku_template = $ws_template->getCellByColumnAndRow($TEMPLATE_column_number_parent, $row_child_template)->getValue();
            if($parent_sku_template == $parent){
              $value = $ws_template->getCellByColumnAndRow( ${"TEMPLATE_column_number_$col_name_child_template"}, $row_child_template)->getValue();
              $col_modal_name = $ws_template_modal->getCellByColumnAndRow($col_modal_template, 1)->getValue();
              if(strpos($col_modal_name,"visibility")!==false){
                $value = "Catalog__Search";
              }
              if(strpos($col_modal_name,"name-th_TH")!==false){
                $value = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_th, $header_row+$row_child_template-$lastRow_template)->getValue(); // hard code
              }
              if(strpos($col_modal_name,"name-en_US")!==false){
                $value = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_en, $header_row+$row_child_template-$lastRow_template)->getValue(); // hard code
              }
              if(strpos($col_modal_name,"family_variant")!==false){
                $value = $ws_template->getCellByColumnAndRow(${"TEMPLATE_column_number_$col_name_child_template"},$row_child_template )->getValue();
                if($value=="size"){
                  $value = "size_default";
                }elseif($value=="color"){
                  $value = "shade_default";
                }elseif($value=="sizecolor"){
                  $value = "shade_size_default";
                }elseif($value=="volume"){
                  $value = "size_default";
                }elseif($value=="capacity"){
                  $value = "size_default";
                }elseif($value=="bedsize"){
                  $value = "size_default";
                }elseif($value=="colorluggagesize"){
                  $value = "shade_size_default";
                }
              }
              $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow($col_modal_template,$row_parent, $value );
            }
          }
        }
        $row_parent++;
      }
      $export_modal_workbook->getActiveSheet()->setCellValueByColumnAndRow(1,1, "code" );
      // add column common need to remove to array
      $col_remove = array();
      $query = "SELECT * FROM pim_attribute_convert where grouping_column = 'common' and is_create_first='Yes'" or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($col_n= mysqli_fetch_array($result)) {
        array_push($col_remove,$col_n["pim_code"]);
        array_push($col_remove,$col_n["pim_code"]."-CDS");
        array_push($col_remove,$col_n["pim_code"]."-RBS");
        array_push($col_remove,$col_n["pim_code"]."-th_TH");
        array_push($col_remove,$col_n["pim_code"]."-th_TH-CDS");
        array_push($col_remove,$col_n["pim_code"]."-th_TH-RBS");
        array_push($col_remove,$col_n["pim_code"]."-en_US");
        array_push($col_remove,$col_n["pim_code"]."-en_US-CDS");
        array_push($col_remove,$col_n["pim_code"]."-en_US-RBS");
      }
    }
    // remove $col_remove col child template
    if($_POST["replace_emptry_data"]=="Yes"){
      // remove column family various DT-5649
      $export_workbook ->getActiveSheet()->removeColumnByIndex($TEMPLATE_column_number_family_variant);
      //check parent sku for all sku
      for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template+1;$row_template++){
        $parent_sku_template = $ws_template->getCellByColumnAndRow($TEMPLATE_column_number_parent, $row_template)->getValue();
        $first_column = $ws_template->getCellByColumnAndRow(1, $row_template)->getValue() ;
        if($parent_sku_template=="" and $first_column <>"" ){
          $break_remove_parent = TRUE;
        }
      }
      if($break_remove_parent<>TRUE){
        for($col_template = $lastColumnIndex_template ; $col_template >1 ; $col_template--){
          $header = $ws_template->getCellByColumnAndRow($col_template, 1)->getValue();
          if(in_array($header,$col_remove) and !empty($parents) and $header <> "manual_grouping"){
            $export_workbook ->getActiveSheet()->removeColumnByIndex($col_template);
          }
        }
      }
    }
    // remove blank col child template
    if($_POST["replace_emptry_data"]=="Yes"){
      for($col_template = $lastColumnIndex_template ; $col_template >1 ; $col_template--){
        for($row_template = $lastRow_template+1; $row_template <= $lastRowImform-$header_row+$lastRow_template+1;$row_template++){
          $target_row = $ws_template->getCellByColumnAndRow($col_template, $row_template)->getValue();
          if($target_row<>""){
            break;
          }
          if($row_template == $lastRowImform-$header_row+$lastRow_template+1){
            $export_workbook ->getActiveSheet()->removeColumnByIndex($col_template);
          }
        }
      }
    }
    // remove blank col model template
    if($_POST["replace_emptry_data"]=="Yes"){
      for($col_template = $lastColumnIndex_template_modal ; $col_template >1 ; $col_template--){
        for($row_template = 2; $row_template <= $lastRow_template_modal+1 ;$row_template++){
          $target_row = $ws_template_modal->getCellByColumnAndRow($col_template, $row_template)->getValue();
          if($target_row<>""){
            break;
          }
          if($row_template == $lastRow_template_modal+1){
            $export_modal_workbook ->getActiveSheet()->removeColumnByIndex($col_template);
          }
        }
      }
    }
    // shade template generate
    $export_shade_wb= new Spreadsheet();
    $export_shade_wb->getActiveSheet()->setTitle('shade_template');
    $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(1,1,"attribute");
    $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(2,1,"code");
    $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(3,1,"label-en_US");
    $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(4,1,"label-th_TH");
    for($shade_template_row = 2; $shade_template_row  <=  count($shade_generate_code ); $shade_template_row++)
    {
      $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(1,$shade_template_row,"color_shade");
      $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(2,$shade_template_row,strtolower($shade_generate_code[$shade_template_row-1]));
      $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(3,$shade_template_row,$shade_generate_en[$shade_template_row-1]);
      $export_shade_wb->getActiveSheet()->setCellValueByColumnAndRow(4,$shade_template_row,$shade_generate_th[$shade_template_row-1]);
    }
    //remove setting row before export
    if($_POST["replace_setting_data"]=="Yes"){
      $i = $lastRow_template;
      while($i > 1 ){
        $export_workbook ->getActiveSheet()->removeRow($i);
        $i--;
      }
    }
    //create un-group file
    $export_ungroup_workbook = new Spreadsheet();
    $export_ungroup_workbook->getActiveSheet()->setTitle('ungroup_template');
    $export_ungroup_workbook->getActiveSheet()->setCellValueByColumnAndRow(1,1,"sku");
    $export_ungroup_workbook->getActiveSheet()->setCellValueByColumnAndRow(2,1,"parent");
    $export_ungroup_workbook->getActiveSheet()->setCellValueByColumnAndRow(3,1,"manual_grouping");
    for($row_child_template = 2; $row_child_template  <=  $lastRowImform; $row_child_template++)
    {
      $child_sku_template = $ws_template->getCellByColumnAndRow(1, $row_child_template)->getValue();
      if($child_sku_template<>""){
        $export_ungroup_workbook->getActiveSheet()->setCellValueByColumnAndRow(1,$row_child_template,$child_sku_template);
        $export_ungroup_workbook->getActiveSheet()->setCellValueByColumnAndRow(3,$row_child_template,1);
      }
    }
    //export function ---------------------------------------------------
    //export child template
    $path_parts = pathinfo($fullpath.$file_name);
    $file_name_without_type = $path_parts['filename'];
    $file_name_without_type = str_replace(".xlsm","",$file_name_without_type);
    $file_name_without_type = str_replace(".xlsb","",$file_name_without_type);
    $file_name_without_type = str_replace(".xlsx","",$file_name_without_type);
    $file_name_without_type = str_replace("Cleaned_Description","Template",$file_name_without_type);
    $file_name_without_type = str_replace("Cleaned","Template",$file_name_without_type);
    $file_name_without_type = str_replace("Clean","Template",$file_name_without_type);
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_workbook);
    $writer->save('../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type.".xlsx");
    //export model template
    if(!empty($parents)){
      $path_parts_modal = pathinfo($fullpath.$file_name);
      $file_name_without_type_modal = $path_parts_modal['filename'];
      $file_name_without_type_modal = str_replace(".xlsm","",$file_name_without_type_modal);
      $file_name_without_type_modal = str_replace(".xlsb","",$file_name_without_type_modal);
      $file_name_without_type_modal = str_replace(".xlsx","",$file_name_without_type_modal);
      $file_name_without_type_modal = str_replace("Cleaned_Description","Modal",$file_name_without_type_modal);
      $file_name_without_type_modal = str_replace("Cleaned","Modal",$file_name_without_type_modal);
      $file_name_without_type_modal = str_replace("Clean","Modal",$file_name_without_type_modal);
      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_modal_workbook);
      $writer->save('../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_modal.".xlsx");
    }
    //export shade template
    $path_parts_shade = pathinfo($fullpath.$file_name);
    $file_name_without_type_shade = $path_parts_shade['filename'];
    $file_name_without_type_shade = str_replace(".xlsm","",$file_name_without_type_shade);
    $file_name_without_type_shade = str_replace(".xlsb","",$file_name_without_type_shade);
    $file_name_without_type_shade = str_replace(".xlsx","",$file_name_without_type_shade);
    $file_name_without_type_shade = str_replace("Cleaned_Description","Shade",$file_name_without_type_shade);
    $file_name_without_type_shade = str_replace("Cleaned","Shade",$file_name_without_type_shade);
    $file_name_without_type_shade = str_replace("Clean","Shade",$file_name_without_type_shade);
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_shade_wb);
    $writer->save('../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_shade.".xlsx");
    //export ungroup template
    $path_parts_ug = pathinfo($fullpath.$file_name);
    $file_name_without_type_ug = $path_parts_ug['filename'];
    $file_name_without_type_ug = str_replace(".xlsm","",$file_name_without_type_ug);
    $file_name_without_type_ug = str_replace(".xlsb","",$file_name_without_type_ug);
    $file_name_without_type_ug = str_replace(".xlsx","",$file_name_without_type_ug);
    $file_name_without_type_ug = str_replace("Cleaned_Description","Ungroup",$file_name_without_type_ug);
    $file_name_without_type_ug = str_replace("Cleaned","Ungroup",$file_name_without_type_ug);
    $file_name_without_type_ug = str_replace("Clean","Ungroup",$file_name_without_type_ug);
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_ungroup_workbook);
    $writer->save('../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_ug.".xlsx");
    //Time End Stamp
    $time_end = microtime(true);
    $execution_time = ($time_end - $time_start)/60;
    $execution_time_s = ($time_end - $time_start);
    //preview interface ---------------------
    echo '<b>Total Execution Time (Mins) : </b> '.number_format($execution_time, 2, '.', ' ').' Mins<br>';
    echo '<b>Total Execution Time (Second) : </b> '.number_format($execution_time_s, 2, '.', ' ').' Second<br>';
    echo '</div>
    </div>
    <hr style="margin:5px">
    </div>';
    echo '<strong style="margin-left:50px;"><a href="../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type.'.xlsx" class="btn btn-primary btn-sm"  style="margin-bottom:15px" > <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Child Template</a></strong>';
    echo '<strong style="margin-left:5px;"><a href="../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_ug.'.xlsx" class="btn btn-danger btn-sm"  style="margin-bottom:15px;background:#1b528e;border-color:#1b528e;" > <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Ungroup Template</a></strong>';
    if(!empty($parents)){
      echo '<strong style="margin-left:5px;"><a href="../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_modal.'.xlsx" class="btn btn-secondary btn-sm"  style="margin-bottom:15px;background:#32673e;border-color:#32673e;" > <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Parents Template</a></strong>';
    }
    echo '<strong style="margin-left:5px;"><a href="../../../attachment/'.$_POST["job_number"].'/Template/'.$file_name_without_type_shade.'.xlsx" class="btn btn-info btn-sm"  style="margin-bottom:15px;background:#060e17;border-color:#060e17;" > <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Shade Template</a></strong>';
    //remove file linesheet from ftp
    if($_POST["record_linesheet"]=="No"){
      $ftp_server = "localhost";
      $ftp_conn = ftp_connect($ftp_server) or die("Remove linesheet - Could not connect to $ftp_server");
      $login = ftp_login($ftp_conn, 'admin_convert_module', 'a417528639');
      ftp_delete($ftp_conn,$fullpath.$file_name);
      unset($ftp_server);
      unset($ftp_conn);
      unset($login);
    }
    //remove file linesheet from ftp
    if($_POST["record_template"]=="No"){
      $ftp_server = "localhost";
      $ftp_conn = ftp_connect($ftp_server) or die("Remove template Could not connect to $ftp_server");
      $login = ftp_login($ftp_conn, 'admin_convert_module', 'a417528639');
      ftp_delete($ftp_conn,"../../../attachment/".$_POST["job_number"]."/Template/".$file_name_without_type.'.xlsx');
      unset($ftp_server);
      unset($ftp_conn);
      unset($login);
    }
    mysqli_close($con);
    unset($data_template_pv_cds);
    unset($shade_generate);
    unset($header_template_pv_rbs);
    unset($file_name_without_type);
    unset($data_template_pv_cds);
    unset($data_template_pv_rbs);
    unset($data_template_cds);
    unset($data_template_rbs);
    unset($set_include);
    unset($set_include_html);
    unset($check_loop);
    unset($break_column_check);
    unset($array_col_target_ls_number);
    unset($array_col_target_ls_text);
    unset($time_end);
    unset($execution_time);
    unset($execution_time_s);
    unset($execution_time_ms);
    unset($current_value_template_en_cds);
    unset($current_value_template_th_rbs);
    unset($current_value_template_en_cds);
    unset($current_value_template_th_rbs);
    unset($target_cell);
    //grouping
    //todo $count_group
    ?>