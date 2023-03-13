

<?php
echo "<script>console.log('gettingfile')</script>";
// include("../../insert_log.php");
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//- Create export fiel

session_start();
if($_SESSION["nickname"]<>""){
  $nickname = $_SESSION["nickname"];
}else{
  $nickname = "Bos";
}
$time_start = microtime(true);
$fullpath_linesheet = '../../../attachment/datapump/'.date("Y-m-d").'/linesheet/';
$fullpath_template = '../../../attachment/datapump/'.date("Y-m-d").'/template/';
$fullpath_backup = '../../../attachment/datapump/'.date("Y-m-d").'/backup/';
mkdir($fullpath_linesheet, 0777, true);
mkdir($fullpath_template, 0777, true);
mkdir($fullpath_backup, 0777, true);
echo "<script>console.log('create a directory done')</script>";
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
$array_file_string = $_POST["multiselectfile"];
echo "<script>console.log('files : ".$array_file_string ."')</script>";
$array_file = explode(",",$array_file_string);
$array_file_loop = $array_file ;
$array_file_csv = array();
//get zip
foreach ($array_file as $file) {
    $file_name = substr($file,37);
    array_push($array_file_csv,'../attachment/datapump/'.date("Y-m-d").'/template/'.str_replace('xlsm','csv',$file_name ));
}
$tmpfname_csv_string =  implode(",",$array_file_csv);
echo 'Convert complete : '.$num_count.' files';
// echo 'Generate new zip for datapump already <a href="../../../attachment/datapump/datapump">download here !</a>';
// echo '<span ><a target="_blank" href="download_zip_files.php?files='.$tmpfname_csv_string .'" class="btn btn-warning btn-sm"  style="margin-top:10px;"  > <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download for_pump_'.date("Y-m-d-hhmm").'.zip</a></span>';
echo '<div class="accordion" id="accordionExample">';
$num_count = 1;
foreach ($array_file_loop  as $filebuyer) {
$export_workbook = new Spreadsheet();
$export_workbook->getActiveSheet()->setTitle('Datapump');
$export_workbook_backup = new Spreadsheet();
$export_workbook_backup->getActiveSheet()->setTitle('Datapump_Backup');
    echo "<script>console.log('file ".$num_count." : ".$filebuyer."')</script>";
    $tmpfname = "../../".$filebuyer;
    $file_name = substr($filebuyer,37);
    convert_datapump();
    $num_count ++;
}
// $array_file_csv_string = implode(",",$array_file_csv)
// joinFiles($array_file_csv, '../../../attachment/datapump/'.date("Y-m-d").'/merge/datapump_merge.csv');
function convert_datapump(){
    $time_start = microtime(true);
    global $nickname;
    global $tmpfname;
    global $con;
    global $file_name;
    global $file_type_gen;
    global $spreadsheet;
    global $export_workbook;
    global $export_workbook_backup;
    global $fullpath_template;

$query = "SELECT * FROM u749625779_cdscontent.job_cms where job_number = '".substr($file_name,0,12)."' ORDER BY id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
  $id_24 = $row["id"];
  $job_number_24 = $row["job_number"];
  $brand_24 = $row["brand"];
  $department_24 = $row["sub_department"];
  $store_stock_24 = $row["store"];
  $website_24 = $row["product_website"];
  $bu_24 = $row["bu"];
  $sku_24 = $row["sku"];
  $csg_request_new_id = $row["csg_request_new_id"];
}
$website_24 = str_replace(", ",",",$website_24);
$query = "SELECT * FROM all_in_one_project.add_new_job where id = ".$csg_request_new_id." ORDER BY id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
  $id_csg = $row["id"];
  $brand_csg = $row["brand"];
  $store_stock_csg = $row["stock_source"];
  $website_csg = $row["online_channel"];
  $bu_csg = $row["bu"];
  $sku_csg = $row["sku"];
}
//-------------------------------------------------------------------------------
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tmpfname);
$ws_linesheet = $spreadsheet->getSheet(0);
$lastRow_ls = $ws_linesheet->getHighestRow();
$lastColumn_ls  = $ws_linesheet->getHighestColumn();
$lastColumnIndex_ls = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($lastColumn_ls);
$LastColumnData_ls  =  $lastColumnIndex_ls;
//-check row header
for ($row = 1; $row <= $lastRow_ls; $row++)
{
 $target_row = $ws_linesheet->getCellByColumnAndRow(1, $row)->getValue(); // loop หา row ทีมีคำ่า item ใน column แก
 if($target_row=="No" or $target_row=="No." ){
   $header_row = $row;
   break;
 }
}
for ($row = 1; $row <= $lastRow_ls; $row++)
{
 $target_row = $ws_linesheet->getCellByColumnAndRow(1, $row)->getValue(); // loop หา row ทีมีคำ่า item ใน column แก
 if($target_row=="item"){
   $item_row = $row;
   break;
 }
}
unset($target_row);
unset($row);
//get column number from linesheet
$channel = $website_csg;
$bu = $bu_24;
$store_stock = $store_stock_24;
$brand = $brand_24;
for($col_linesheet = 1; $col_linesheet  <=  $LastColumnData_ls  ; $col_linesheet++){
    $column_header_linesheet = $ws_linesheet->getCellByColumnAndRow($col_linesheet, $item_row)->getValue(); // read linesheet code from template
    ${"column_ls_$column_header_linesheet"} = $col_linesheet;
  }
  //last_row_ls
  for($row = $header_row+1; $row  <=  $lastRow_ls  ; $row++){
    $target_row = $ws_linesheet->getCellByColumnAndRow($column_ls_ibc, $row)->getValue();
    if($target_row=="" ){
      $lastRow_ls = $row-1;
      break;
    }
  }
  unset($col_linesheet);
// -create template
      //------------------
         $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
         mysqli_query($con, "SET NAMES 'utf8' ");
         //- Insert column
         $columns_name = array("Channel","BU","IBC","SBC","StoreStock","StorePrice","ProductType");
         $columns_name_backup = array("Channel","BU","IBC","SBC","StoreStock","StorePrice","ProductType","SKU MDC","job_number","Dept Name","Brand","SKU-JDA");
         //- append store array
         $store_stock = $ws_linesheet->getCell("CR6")->getValue();
         if($store_stock ==""){
         $store_stock = $ws_linesheet->getCell("B10")->getValue();
         }
         $stores_arr = explode(",",$store_stock);
         $channel = str_replace("COL","CDS",$channel);
         $channel = str_replace("ROL","RBS",$channel);
         $channel = str_replace(" and ",",",$channel);
         $channel_arr = explode(",",$channel );
         $lastRow_tm = 0;
        //  foreach ($channel_arr as $channel) {
         foreach ($stores_arr as $store) {
          $query = "SELECT * FROM u749625779_cdscontent.datapump_store_mapping where store_code = '".substr(trim($store," "),0,5)."' ORDER BY id DESC" or die("Error:" . mysqli_error($con));
          $result = mysqli_query($con, $query);
          while($row = mysqli_fetch_array($result)) {
            $store_code = $row["store_code"];
            $store_price = $row["store_price"];
            $channel_map = $row["channel"];
            $bu_map = $row["bu"];
          }
              $lastRow_tm = $lastRow_tm+$row_linesheet-$header_row-1;
              if($lastRow_tm<=0){$lastRow_tm=0;}
              $col_number=1;
              unset($tabel_row_header);
              foreach ($columns_name_backup as $col_name) {
                if(in_array($col_name,$columns_name)){
                    $tabel_row_header .="<th>".$col_name."</th>";
                    $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,1,$col_name); //set column name
                }
                $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,1,$col_name); //set column name
                for($row_linesheet = $header_row+1; $row_linesheet  <=  $lastRow_ls  ; $row_linesheet++){
                  if($col_name=="Channel"){
                          $get_ls_value = $channel_map;
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="BU"){
                          $get_ls_value = $bu_map;
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="IBC"){
                          $get_ls_value = $ws_linesheet->getCellByColumnAndRow($column_ls_ibc, $row_linesheet)->getValue();
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="SBC"){
                          $get_ls_value = $ws_linesheet->getCellByColumnAndRow($column_ls_barcode_sbc, $row_linesheet)->getValue();
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="StoreStock"){
                        $get_ls_value = $store_code;
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="StorePrice"){
                          $get_ls_value = $store_price;
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="ProductType"){
                          $get_ls_value = "N";
                          $export_workbook-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                          $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="SKU MDC"){
                        $get_ls_value = $ws_linesheet->getCellByColumnAndRow($column_ls_ibc, $row_linesheet)->getValue();
                        $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$bu.$get_ls_value);
                      }elseif($col_name=="job_number"){
                        $get_ls_value = substr($file_name,0,12);
                        $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="Dept Name"){
                        $get_ls_value = $department_24;
                        $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="Brand"){
                        $get_ls_value = $brand_24;
                        $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }elseif($col_name=="SKU-JDA"){
                        $get_ls_value = $ws_linesheet->getCellByColumnAndRow($column_ls_sku, $row_linesheet)->getValue();
                        $export_workbook_backup-> getActiveSheet()->setCellValueByColumnAndRow($col_number,$lastRow_tm+$row_linesheet-$header_row+1,$get_ls_value);
                      }
                }
                  $col_number++;
              }
              unset($get_ls_value);
              unset($store);
              unset($store_code);
         }
         //--export
        //end model grouping file
          $path_parts = pathinfo($fullpath_template.$file_name);
          $file_name_without_type = $path_parts['filename'];
          $file_name_without_type = str_replace(".xlsm","",$file_name_without_type);
          $file_name_without_type = str_replace(".xlsx","",$file_name_without_type);
          $file_name_without_type = str_replace("Cleaned_Description","Datapump",$file_name_without_type);
          $file_name_without_type = str_replace("Cleaned","Datapump",$file_name_without_type);
          $file_name_without_type = str_replace("Clean","Datapump",$file_name_without_type);
          // if($_POST["file_type_gen"] == "csv"){
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($export_workbook);
            $writer->setDelimiter(',');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer_backup = new \PhpOffice\PhpSpreadsheet\Writer\Csv($export_workbook_backup);
            $writer_backup->setDelimiter(',');
            $writer_backup->setLineEnding("\r\n");
            $writer_backup->setSheetIndex(0);
          // }elseif($_POST["file_type_gen"] == "xlsx"){
          //   $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_workbook);
          //   $writer_backup = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($export_workbook_backup);
          // }
          $fullpath_template = '../../../attachment/datapump/'.date("Y-m-d").'/template/';
          $fullpath_backup = '../../../attachment/datapump/'.date("Y-m-d").'/backup/';
          $writer->save($fullpath_template.$file_name_without_type.".".$_POST['file_type_gen']);
          $writer_backup->save($fullpath_backup.$file_name_without_type."_backup.".$_POST['file_type_gen']);
         // get template display
         echo "<hr>";
         $ws_tm = $export_workbook->getSheetByName('Datapump');
          $lastRow_tm = $ws_tm->getHighestRow();
          $count_col = count($columns_name);
         for($row_tm = 2; $row_tm  <=  $lastRow_tm  ; $row_tm++){
          $tabel_row .="<tr>";
            for($col_tm = 1; $col_tm  <=  $count_col  ; $col_tm++){
              $get_tm_value = $ws_tm->getCellByColumnAndRow($col_tm, $row_tm)->getValue();
              $tabel_row .="<td>".$get_tm_value."</td>";
            }
          $tabel_row .="</tr>";
         }
        // get original display
          for($row_ls = $header_row+2; $row_ls  <=  $lastRow_ls  ; $row_ls++){
           $tabel_row_ori .="<tr>";
           $get_sbc_value = $ws_linesheet->getCellByColumnAndRow($column_ls_barcode_sbc, $row_ls)->getValue();
           $get_ibc_value = $ws_linesheet->getCellByColumnAndRow($column_ls_ibc, $row_ls)->getValue();
           $get_sku_value = $ws_linesheet->getCellByColumnAndRow($column_ls_sku, $row_ls)->getValue();
          $get_pid_value=$bu.$get_ibc_value;
           $tabel_row_ori .="<td>".$get_sku_value."</td>";
           $tabel_row_ori .="<td>".$get_ibc_value."</td>";
           $tabel_row_ori .="<td>".$get_pid_value."</td>";
           $tabel_row_ori .="<td>".$get_sbc_value."</td>";
           $tabel_row_ori .="</tr>";
          }
?>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingzero">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsezero"
                aria-expanded="true" aria-controls="collapsezero">
                Compare data for <?php echo $file_name ?>
            </button>
        </h2>
        <span style="margin-left: 20px;"><a
                href="<?php echo $fullpath_template.$file_name_without_type.'.'.$_POST["file_type_gen"]; ?>"
                class="btn btn-primary btn-sm" style="margin-top:10px;">
                <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Template
            </a></span>
        <span><a href="<?php echo $fullpath_template.$file_name_without_type.'_backup.'.$_POST["file_type_gen"]; ?>'"
                class="btn btn-secondary btn-sm" style="margin-top:10px;margin-left:5px">
                <ion-icon name="cloud-download-outline" style="margin-right: 1px;"></ion-icon> Download Backup
            </a></span>
        <div id="collapsezero" class="accordion-collapse collapse show" aria-labelledby="headingzero"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>This is compare data</strong> bettween <code>content service gate</code> ,
                <code>Linesheet</code> and <code>24EP</code>. please correct this befor continue.
                <?php $time_end = microtime(true);
          $execution_time = ($time_end - $time_start)/60;
          $execution_time_s = ($time_end - $time_start);
          echo '<br><span>Total Execution Time (Mins) : </span> '.number_format($execution_time, 2, '.', ' ').' Mins<br>';
          echo '<span>Total Execution Time (Second) : </span> '.number_format($execution_time_s, 2, '.', ' ').' Second<br>'; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Linesheet</th>
                            <th>24EP</th>
                            <th>Service Gate</th>
                            <th>Automatic Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Identity</th>
                            <td><?php echo substr($file_name_without_type,0,12)?></td>
                            <td><?php echo $job_number_24."[".$id_24."]";?></td>
                            <td><?php echo $id_csg ?></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td><?php echo $brand; ?></td>
                            <td><?php echo $brand_24; ?></td>
                            <td><?php echo $brand_csg; ?></td>
                            <td><?php if($brand==$brand_24 and $brand==$brand_csg){echo "<span style='color:Green'>matched</span>";}else{echo "<span style='color:Red'>not matched</span>";} ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Store</th>
                            <td><?php echo str_replace(",","<br>",$store_stock);?></td>
                            <td><?php echo  str_replace(", ","<br>",$store_stock_24); ?></td>
                            <td><?php echo  str_replace(", ","<br>",$store_stock_csg); ?></td>
                            <td><?php
                            //check array 1
                            $stores_arr_1 = explode(",",str_replace(", ",",",$store_stock));
                            $stores_arr_2 = explode(",",str_replace(", ",",",$store_stock_24));
                            $stores_arr_3 = explode(",",str_replace(", ",",",$store_stock_csg));
                            foreach ($stores_arr_1 as $store_1) {
                              if(in_array($store_1, $stores_arr_2) and in_array($store_1, $stores_arr_3)){
                                $array_1 == true;
                              }else{
                                $array_1 == false;
                                // break;
                              }
                            }
                            foreach ($stores_arr_2 as $store_2) {
                              if(in_array($store_2, $stores_arr_1) and in_array($store_2, $stores_arr_3)){
                                $array_2 == true;
                              }else{
                                $array_2 == false;
                                // break;
                              }
                            }
                            foreach ($stores_arr_3 as $store_3) {
                              if(in_array($store_3, $stores_arr_1) and in_array($store_3, $stores_arr_2)){
                                $array_3 == true;
                              }else{
                                $array_3 == false;
                                // break;
                              }
                            }
                            if( $array_1 and  $array_2 and  $array_3){
                              echo "<span style='color:Green'>matched</span>";
                            }elseif($array_1 and $array_2 and !$array_3){
                              echo "<span style='color:Red'>csg not matched</span>";
                            }elseif($array_1 and !$array_2 and $array_3){
                              echo "<span style='color:Red'>24ep not matched</span>";
                            }elseif(!$array_1 and $array_2 and $array_3){
                              echo "<span style='color:Red'>linesheet not matched</span>";
                            }else{
                              echo "<span style='color:Red'>many source not matched</span>";
                            }
                            ?></td>
                        </tr>
                        <tr>
                            <th>Chanel</th>
                            <td> <?php echo $channel;?></td>
                            <td><?php echo $website_24; ?></td>
                            <td><?php echo $website_csg; ?></td>
                            <td><?php if($channel==$website_24 and $channel==$website_csg){echo "<span style='color:Green'>matched</span>";}else{echo "<span style='color:Red'>not matched</span>";}?>
                            </td>
                        </tr>
                        <tr>
                            <th>BU</th>
                            <td><?php echo $bu;?></td>
                            <td><?php echo $bu_24; ?></td>
                            <td><?php echo $bu_csg; ?></td>
                            <td><?php if($bu==$bu_24 and $bu==$bu_csg){echo "<span style='color:Green'>matched</span>";}else{echo "<span style='color:Red'>not matched</span>";}?>
                            </td>
                        </tr>
                        <tr>
                            <th>SKU</th>
                            <td><?php echo $lastRow_ls-$header_row;?></td>
                            <td><?php echo $sku_24; ?></td>
                            <td><?php echo $sku_csg; ?></td>
                            <td><?php if($lastRow_ls-$header_row==$sku_24 and $lastRow_ls-14==$sku_csg){echo "<span style='color:Green'>matched</span>";}else{echo "<span style='color:Red'>not matched</span>";} ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
unset($writer);
unset($writer_backup);
$vars = array_keys(get_defined_vars());
for ($i = 0; $i < sizeOf($vars); $i++) {
    if( $vars[$i]<>'array_file' and
        $vars[$i]<>'nickname' and
        $vars[$i]<>'con' and
        $vars[$i]<>'file_name' and
        $vars[$i]<>'file_type_gen' and
        // $vars[$i]<>'export_workbook' and
        // $vars[$i]<>'export_workbook_backup' and
        $vars[$i]<>'num_count' and
        $vars[$i]<>'count_array_loop' and
        $vars[$i]<>'fullpath_linesheet' and
        $vars[$i]<>'fullpath_template'and
        $vars[$i]<>'array_file_string' and
        $vars[$i]<>'array_file_loop'
        ){

        unset( ${"$vars[$i]"} );
        if(${"$vars[$i]"}){
          echo ${"$vars[$i]"}.",";
        }

    }
}
unset($vars,$i);
}
include('zip.php')

?>
</div>