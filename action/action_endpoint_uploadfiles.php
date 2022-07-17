<?php

/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];

/* Choose where to save the uploaded file */
mkdir('../../attachment/brand_editor/', 0777, true);
$location = "../../attachment/brand_editor/".$filename;
/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
    echo '{
        "success" : 1,
        "file": {
            "url" : "https://content-service-gate.cdse-commercecontent.com/attachment/brand_editor/'.$filename.'",
        }
    }';
} else { 
  echo 'Failure'; 
}

?>