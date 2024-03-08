<?php
/* Get the name of the uploaded file */
$filename = date("Ymdhms").'_'.$_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$fileTmpName  = $_FILES['file']['tmp_name'];
$fileType = $_FILES['file']['type'];
/* Choose where to save the uploaded file */
$location = "../../attachment/brand_editor/".$filename;
/* Save the uploaded file to the local filesystem */
$extension = pathinfo($file_name, PATHINFO_EXTENSION);
if ($fileSize > 2000000) {
    $errors[] = "You cannot upload this file because its size exceeds the maximum limit of 2 MB.";
    echo "<script>
    Notiflix.Report.failure(
        'Failure',
        'Error: You cannot upload this file because its size exceeds the maximum limit of 2 MB.',
        'Okay',
        )</script>;
    ";
}
if($fileSize == 0){
    $errors[] = "not found upload file.";
}
if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $location);
    if ($didUpload) {
        $arr=array("success"=>1,"file"=>array("url"=>$_SERVER['DOCUMENT_ROOT']."/attachment/brand_editor/".$filename,"size"=>$fileSize,"name"=>$filename,"title"=>$filename,"extension"=>$extension));
    
    } else {
        echo "An error occurred. Try again or contact your system administrator.";
    }
} else {
    foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
    }
}
?>
