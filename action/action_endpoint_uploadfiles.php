<?php



/* Get the name of the uploaded file */

$filename = date("Ymdhms").'_'.$_FILES['image']['name'];

$fileSize = $_FILES['image']['size'];

$fileTmpName  = $_FILES['image']['tmp_name'];

$fileType = $_FILES['image']['type'];

/* Choose where to save the uploaded file */

$location = "../../attachment/brand_editor/".$filename;

/* Save the uploaded file to the local filesystem */



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

        $arr=array("success"=>1,"file"=>array("url"=>"https://phpstack-1223668-4355262.cloudwaysapps.com/attachment/brand_editor/".$filename));

        echo json_encode($arr);

   



    } else {

        echo "An error occurred. Try again or contact your system administrator.";

    }

} else {

    foreach ($errors as $error) {

        echo $error . "These are the errors" . "\n";

    }

    

}







?>