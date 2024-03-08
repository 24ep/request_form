<?php
   function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
    }

function send_email_to_reset_password($email,$random_code) {

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://prod-07.southeastasia.logic.azure.com:443/workflows/71a17f1eebc249eaa6a78310c3cc112b/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=s0t-LQ9YEqdrrFVyGz_lJe9OXSGAshS0IG_n9dKeSgY',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email":"'.$email.'",
            "verify_code":"'.$random_code.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    if ($response === false) {
        die('Curl error: ' . curl_error($curl));
    }
    
    curl_close($curl);
}
$randomCode = generateRandomCode(10);
send_email_to_reset_password($_POST['email'],$randomCode);


$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$email = $_POST['email'];
$sql  = "UPDATE account SET verify_code = '".$randomCode."' WHERE work_email='".$email."'";

$query = mysqli_query($con,$sql);


?>