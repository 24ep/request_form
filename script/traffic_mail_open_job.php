<?php
session_start();
include('action_send_line_api.php');
include('action_add_participant.php');
# Get Variable form email
$subject = $_POST["subject"];
$body = $_POST["body"];
$important = $_POST["importance"];
$message_id = $_POST["message_id"];
$internet_message_id = $_POST["internet_message_id"];
$conversation_id = $_POST["conversation_id"];
$email_from = $_POST["email_from"];
$contact = $_POST["contact"];
$link_info =  $_POST["link_info"];
$launch_date =  $_POST["launch_date"];
$production_type =  $_POST["production_type"];
$store_stock =  $_POST["store_stock"];

function check_account(){
    global $email_from;
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "SELECT username from account where  lower(work_email) = lower('".$email_from."')";
    $result =  mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)) {
        $exist_user =  $row["username"];
        break; 
    }
    if($exist_user == null or $exist_user = ""){
        #create a new user first
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $username_replace = str_replace("@central.co.th","",$email_from);
        $sql = "INSERT INTO account
         (firstname,
         lastname,
         nickname,
         username,
         password,
         department,
         work_email,
         office_tell,
         register_type) 
         VALUES 
         ('".$username_replace."',
         '".$username_replace."',
         '".$username_replace."',
         '".$email_from."',
         '378af2140b1f3aa30a6c5790454fab97',
         'Buyer Offline',
         '".$email_from."',
         '',
         'AUTO_MAIL'
         )
         ";
        $query = mysqli_query($con,$sql);
        return $username_replace;

    }else{
        return $exist_user;
    }

}

$username = check_account();

#check separate subject email
function check_separate_subject_mail(){
    global $subject;
    $separates = array("/","|",","); 
    $count_sparates = [];
    foreach ($separates as $separate) {
        $count_sparate = substr_count($subject,$separate);
        array_push($count_sparates,$count_sparate);
    }
    $max_char = max($count_sparates);
    if($max_char>0){
        $max_position = array_search($max_char, $separates);
        return $separates[$max_position];
    }else{
        exit("Error : not found separent value");
    }
}

$separant_value =  check_separate_subject_mail();
$attributes_form_email = explode($separant_value,$subject);
$attributes = array(
    "department"=>mapping_department($attributes_form_email[0]),
    "brand"=>$attributes_form_email[1],
    "total_sku"=>$attributes_form_email[2],
    "offline_runing_number"=>$attributes_form_email[3],
    "username"=>$username,
    "request_important"=>$important,
    "contact"=>$contact,
    "participant"=>"noti_follow_team,".$username,
    "mail_conversation_id"=>$conversation_id,
    "mail_message_id"=>$message_id,
    "mail_internet_message_id"=>$internet_message_id,
    "link_info"=>$link_info,
    "launch_date"=>$launch_date,
    "production_type"=>$production_type,
    "store_stock"=>$store_stock

);

function mapping_department($department){
    if(strpos(strtolower($department), "mom") !== false){
        return "MOM&KIDS";
    }elseif(strpos(strtolower($department), "kid") !== false){
        return "MOM&KIDS";
    }elseif(strpos(strtolower($department), "home") !== false){
        return "HOME";
    }elseif(strpos(strtolower($department), "tech") !== false){
        return "HOME";
    }elseif(strpos(strtolower($department), "sport") !== false){
        return "HOME";
    }elseif(strpos(strtolower($department), "women") !== false){
        return "WOMEN";
    }elseif(strpos(strtolower($department), "men") !== false){
        return "MEN";
    }elseif(strpos(strtolower($department), "beauty") !== false){
        return "BEAUTY";
    }else{
        return "OTHER";
    }
}

function create_ticket_csg(){
    global $subject;
    global $attributes;

    $insert_head ="";
    $insert_value = "";

     $insert_head .= "brand";$insert_value .= "'".str_replace("'","''",$attributes["brand"])."'";
     $insert_head .= ",sku";$insert_value .= ",'".$attributes["total_sku"]."'";
     $insert_head .= ",link_info";$insert_value .= ",'".$attributes["link_info"]."'";
     $insert_head .= ",request_username";$insert_value .= ",'".$attributes["username"]."'";
     $insert_head .= ",request_important";$insert_value .= ",'".$attributes["request_important"]."'";
     $insert_head .= ",department";$insert_value .= ",'".$attributes["department"]."'";
     $insert_head .= ",contact_buyer";$insert_value .= ",'".$attributes["contact"]."'";
     $insert_head .= ",participant";$insert_value .= ",'".$attributes["participant"]."'";
     $insert_head .= ",mail_conversation_id";$insert_value .= ",'".$attributes["mail_conversation_id"]."'";
     $insert_head .= ",mail_message_id";$insert_value .= ",'".$attributes["mail_message_id"]."'";
     $insert_head .= ",mail_internet_message_id";$insert_value .= ",'".$attributes["mail_internet_message_id"]."'";
     $insert_head .= ",launch_date";$insert_value .= ",'".$attributes["launch_date"]."'";
     $insert_head .= ",production_type";$insert_value .= ",'".$attributes["production_type"]."'";
     $insert_head .= ",stock_source";$insert_value .= ",'".$attributes["store_stock"]."'";

     
     date_default_timezone_set("Asia/Bangkok");
     $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
     mysqli_query($con, "SET NAMES 'utf8' ");
         $sql = "INSERT INTO add_new_job (
         ".$insert_head."
         )
         VALUES (
         ".$insert_value."
         )";
         $query = mysqli_query($con,$sql);
         if($query) {
            $last_id = $con->insert_id;
            echo $last_id;
         }else{
            exit("Error : ".$con->error); 
         }

         #add participant
         #send line noti

         mysqli_close($con);   
}
# check subject
$keywords = array("SKU maintenance","SKU maintanance","sku_maintanance","sku mainta","sku mainte"); 
$len = count($keywords);
$i=0;
foreach ($keywords as $keyword) {
    if(strpos(strtolower($subject), strtolower($keyword)) !== false){
        create_ticket_csg();
        exit();
    }
    if ($i == $len - 1) {
        echo 'NON SKU MAINTENANCE';
    }
    $i++;

  }



?>