<?php

/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];
$fileSize = $_FILES['myfile']['size'];
$fileTmpName  = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
/* Choose where to save the uploaded file */
mkdir('../../attachment/brand_editor', 0777, true);
$location = "../../attachment/brand_editor/".$filename;
/* Save the uploaded file to the local filesystem */
if (! in_array($fileExtension,$fileExtensions)) {
    $errors[] = "This process does not support this file type. Upload a JPEG or PNG file only.";
}

if ($fileSize > 2000000) {
    $errors[] = "You cannot upload this file because its size exceeds the maximum limit of 2 MB.";
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