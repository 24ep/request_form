
   
<?php

$userId = $_POST["userId"];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set("Asia/Bangkok");
    $sql_gb = "SELECT * from  account WHERE line_user_id ='".$userId."'";
    $query_gb  = mysqli_query($con,$sql_gb);
    $id = "";
    while($row = mysqli_fetch_array($query_gb)) {
        $username = $row["username"];
    }

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
 include('https://content-service-gate.cdsecommercecontent.ga/action/action_send_line_api.php');
 include('https://content-service-gate.cdsecommercecontent.ga/action/action_add_participant.php');
 $cr_title = "[Line OA Create Channel]";
 $cr_description = htmlspecialchars($_POST["detail_request"], ENT_QUOTES);
//check size file
    //action upload file
    if(isset($_FILES['files_meq'])){
        foreach($_FILES['files_meq']['tmp_name'] as $key => $val){
            $file_name = $_FILES['files_meq']['name'][$key];
            $file_size =$_FILES['files_meq']['size'][$key];
            $file_tmp =$_FILES['files_meq']['tmp_name'][$key];
            $file_type=$_FILES['files_meq']['type'][$key];
            $is_image = is_image($file_tmp);
            if (($file_size > 2097152 or $file_size ==0) and $file_name <> ""  ) { 
                $result = '<div class="alert alert-danger">ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์</div>';
                echo '<script>alert("ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์")</script>';
                header( "location: /homepage.php?tab=v-pills-cr&result_cr=".$result);
                exit();
        }
    }
}
            // foreach($_POST["cr_online_channel"] as $product_website)
            //     {
            //         if($sum_product_website <> ""){
            //             $sum_product_website .= ", ".$product_website;
            //         }else{
            //             $sum_product_website .= $product_website;
            //         }
            //     };
        //calculate job number
        if($cr_title <>""){ $insert_head .= "title";$insert_value .= "'".$cr_title."'";}
        if($_POST["detail_request"]<>""){ $insert_head .= ",description";$insert_value .= ",'".$cr_description."'";}
         $insert_head .= ",sku";$insert_value .= ",1";
        if($_POST["priority"]<>""){ $insert_head .= ",piority";$insert_value .= ",'".$_POST["priority"]."'";}
         $insert_head .= ",online_chanel";$insert_value .= ",CDS";
        if($username<>""){ $insert_head .= ",request_by";$insert_value .= ",'".$username."'";}
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
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
                  $fullpath = '../../../attachment/csg/'.$last_id."/";
                  if (!file_exists($fullpath)) {
                    mkdir($fullpath, 0777, true);
                  }
                  // upload image
                  foreach($_FILES['files_meq']['tmp_name'] as $key => $val){
                    $file_name = $_FILES['files_meq']['name'][$key];
                    $file_size =$_FILES['files_meq']['size'][$key];
                    $file_tmp =$_FILES['files_meq']['tmp_name'][$key];
                    $file_type=$_FILES['files_meq']['type'][$key];
                    $is_image = is_image($file_tmp);
                    if(isset($_FILES["files_meq"])){
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
                            '".$$username."',
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
                // date_default_timezone_set("Asia/Bangkok");
                // $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                // mysqli_query($con, "SET NAMES 'utf8' ");
                // $query = "SELECT  * FROM content_request as cr
                // left join account as account
                // ON cr.request_by = account.username WHERE cr.id = ".$last_id
                // or die("Error:" . mysqli_error());
                // $result =  mysqli_query($con, $query);
                //     while($row = mysqli_fetch_array($result)) {
                //         $key = $row["token_line"];
                //         $title = $row["title"];
                //         //echo '<script>alert("'.$key.'");</script>';
                //     }
                //     if($key<>"" and $key<>null){
                //         sent_line_noti("\n• Created new request\n----------------------------\n• คุณได้ทำการส่ง Content Request\n• Ticket ID : CR-".$last_id."\n".$title,$key);
                //     }
                // $result='<div class="alert alert-success">already create content_request !<strong> ID '.$last_id.'</strong></div>';
                // header( "location: /homepage.php?tab=v-pills-cr&result_cr=".$result);
            }else{
                echo '<div class="alert alert-danger">Error: ' . $sql . '<hr>' . $con->error.'</div>';
            }
            mysqli_close($con);
   // header( "location: https://cdsecommercecontent.ga/powerappsp/job_manage.php");
?>
