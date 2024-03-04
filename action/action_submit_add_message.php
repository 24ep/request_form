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

 $cr_title = htmlspecialchars($_POST["ms_title"], ENT_QUOTES);

 $cr_description = htmlspecialchars($_POST["ms_description"], ENT_QUOTES);

//check size file

    //action upload file

    if(isset($_FILES['ms_attachment'])){

        foreach($_FILES['ms_attachment']['tmp_name'] as $key => $val){

            $file_name = $_FILES['ms_attachment']['name'][$key];

            $file_size =$_FILES['ms_attachment']['size'][$key];

            $file_tmp =$_FILES['ms_attachment']['tmp_name'][$key];

            $file_type=$_FILES['ms_attachment']['type'][$key];

            $is_image = is_image($file_tmp);

            if (($file_size > 2097152 or $file_size ==0) and $file_name <> ""  ) { 

                $result = '<div class="alert alert-danger">ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์</div>';

                echo '<script>alert("ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์")</script>';

                header( "Location: /homepage.php?tab=v-pills-cr&result_cr=".$result);

                exit();

        }

    }

}

       

        //calculate job number

        if($_POST["ms_title"]<>""){ $insert_head .= "title";$insert_value .= "'".$cr_title."'";}

        if($_POST["ms_description"]<>""){ $insert_head .= ",description";$insert_value .= ",'".$cr_description."'";}

        if($_SESSION["username"]<>""){ $insert_head .= ",create_by";$insert_value .= ",'".$_SESSION["username"]."'";}

        // $description = htmlspecialchars_decode($_POST["ms_description"],ENT_QUOTES);

        $description = $_POST["ms_description"];

        // $description  = strip_tags($description);

        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

        mysqli_query($con, "SET NAMES 'utf8' ");

            $sql = "INSERT INTO message_box (

            ".$insert_head."

            )

            VALUES (

            ".$insert_value."

            )";

            $query = mysqli_query($con,$sql);

            if($query) {

                $last_id = $con->insert_id;

                  //add target

                  if($_POST["ms_target"]=="everyone_in_central"){



                    $query_get_all_user = "SELECT username,token_line FROM account where status = 'Enabled' and lower(work_email) like '%@central.co.th%' and username='poojaroonwit'" or die("Error:" . mysqli_error($con));

                    $result_get_all_user =  mysqli_query($con, $query_get_all_user);

                        while($row_get_all_result = mysqli_fetch_array($result_get_all_user)) {

                            $username = $row_get_all_result["username"];

                            $key = $row_get_all_result["token_line"];

                            $sql_ms_target = "INSERT INTO target_message_box (

                                target_username,msid

                                )

                                VALUES (

                                '".$username."',".$last_id."

                                )";

                            $query_target = mysqli_query($con,$sql_ms_target);

                            //send to line

                            if($key<>"" and $key<>null){

                                sent_line_noti("\n❗ Announce\n----------------------------\nMS-".$last_id."\n".$description,$key);

                            }

                        }



                  }else{

                    $target_usernames  = explode(",", $_POST["ms_target"]);

                    foreach($target_usernames  as $target_username){

                      $sql_ms_target = "INSERT INTO target_message_box (

                          target_username,msid

                          )

                          VALUES (

                          '".$target_username."',".$last_id."

                          )";

                      $query_target = mysqli_query($con,$sql_ms_target);
https://phpstack-1224828-4360872.cloudwaysapps.com
                    //send to line

                    $query_get_all_user = "SELECT username,token_line FROM account where status = 'Enabled' and username = '".$target_username."'" or die("Error:" . mysqli_error($con));

                    $result_get_all_user =  mysqli_query($con, $query_get_all_user);

                        while($row_get_all_result = mysqli_fetch_array($result_get_all_user)) {

                            $username = $row_get_all_result["username"];

                            $key = $row_get_all_result["token_line"];

                            

                        }

                        if($key<>"" and $key<>null){

                            sent_line_noti("\n❗ Announce\n----------------------------\nMS-".$last_id."\n".$description,$key);

                        }

                      

                    }

                  }

                



                  //create forder

                  $fullpath = '../../attachment/csg/'.$last_id."/";

                  if (!file_exists($fullpath)) {

                    mkdir($fullpath, 0777, true);

                  }

                  // upload image

                  foreach($_FILES['ms_attachment']['tmp_name'] as $key => $val){

                    $file_name = $_FILES['ms_attachment']['name'][$key];

                    $file_size =$_FILES['ms_attachment']['size'][$key];

                    $file_tmp =$_FILES['ms_attachment']['tmp_name'][$key];

                    $file_type=$_FILES['ms_attachment']['type'][$key];

                    $is_image = is_image($file_tmp);

                    if(isset($_FILES["ms_attachment"])){

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

                            'message_box'

                            )";

                        $query = mysqli_query($con,$sql);

                        move_uploaded_file($file_tmp,$fullpath.$file_name);

                            }

                        }

                    }

                 add_participant($last_id,"message_box");

                //get key

                date_default_timezone_set("Asia/Bangkok");

                $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

                mysqli_query($con, "SET NAMES 'utf8' ");

                $query = "SELECT  * FROM message_box as ms

                left join account as account

                ON ms.create_by = account.username WHERE ms.id = ".$last_id

                or die("Error:" . mysqli_error($con));

                $result =  mysqli_query($con, $query);

                    while($row = mysqli_fetch_array($result)) {

                        $key = $row["token_line"];

                        $title = $row["title"];

                        //echo '<script>alert("'.$key.'");</script>';

                    }

                    if($key<>"" and $key<>null){

                        sent_line_noti("\n• Created new request\n----------------------------\n• คุณได้ทำการส่ง message\n• Ticket ID : MS-".$last_id."\n".$title,$key);

                    }





                //send to all user

                

                $result='<div class="alert alert-success">already create message !<strong> ID '.$last_id.'</strong></div>';

                header( "Location: /homepage.php?tab=v-pills-ms_admin");

            }else{

                echo '<div class="alert alert-danger">Error: ' . $sql . '<hr>' . $con->error.'</div>';

            }

            mysqli_close($con);

   // header( "location: https://cdse-commercecontent.com/job_manage.php");

?>

