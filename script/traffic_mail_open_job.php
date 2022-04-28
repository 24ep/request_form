<?php
session_start();
include('action_send_line_api.php');
include('action_add_participant.php');
# Get Variable form email
$subject = $_POST["subject"];
$body = $_POST["body"];
$important = $_POST["importance"];
$message_id = $_POST["message_id"];
$lastest_message_id = $_POST["lastest_message_id"];
$internet_message_id = $_POST["internet_message_id"];
$conversation_id = $_POST["conversation_id"];
$email_from = $_POST["email_from"];
$contact = $_POST["contact"];
$link_info =  $_POST["link_info"];
$launch_date =  $_POST["launch_date"];
$production_type =  $_POST["production_type"];
$store_stock =  $_POST["store_stock"];
$contact_vender = $_POST["contact_vender"];

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
    if($exist_user == null or $exist_user == ""){
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
        $username =  $username_replace;

    }else{
        $username =  $exist_user;
    }
    return $username;

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
function count_conversion_id($conversation_id){

    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "SELECT count(id) as total from add_new_job where mail_conversation_id='".$conversation_id."'";
    $result =  mysqli_query($con, $sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    return $count;
}
function clone_ticket($conversation_id,$id){
$count_conversion_id = count_conversion_id($conversation_id);
    if($count_conversion_id == 1){
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        //get current data from parent ticket
        $sql = "INSERT INTO add_new_job (brand,department,sku,production_type,project_type,business_type,link_info,launch_date,stock_source,contact_buyer,
        contact_vender,remark,request_username,new_brand,
        online_channel,bu,request_important,tags,participant,subject_mail,sub_department,web_cate,request_date,mail_conversation_id,mail_message_id,mail_internet_message_id)
        SELECT brand,department,sku,production_type,project_type,business_type,link_info,launch_date,stock_source,contact_buyer,
        contact_vender,remark,request_username,new_brand,
        online_channel,bu,request_important,tags,participant,subject_mail,sub_department,web_cate,request_date,mail_conversation_id,mail_message_id,mail_internet_message_id FROM add_new_job
        WHERE id=".$id ;
        $query = mysqli_query($con,$sql);
        if($query) {
            return $con->insert_id;
        }else{
            return $con ->error;
        }
        
        //insert to new ticket
    }
}
function check_exist_message_id(){
    global $conversation_id;
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "SELECT id from add_new_job where parent is null and  mail_conversation_id='".$conversation_id."'";
    $result =  mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)) {
        $exist_id =  $row["id"];
        break; 
    }
    if($exist_id == null or $exist_id == ""){
        return  "NULL";
    }else{
        //clone message id
        if(count_conversion_id($conversation_id)==1){
            $clone_id = clone_ticket($conversation_id,$exist_id);
            //update current clone id 
            $sql_update_clone = "UPDATE add_new_job SET parent= ".$exist_id." where id=".$clone_id ;
            $query_update_parent = mysqli_query($con,$sql_update_clone);
        }
        
        
        //chage status and config type for
        $sql_update_parent = "UPDATE add_new_job SET status = 'none',config_type= 'parent' where id=".$exist_id ;
        $query_update_parent = mysqli_query($con,$sql_update_parent);
        return  $exist_id;
    }
}

$separant_value =  check_separate_subject_mail();
$attributes_form_email = explode($separant_value,$subject);
$attributes = array(
    "department"=>mapping_department($attributes_form_email[0]),
    "sub_department"=>mapping_department($attributes_form_email[1]),
    "brand"=>$attributes_form_email[2],
    "total_sku"=>preg_replace('/[A-Z,a-z," "]+/','',$attributes_form_email[3]),
    "offline_runing_number"=>$attributes_form_email[4],
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
    "store_stock"=>$store_stock,
    "contact_vender"=>$contact_vender,
    "tags"=>"Auto_email_created",
    "lastest_message_id"=>$message_id
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
    global $conversation_id;

    $insert_head ="";
    $insert_value = "";
    if($attributes["launch_date"]==""){
        $launch_date = ",NULL" ;
    }else{
        $launch_date = ",'".$attributes["launch_date"]."'";
    }

    if($attributes["total_sku"]==""){
        $total_sku = ",0" ;
    }else{
        $total_sku = ",'".$attributes["total_sku"]."'";
    }
        
        $parent_id = ",".check_exist_message_id();

     $insert_head .= "brand";$insert_value .= "'".str_replace("'","''",$attributes["brand"])."'";
     $insert_head .= ",sku";$insert_value .= $total_sku;
     $insert_head .= ",link_info";$insert_value .= ",'".$attributes["link_info"]."'";
     $insert_head .= ",request_username";$insert_value .= ",'".$attributes["username"]."'";
     $insert_head .= ",request_important";$insert_value .= ",'".$attributes["request_important"]."'";
     $insert_head .= ",department";$insert_value .= ",'".$attributes["department"]."'";
     $insert_head .= ",sub_department";$insert_value .= ",'".$attributes["sub_department"]."'";
     $insert_head .= ",contact_buyer";$insert_value .= ",'".$attributes["contact"]."'";
     $insert_head .= ",participant";$insert_value .= ",'".$attributes["participant"]."'";
     $insert_head .= ",mail_conversation_id";$insert_value .= ",'".$attributes["mail_conversation_id"]."'";
     $insert_head .= ",mail_message_id";$insert_value .= ",'".$attributes["mail_message_id"]."'";
     $insert_head .= ",mail_internet_message_id";$insert_value .= ",'".$attributes["mail_internet_message_id"]."'";
     $insert_head .= ",launch_date";$insert_value .= $launch_date ;
     $insert_head .= ",production_type";$insert_value .= ",'".$attributes["production_type"]."'";
     $insert_head .= ",stock_source";$insert_value .= ",'".$attributes["store_stock"]."'";
     $insert_head .= ",contact_vender";$insert_value .= ",'".$attributes["contact_vender"]."'";
     $insert_head .= ",tags";$insert_value .= ",'".$attributes["tags"]."'";
     $insert_head .= ",status";$insert_value .= ",'pending'";
     $insert_head .= ",parent";$insert_value .= $parent_id;
  
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
            if(check_exist_message_id()=="NULL"){
                echo $last_id;
            }else{
                $count_conversation_id = count_conversion_id($conversation_id)-1;
                echo check_exist_message_id()."-".$count_conversation_id;
            }
         }else{
            exit("Error : ".$con->error.$sql.">>".$subject); 
         }

         #add participant
         #send line noti

         mysqli_close($con);   
}
# check subject
$keywords = array("SKU maintenance","SKU maintanance","sku_maintanance","sku mainta","sku mainte","SKU Maintainence"); 
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