<?php
 session_start();
$account=$_GET["state"];
$account_array = explode(",", $account);
$firstname = $account_array[0];
$lastname = $account_array[1];
$nickname = $account_array[2];
$username = $account_array[3];
$password = $account_array[4];
$department = $account_array[5];
$workemail = $account_array[6];
$office_tell = $account_array[7];
$state = $_GET["state"];
//request token
// - code getted just a key for request token from line API
echo "<script>console.log("."111".$token_line.")</script>";
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://notify-bot.line.me/oauth/token?grant_type=authorization_code&code='.$_GET["code"].'&redirect_uri=https://phpstack-1225538-4364543.cloudwaysapps.com/action/action_register_account.php&client_id=XPPcPQZGP76t3eLNrQ944w&client_secret=vng1Flh2DcFp4nYNluxOJZMTQ6kQh8qHBYzgQiBPdOO',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: 	application/x-www-form-urlencoded',
    'Cookie: XSRF-TOKEN=2ab9a1be-2338-4d98-8e7b-10dd39d518e3'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$en_response = json_decode($response);
$token_line = $en_response->{'access_token'};
// $token_line = $_GET["code"];
//encode password
$password_encode = md5(strrev(md5(str_replace(2,4,str_replace(strpos( substr(md5($password),2,1),md5($password)),strpos( substr(md5($password),4,1),md5($password)),md5($password))))));
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
// get current username for check
$query = "SELECT * FROM account WHERE username = '".$username."'"  or die("Error:" . mysqli_error($con));
$result =  mysqli_query($con, $query);
if((mysqli_fetch_array($result) === null)){
    //insert to database
            	$sql_create_list = "INSERT INTO account (
                    firstname,
                    lastname,
                    nickname,
                    username,
                    password,
                    department,
                    work_email,
                    office_tell,
                    token_line)
                    VALUES(
                    '".$firstname."',
                    '".$lastname."',
                    '".$nickname."',
                    '".$username."',
                    '".$password_encode."',
                    '".$department."',
                    '".$workemail."',
                    '".$office_tell."',
                    '".$token_line."'
                    )";
                    $query_list = mysqli_query($con,$sql_create_list);
                    //$issue_create_id = $con->insert_id;
                    if($query_list) {
                          $replyerror =  'already register ! please login';
                          header("Location:/login?username=".$username."&respond=".$replyerror);
                	}else{
                	      $replyerror =   $con->error;
                          header("Location:/login?username=".$username."&respond=".$replyerror);
                    }
exit();
}else{
    header("Location: /signup?reply=username นี้มีบนระบบแล้ว กรุณาใช้ชื่ออื่น&firstname=".$firstname."&lastname=".$lastname."&nickname=".$username."&password=".$password."&workemail=".$workemail);
}
?>
