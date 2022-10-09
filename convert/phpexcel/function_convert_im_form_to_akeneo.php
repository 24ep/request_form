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

?>