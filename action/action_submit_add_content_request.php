<?php

  function is_image($path)
  {
      $a = getimagesize($path);
      $image_type = $a[2];
      if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
      {
          return true;
      }
      return false;
  }
 session_start();
 include('action_send_line_api.php');
 include('action_add_participant.php');
 $cr_title = htmlspecialchars($_POST["cr_title"], ENT_QUOTES);
 $cr_description = htmlspecialchars($_POST["cr_description"], ENT_QUOTES);
//check size file
    //action upload file
    if(isset($_FILES['cr_attachment'])){
        foreach($_FILES['cr_attachment']['tmp_name'] as $key => $val){
            $file_name = $_FILES['cr_attachment']['name'][$key];
            $file_size =$_FILES['cr_attachment']['size'][$key];
            $file_tmp =$_FILES['cr_attachment']['tmp_name'][$key];
            $file_type=$_FILES['cr_attachment']['type'][$key];
            $is_image = is_image($file_tmp);
            if (($file_size > 2097152 or $file_size ==0) and $file_name <> ""  ) { 
                $result = '<div class="alert alert-danger">ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์</div>';
                echo '<script>alert("ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์")</script>';
                //header( "Location: /homepage.php?tab=v-pills-cr&result_cr=".$result);
                exit();
        }
    }
}
            foreach($_POST["cr_online_channel"] as $product_website)
                {
                    if($sum_product_website <> ""){
                        $sum_product_website .= ", ".$product_website;
                    }else{
                        $sum_product_website .= $product_website;
                    }
                };
        //calculate job number
        if($_POST["cr_title"]<>""){ $insert_head .= "title";$insert_value .= "'".$cr_title."'";}
        if($_POST["cr_description"]<>""){ $insert_head .= ",description";$insert_value .= ",'".$cr_description."'";}
        if($_POST["cr_sku"]<>""){ $insert_head .= ",sku";$insert_value .= ",'".$_POST["cr_sku"]."'";}
        if($_POST["cr_ticket_template"]<>""){ $insert_head .= ",ticket_template";$insert_value .= ",'".$_POST["cr_ticket_template"]."'";}
        if($_POST["cr_ticket_type"]<>"" or $_POST["cr_issue_type"]<>""){ $insert_head .= ",ticket_type";$insert_value .= ",'".$_POST["cr_issue_type"]."'";}
        if($_POST["cr_piority"]<>""){ $insert_head .= ",piority";$insert_value .= ",'".$_POST["cr_piority"]."'";}
        if($_POST["cr_content_request_reson"]<>""){ $insert_head .= ",content_request_reson";$insert_value .= ",'".$_POST["cr_content_request_reson"]."'";}
        if($_POST["cr_brand"]<>""){ $insert_head .= ",brand";$insert_value .= ",'".$_POST["cr_brand"]."'";}
        // if($_POST["cr_online_chanel"]<>""){ $insert_head .= ",online_chanel";$insert_value .= ",'".$_POST["cr_online_chanel"]."'";}
        if($_POST["cr_effective_date"]<>""){ $insert_head .= ",effective_date";$insert_value .= ",'".$_POST["cr_effective_date"]."'";}
        if($_SESSION["username"]<>""){ $insert_head .= ",request_by";$insert_value .= ",'".$_SESSION["username"]."'";}
        if($sum_product_website<>""){ $insert_head .= ",platform_issue";$insert_value .= ",'".$sum_product_website."'";}
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
            $sql = "INSERT INTO content_request (
            ".$insert_head."
            )
            VALUES (
            ".$insert_value."
            )";
            $query = mysqli_query($con,$sql);
            if($query) {
                $last_id = $con->insert_id;
                  //create forder
                  $fullpath = '../../attachment/csg/'.$last_id."/";
                  if (!file_exists($fullpath)) {
                    mkdir($fullpath, 0777, true);
                  }
                  // upload image
                  foreach($_FILES['cr_attachment']['tmp_name'] as $key => $val){
                    $file_name = $_FILES['cr_attachment']['name'][$key];
                    $file_size =$_FILES['cr_attachment']['size'][$key];
                    $file_tmp =$_FILES['cr_attachment']['tmp_name'][$key];
                    $file_type=$_FILES['cr_attachment']['type'][$key];
                    $is_image = is_image($file_tmp);
                    if(isset($_FILES["cr_attachment"])){
                        if ($file_name <> ""  ) { 
                        $sql = "INSERT INTO attachment (
                            file_name,
                            file_path,
                            file_size,
                            file_type,
                            is_image,
                            file_owner,
                            ticket_id,
                            ticket_type
                            )       
                            VALUES(
                            '".$file_name."',
                            '".$fullpath."',
                            '".$file_size."',
                            '".$file_type."',
                            '".$is_image."',
                            '".$_SESSION["username"]."',
                            '".$last_id."',
                            'content_request'
                            )";
                        $query = mysqli_query($con,$sql);
                        move_uploaded_file($file_tmp,$fullpath.$file_name);
                            }
                        }
                    }
                 add_participant($last_id,"content_request");
                //get key
                date_default_timezone_set("Asia/Bangkok");
                $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
                mysqli_query($con, "SET NAMES 'utf8' ");
                $query = "SELECT  * FROM content_request as cr
                left join account as account
                ON cr.request_by = account.username WHERE cr.id = ".$last_id
                or die("Error:" . mysqli_error($con));
                $result =  mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result)) {
                        $key = $row["token_line"];
                        $title = $row["title"];
                        //echo '<script>alert("'.$key.'");</script>';
                    }
                    if($key<>"" and $key<>null){
                        sent_line_noti("\n• Created new request\n----------------------------\n• คุณได้ทำการส่ง Content Request\n• Ticket ID : CR-".$last_id."\n".$title,$key);
                        send_ms_team("CR-".$last_id,"Created new request (CR)",$_SEESION["username"]." ได้ทำการส่ง Content Request\n• Ticket ID : CR-".$last_id."<br>".$title);
                    }
                $result='Your request have been create <strong> ID '.$last_id;
                echo $result;
            }else{
                echo 'Error: ' . $sql . '<br/><br/>' . $con->error;
                
            }
            mysqli_close($con);
   // header( "location: https://cdse-commercecontent.com/job_manage.php");
?>