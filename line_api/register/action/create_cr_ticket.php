
   
<?php
function bb_confirm_ticket($id ,$user_id,$detail,$priority,$image_path,$date_create){

    $curl = curl_init();
     
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'
       { "to": "'.$user_id.'",
        "messages":[
                        {
                        "type": "flex",
                        "altText": "Confirm ticket !",
                        "sender": {
                            "name": "CSG-BOT",
                            "iconUrl": "https://line.me/conyprof"
                        },
                         "contents": {
                            "type": "bubble",
                            "hero": {
                              "type": "image",
                              "url": "'.$image_path.'",
                              "size": "full",
                              "aspectRatio": "20:13",
                              "aspectMode": "cover",
                              "action": {
                                "type": "uri",
                                "label": "Action",
                                "uri": "https://linecorp.com/"
                              }
                            },
                            "body": {
                              "type": "box",
                              "layout": "vertical",
                              "spacing": "md",
                              "contents": [
                                {
                                  "type": "text",
                                  "text": "CONFIRM TICKET",
                                  "weight": "bold",
                                  "size": "md",
                                  "gravity": "center",
                                  "wrap": true,
                                  "contents": []
                                },
                                {
                                  "type": "text",
                                  "text": "CR-'.$id .'",
                                  "weight": "bold",
                                  "size": "xl",
                                  "color": "#A90C0CFF",
                                  "contents": []
                                },
                                {
                                  "type": "box",
                                  "layout": "vertical",
                                  "spacing": "sm",
                                  "margin": "lg",
                                  "contents": [
                                    {
                                      "type": "box",
                                      "layout": "baseline",
                                      "spacing": "sm",
                                      "contents": [
                                        {
                                          "type": "text",
                                          "text": "Date",
                                          "size": "sm",
                                          "color": "#AAAAAA",
                                          "flex": 1,
                                          "contents": []
                                        },
                                        {
                                          "type": "text",
                                          "text": "'.$date_create.'",
                                          "size": "sm",
                                          "color": "#666666",
                                          "flex": 4,
                                          "wrap": true,
                                          "contents": []
                                        }
                                      ]
                                    },
                                    {
                                      "type": "box",
                                      "layout": "baseline",
                                      "spacing": "sm",
                                      "contents": [
                                        {
                                          "type": "text",
                                          "text": "Detail",
                                          "size": "sm",
                                          "color": "#AAAAAA",
                                          "flex": 1,
                                          "contents": []
                                        },
                                        {
                                          "type": "text",
                                          "text": "'.$detail.'",
                                          "size": "sm",
                                          "color": "#666666",
                                          "flex": 4,
                                          "wrap": true,
                                          "contents": []
                                        }
                                      ]
                                    },
                                    {
                                      "type": "box",
                                      "layout": "baseline",
                                      "spacing": "sm",
                                      "contents": [
                                        {
                                          "type": "text",
                                          "text": "Priority",
                                          "size": "sm",
                                          "color": "#AAAAAA",
                                          "flex": 1,
                                          "contents": []
                                        },
                                        {
                                          "type": "text",
                                          "text": "'.$priority.'",
                                          "size": "sm",
                                          "color": "#666666",
                                          "flex": 4,
                                          "wrap": true,
                                          "contents": []
                                        }
                                      ]
                                    }
                                  ]
                                }
                              ]
                            },
                            "footer": {
                              "type": "box",
                              "layout": "horizontal",
                              "flex": 1,
                              "spacing": "xxl",
                              "margin": "xxl",
                              "contents": [
                                {
                                  "type": "button",
                                  "action": {
                                    "type": "uri",
                                    "label": "Ticket",
                                    "uri": "https://linecorp.com"
                                  },
                                  "height": "sm",
                                  "style": "secondary"
                                }
                              ]
                            }
                          }
                         
                        }
                ]
        }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer J/R5foEYEGdmDL85DJBMdlMfOos7JOKVlqzd4VOE3nXpT8OtSoc6On+3wNH4bZ6GU+4riP4v562ixfwVUwWdDmHae3qbVBxKUMrKcgoBFbGkrpX+QttoamNeNodqY5aXN3hXijql94zqPLAW7d+JgQdB04t89/1O/w1cDnyilFU='
      ),
    ));
    
    $response = curl_exec($curl);
    
    
    // echo $response;
    // echo '<script> console.log("'.$response.'");</script> ';
    curl_close($curl);
    }

function add_participant($id,$table,$username){
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM ".$table."  WHERE id = ".$id
        or die("Error:" . mysqli_error());
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $participant = $row["participant"];
               // echo "<script>alert('".$id."')</script>";
        }
        if($participant==null or $participant==""){
                $sql = "UPDATE ".$table." SET participant = '".$username."'  WHERE id=".$id;
                $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                $query = mysqli_query($con,$sql);
        }else{
                if(strpos($participant,$username)===false){
                 $sql = "UPDATE ".$table." SET participant = CONCAT(participant,',','".$username."')   WHERE id=".$id;
                 $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                 $query = mysqli_query($con,$sql);
                }
        }
}
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
    // $_SESSION["username"] = $username ;

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

//  include('https://content-service-gate.cdsecommercecontent.ga/action/action_send_line_api.php');
//  include('https://content-service-gate.cdsecommercecontent.ga/action/action_add_participant.php');
 $cr_title = "[Line OA Create Channel] ".$username;
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
                  $fullpath = '../../../../attachment/csg/'.$last_id."/";
                  $fullpath_getting = '../../attachment/csg/'.$last_id."/";
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
                            '".$fullpath_getting."',
                            '".$file_size."',
                            '".$file_type."',
                            '".$is_image."',
                            '".$username."',
                            '".$last_id."',
                            'content_request'
                            )";
                        $query = mysqli_query($con,$sql);
                        move_uploaded_file($file_tmp,$fullpath.$file_name);
                            }
                        }
                    }
                  $pre_detail_request =  substr($_POST["detail_request"],0,80);
                 add_participant($last_id,"content_request",$username);
                 bb_confirm_ticket($last_id ,$userId,$pre_detail_request."...",$_POST["priority"],"https://cdsecommercecontent.ga/attachment/csg/".$last_id."/".$file_name, date("Y-m-d h:i:sa"));
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
                echo 'Success ! ทางทีมได้รับข้อความของคุณแล้ว จะรีบดำเนินการให้เร็วที่สุด รายละเอียดเพิ่มเติมสามารถใช้ช่องแชทปกติได้เลยครับ';
            }else{
                echo 'Error: ' . $sql . '<hr>' . $con->error;
            }
            mysqli_close($con);
   // header( "location: https://cdsecommercecontent.ga/powerappsp/job_manage.php");
?>
