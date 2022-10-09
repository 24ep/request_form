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

?>