<?php
session_start();
echo '<script>console.log("start");</script>';
// include("../../insert_log.php");
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
$fullpath = '../../attachment/'.$_POST["job_number"].'/Cleaned/';
mkdir($fullpath, 0777, true);
$fullpath_normal = '../../attachment/'.$_POST["job_number"].'/Cleaned/';
mkdir($fullpath, 0777, true);
$fullpath_normal_template = '../../attachment/'.$_POST["job_number"].'/Template/';
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