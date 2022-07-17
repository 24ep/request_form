<?php

/* Get the name of the uploaded file */
$filename = date("Ymdhms").'_'.$_FILES['File']['name'];
$fileSize = $_FILES['File']['size'];
$fileTmpName  = $_FILES['File']['tmp_name'];
$fileType = $_FILES['File']['type'];
/* Choose where to save the uploaded file */
$location = "../../attachment/brand_editor/".$filename;
/* Save the uploaded file to the local filesystem */

if ($fileSize > 2000000) {
    $errors[] = "You cannot upload this file because its size exceeds the maximum limit of 2 MB.";
}
if($fileSize == 0){
    $errors[] = "not found upload file.";
}

if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $location);

    if ($didUpload) {
        echo '{
            "success" : 1,
            "file": {
                "url" : "https://content-service-gate.cdse-commercecontent.com/attachment/brand_editor/'.$filename.'",
            }
        }';
    } else {
        echo "An error occurred. Try again or contact your system administrator.";
    }
} else {
    foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
    }
}



?>