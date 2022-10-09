<?php
session_start();
echo '<script>console.log("start");</script>';
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
echo '<script>console.log("start1");</script>';
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
echo '<script>console.log("start2");</script>';
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
                echo '<script>console.log("start3");</script>';
      move_uploaded_file($file_tmp,$fullpath.$file_name);
      echo '<script>console.log("'.$upload_file_result.'");</script>';
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
 $query_att_trans = "SELECT * FROM pim_attr_convert_option_lu " or die("Error:" . mysqli_error($con));
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
   
?>