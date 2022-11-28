<?php
 session_start();
 include('action_insert_log.php');
 include('action_send_line_api.php');
 include('action_add_participant.php');
 include('traffic_mail_send_update.php');
//include("connect.php");
    foreach($_POST["store_adj"] as $store)
        {
            if($sum_store <> ""){
                $sum_store .= ", ".$store;
            }else{
                $sum_store .= $store;
            }
        };
    foreach($_POST["itemmize_type_adj"] as $itemmize_type)
      {
            if($sum_itemmize_type <> ""){
                $sum_itemmize_type .= ", ".$itemmize_type;
            }else{
                $sum_itemmize_type .= $itemmize_type;
            }
      };
    foreach($_POST["product_website_adj"] as $product_website)
        {
            if($sum_product_website <> ""){
                $sum_product_website .= ", ".$product_website;
            }else{
                $sum_product_website .= $product_website;
            }
        };
    //calculate job number
          function max_job_by_bu($bu_job) {
          date_default_timezone_set("Asia/Bangkok");
          $con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
          mysqli_query($con, "SET NAMES 'utf8' ");
          $query_text = "SELECT MAX(substring(job_number,9,4)) AS max_job FROM `u749625779_cdscontent`.`job_cms` WHERE  substring(job_number,1,3) ='".$bu_job."' and substring(job_number,4,2) = substring(YEAR(current_timestamp),3,2)";
          $query = mysqli_query($con,$query_text);
          $row = mysqli_fetch_assoc($query);
          $largestNumber = $row["max_job"];
          return $largestNumber;
            }
            if($_POST["bu_adj"]=="MSL" or $_POST["bu_adj"]=="MJT" ){$bu_job =  "CDS";}else{$bu_job=$_POST["bu_adj"];} //change BU for job number
            $na = max_job_by_bu($bu_job);
            $na++;
            $job_number_laset = $bu_job.date("y").date("m")."-".str_pad( $na, 4, "0", STR_PAD_LEFT );
    //end calculate job number
//check post
$insrt_head .= "job_type";
$insrt_value .= "'New'";
if($job_number_laset<>""){ $insrt_head .= ",job_number";$insrt_value .= ",'".$job_number_laset."'";}
if($_POST["content_assign_name_adj"]<>""){ $insrt_head .= ",content_assign_name";$insrt_value .= ",'".$_POST["content_assign_name_adj"]."'";}
if($_POST["content_assign_date_adj"]<>""){ $insrt_head .= ",content_assign_date";$insrt_value .= ",'".$_POST["content_assign_date_adj"]."'";}
if($_POST["department_adj"]<>""){ $insrt_head .= ",department";$insrt_value .= ",'".$_POST["department_adj"]."'";}
if($_POST["sub_department_adj"]<>""){ $insrt_head .= ",sub_department";$insrt_value .= ",'".$_POST["sub_department_adj"]."'";}
if($_POST["brand_adj"]<>""){ $insrt_head .= ",brand";$insrt_value .= ",'".str_replace("'","''",$_POST["brand_adj"])."'";}
if($_POST["sku_adj"]<>""){ $insrt_head .= ",sku";$insrt_value .= ",'".$_POST["sku_adj"]."'";}
if($_POST["job_status_filter_adj"]<>""){ $insrt_head .= ",job_status_filter";$insrt_value .= ",'".$_POST["job_status_filter_adj"]."'";}
if($_POST["production_type_adj"]<>""){ $insrt_head .= ",production_type";$insrt_value .= ",'".$_POST["production_type_adj"]."'";}
if($_POST["product_type_adj"]<>""){ $insrt_head .= ",product_type";$insrt_value .= ",'".$_POST["product_type_adj"]."'";}
if($_POST["transfer_type_adj"]<>""){ $insrt_head .= ",transfer_type";$insrt_value .= ",'".$_POST["transfer_type_adj"]."'";}
if($_POST["product_sorting_adj"]<>""){ $insrt_head .= ",product_sorting";$insrt_value .= ",'".$_POST["product_sorting_adj"]."'";}
if($sum_store<>""){ $insrt_head .= ",store";$insrt_value .= ",'".$sum_store."'";}
if($_POST["luanch_date_adj"]<>""){ $insrt_head .= ",luanch_date";$insrt_value .= ",'".$_POST["luanch_date_adj"]."'";}
if($_POST["wrong_data_linesheet_adj"]<>""){ $insrt_head .= ",wrong_data_linesheet";$insrt_value .= ",'".$_POST["wrong_data_linesheet_adj"]."'";}
if($_POST["product_sell_type_adj"]<>""){ $insrt_head .= ",product_sell_type";$insrt_value .= ",'".$_POST["product_sell_type_adj"]."'";}
if($_POST["remark_adj"]<>""){ $insrt_head .= ",remark";$insrt_value .= ",'".$_POST["remark_adj"]."'";}
if($_POST["bu_adj"]<>""){ $insrt_head .= ",bu";$insrt_value .=",'". $_POST["bu_adj"]."'";}
if($_POST["wrong_data_sku_adj"]<>""){ $insrt_head .= ",wrong_data_sku";$insrt_value .= ",'".$_POST["wrong_data_sku_adj"]."'";}
if($_POST["duplicate_sku_in_mdc_adj"]<>""){ $insrt_head .= ",duplicate_sku_in_mdc";$insrt_value .= ",'".$_POST["duplicate_sku_in_mdc_adj"]."'";}
if($_POST["recive_mail_date_adj"]<>""){ $insrt_head .= ",recive_mail_date";$insrt_value .= ",'".$_POST["recive_mail_date_adj"]."'";}
if($_POST["id_adj"]<>""){ $insrt_head .= ",csg_request_new_id";$insrt_value .= ",'".$_POST["id_adj"]."'";}
if($_SESSION["nickname"]<>""){ $insrt_head .= ",traffic";$insrt_value .= ",'".$_SESSION["nickname"]."'";}
if($sum_product_website<>""){ $insrt_head .= ",product_website";$insrt_value .= ",'".$sum_product_website."'";}
if($sum_itemmize_type<>""){ $insrt_head .= ",itemmize_type";$insrt_value .=",'".$sum_itemmize_type."'";}
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO job_cms (
	".$insrt_head."
    )
	VALUES (
    ".$insrt_value."
    )";
    //echo $_SESSION["nickname"];
    //echo $_SESSION["user_id"];
	$query = mysqli_query($con,$sql);
	if($query) {
         $last_id =$con->insert_id;
         date_default_timezone_set("Asia/Bangkok");
         $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
         mysqli_query($con, "SET NAMES 'utf8' ");
         //chage status to accept
         $sql = "UPDATE add_new_job SET status = 'on-productions'  WHERE id=".$_POST["id_adj"];
         $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
         $query = mysqli_query($con,$sql);
        //get key
        $query = "SELECT  
        account.token_line as token_line,
        job.id as id,
        job.brand as brand,
        job.sku as sku,
        job.mail_message_id  as message_id,
        follow_up.firstname as f_first_name,
        follow_up.lastname as f_last_name,
        follow_up.work_email as f_work_email,
        follow_up.office_tell as f_office_tell,
        follow_up.department as f_department
        FROM add_new_job as job
        left join account as account
        ON job.request_username = account.username
        left join account as follow_up
        ON job.follow_up_by = follow_up.username  
        WHERE job.id = ".$_POST["id_adj"]
        or die("Error:" . mysqli_error($con));
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $key = $row["token_line"];
                $brand = $row["brand"];
                $sku = $row["sku"];
                $ticket_id = $row["id"];
                $message_id = $row["message_id"];
                $f_first_name = $row["f_first_name"];
                $f_last_name = $row["f_last_name"];
                $f_work_email = $row["f_work_email"];
                $f_office_tell = $row["f_office_tell"];
                $description = "The Follow-up team have been accepted your IM form , your information id <strong>NS-".$row['id']."</strong> ready to create new SKU on online channel , we are passing the information to production team (".$job_number_laset.") for writing a content.";
                $ticket_status = "Accepted";
            }
            if($message_id <> ""){
                $content_contact_person = $f_first_name." ".$f_last_name."\n".$f_work_email."\n".$f_office_tell; 
                send_update_mail($ticket_id,$brand,$sku ,$content_contact_person,$message_id,$description,$ticket_status);
            }
            if($key<>"" and $key<>null){
                sent_line_noti("\n• Updated NS-".$_POST["id_adj"]." [ ".$brand." ".$sku." SKUs ]\n----------------------------\n• ทำการเปิด job เรียบร้อยแล้ว\n• job number : ".$job_number_laset,$key);
                send_ms_team("NS-".$_POST["id_adj"],$brand." ".$sku." SKUs","ทำการเปิด job เรียบร้อยแล้ว<br>• job number : ".$job_number_laset);
            }
        add_participant($_POST["id_adj"],"add_new_job");
        insert_log("Create new job_cms ".$job_number_laset." id ".$last_id,"job_cms",$_POST["id_adj"]);
        $result='<div class="alert alert-success">already create new job !</div>';
        header( "location: https://cdse-commercecontent.com/base/job_manage.php?result=".$result);
	}else{
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
    }
    mysqli_close($con);
   // header( "location: https://cdse-commercecontent.com/base/job_manage.php");
?>
