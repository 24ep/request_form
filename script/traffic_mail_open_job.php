<?php
session_start();
include('action_send_line_api.php');
include('action_add_participant.php');
# Get Variable form email
$subject = $_GET["subject"];
$body = $_GET["body"];
$important = $_GET["importance"];
$message_id = $_GET["message_id"];
$internet_message_id = $_GET["internet_message_id"];
$conversation_id = $_GET["conversation_id"];
$email_from = $_GET["email_from"];

#check separate subject email
function check_separate_subject_mail(){
    global $subject;
    $separates = array("|","/",","); 
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
        exit("not found separent value");
    }
}

$separant_value =  check_separate_subject_mail();
$attributes_form_email = explode($separant_value,$subject);

$attributes = array(
    "department"=>$attributes_form_email[0],
    "brand"=>$attributes_form_email[1],
    "total_sku"=>$attributes_form_email[2],
    "offline_runing_number"=>$attributes_form_email[3],
    "link_info"=>"link_info mockup",
    "username"=>"poojaroonwit",
    "request_important"=>$important
    
);

function create_ticket_csg(){
    global $subject;
    global $attributes;
    global $importance;
    global $message_id;

    $insert_head ="";
    $insert_value = "";

     $insert_head .= "brand";$insert_value .= "'".str_replace("'","''",$attributes["brand"])."'";
     $insert_head .= ",sku";$insert_value .= ",'".$attributes["total_sku"]."'";
     $insert_head .= ",link_info";$insert_value .= ",'".$attributes["link_info"]."'";
     $insert_head .= ",username";$insert_value .= ",'".$attributes["username"]."'";
     $insert_head .= ",request_important";$insert_value .= ",'".$attributes["request_important"]."'";
     
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
         }

         #add participant
         #send line noti

         mysqli_close($con);
     

    
}



# check subject
$keywords = array("SKU maintanance","sku_maintanance","sku mainta","sku mainte"); 
foreach ($keywords as $keyword) {
    if(str_contains($subject , $keyword)){
        create_ticket_csg();
    }else{
        #end script
        exit('non sku maintanance'); 
    }
  }



?>