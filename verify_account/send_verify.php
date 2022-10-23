<?php 


// $username = $_GET['username'];
// $email = $_GET['work_email'];
// $firstname = $_GET['firstname'];
// $lastname = $_GET['lastname'];

function send_verify_email($username,$email,$firstname,$lastname){
    $member_verify_code =  uniqid($username);
    
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql  = "UPDATE account SET verify_code = '".$member_verify_code."' WHERE username='".$username."'";
	$query = mysqli_query($con,$sql);
    if($query){
        $member_id = $con->insert_id;
  
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://prod-08.southeastasia.logic.azure.com:443/workflows/16760d582d694c7581adcf0277bdc4c5/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=S64_L44V-KM-StYFFY-s_0Ot1Lm2O3A9LLw4U166qG0',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "username":"'.$username.'",
            "verify_code":"'.$member_verify_code.'",
            "firstname":"'.$firstname.'",
            "lastname":"'.$lastname.'",
            "email":"'.$email.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
            }
        // header("Location: https://content-service-gate.cdse-commercecontent.com/base/verify_account/waiting_verify.php?email=".$_SESSION['work_email'],TRUE, 301);
        // exit();
}

    
    
        

?>