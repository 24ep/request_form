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
 
?>