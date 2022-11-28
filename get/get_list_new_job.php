<?php
session_start();
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error( $con));
function badge_status($status){
  if($status=="pending"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
  }elseif($status=="checking"  ){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ffff7e;color:#997300;border:#ffff7e">checking</button>';
  }elseif( $status=="on-production"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ff9a59;color:white;border:#ff9a59">on-production</button>';
  }elseif($status=="accepted" or $status=="on-productions"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#115636">'.$status.'</button>';
  }elseif($status=="waiting confirm"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">waiting confirm</button>';
  }elseif($status=="waiting image"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting image</button>';
  }elseif($status=="waiting data"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting data</button>';
  }elseif($status=="waiting traffic"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">waiting traffic</button>';
  }elseif($status=="cancel"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #efefef;color:#dddddd;border:#ea79f7">Cancel</button>';
  }else{
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">'.$status.'</button>';
  }
return $status;
}

function role_user($request_username,$follow_up_by){
  // session_start();
  if($_SESSION['username']==$request_username){
    $ticket_role = "Owner";
  }elseif($_SESSION['username']==$follow_up_by){
    $ticket_role = "officer";
  }else{
    $ticket_role = "participant";
  }
  return $ticket_role;
}
if(isset($_GET["fopenticket"])){
  $_SESSION["fopenticket"]=$_GET["fopenticket"];
}
if(isset($_POST["from_post"] )){
  if($_POST["from_post"] ==true ){
  $_SESSION["user_filter"] = $_POST["user_filter"];
  $_SESSION["status_filter"] = $_POST["status_filter"];
  $_SESSION['pagenation'] = $_POST["pagenation_input"];
  $_SESSION['brand_filter'] = $_POST["brand_filter"];
}}
  $start_item =  ($_SESSION['pagenation'] -1 )* 30;
 if(strpos($_SESSION["page_view"],'Followup')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "lower(anj.participant) like lower('%,".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('".$_SESSION["user_filter"].",%') or  lower(anj.participant) = lower('".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('%,".$_SESSION["user_filter"].",%')";
   }else{
    $position_filter = "(anj.follow_up_by ='' or anj.follow_up_by is null)";
   }
 }elseif(strpos($_SESSION["page_view"],'Buyer')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "lower(anj.participant) like lower('%,".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('".$_SESSION["user_filter"].",%') or  lower(anj.participant) = lower('".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('%,".$_SESSION["user_filter"].",%')";
   }else{
    $position_filter ="(anj.request_username ='' or anj.request_username is null)";
   }
 }else{
  if($_SESSION['user_filter']<>""){
    $position_filter = "lower(anj.participant) like lower('%,".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('".$_SESSION["user_filter"].",%') or  lower(anj.participant) = lower('".$_SESSION["user_filter"]."') or  lower(anj.participant) like lower('%,".$_SESSION["user_filter"].",%')";
   }else{
    $position_filter ="1=1";
   }
 }
 if($_SESSION['status_filter']<>""){
  $status_filter ="anj.status like '%".$_SESSION['status_filter']."%' or anj.status = 'none'";
 }else{
  $status_filter ="1=1";
 }
 if($_SESSION['brand_filter']<>""){
   if(is_numeric($_SESSION['brand_filter'])){
    $query_parent = "SELECT parent from all_in_one_project.add_new_job where id = ".$_SESSION['brand_filter'] or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query_parent);
    while($row = mysqli_fetch_array($result)) {
      $brand_filter_id_lu = $row["parent"];
    }
    if(isset($brand_filter_id_lu)){
      $brand_filter =" anj.id = ".str_replace('NS-','',$_SESSION['brand_filter'])." or  anj.id =".$brand_filter_id_lu ;
    }else{
      $brand_filter =" anj.id = ".str_replace('NS-','',$_SESSION['brand_filter']);
    }
   }else{
    $brand_filter =" ( anj.brand like '%".$_SESSION['brand_filter']."%' or anj.department like '%".$_SESSION['brand_filter']."%' or anj.sub_department like '%".$_SESSION['brand_filter']."%') ";
   }
 }else{
  $brand_filter ="1=1";
 }
 //set_query
 if(isset($_SESSION['fopenticket'])){
  $query = "SELECT * FROM add_new_job as anj where anj.id =".$_SESSION['fopenticket']."  ORDER BY anj.id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error($con));
  unset($_SESSION['fopenticket']);
 }else{
  $query = "SELECT * FROM add_new_job as anj where ((".$status_filter.") and (".$brand_filter.")
         and (".$position_filter.")) and anj.parent is null ORDER BY anj.id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error($con));
 }
  date_default_timezone_set("Asia/Bangkok");
  mysqli_query($con, "SET NAMES 'utf8' ");
  $result = mysqli_query($con, $query);
  // echo '<script>console.log("'.htmlspecialchars(stripslashes(str_replace(array("\r", "\n"), '', var_export($query, true)))).'")</script>';
  while($row = mysqli_fetch_array($result)) {
    $ticket_role = role_user($row["request_username"],$row["follow_up_by"]);
    if($row['status']=="accepted" and $row['trigger_status'] <> "on-productions"){
      $status=badge_status("on-production");
    }elseif($row['status']=="accepted" and $row['trigger_status'] == "on-productions"){
      $status=badge_status("on-productions");
    }else{
      $status =badge_status($row['status']);
    }
    //important badge
    if($row['request_important']=="Urgent"){
      $ri_style = '<span class="badge rounded-pill bg-danger" style="margin-left:5px">'.$row['request_important'].'</span>';
    }else{
      $ri_style = '<span class="badge rounded-pill bg-secondary" style="margin-left:5px">'.$row['request_important'].'</span>';
    }
    //launch date
    if($row['launch_date']<>""){
      $launch_date = date('d/m/y',strtotime($row['launch_date']));
    }else{
      $launch_date = "<span style='color:#E0E0E0'>No launch date</span>";
    }
    //priority_badge
    $current_day = date("Y-m-d");
    $p_badge="";
    $create_date = date_create($row["create_date"]);
    $create_date = date_format($create_date,"Y-m-d");
    // -1 create date > 5
    $create_date_diff = (strtotime($current_day) - strtotime($create_date))/  ( 60 * 60 * 24 );
    if($create_date_diff>=5){
      $p_badge .= '<span class="badge rounded-pill bg-warning" style="margin-left:5px">Age > '.$create_date_diff.' Days</span>';
    }elseif($create_date_diff>=5){
      $p_badge .= '<span class="badge rounded-pill bg-danger" style="margin-left:5px">Age > '.$create_date_diff.' Days</span>';
    }
    //  launch date
    if($row["launch_date"] <> null){
      $launch_date_c = date_create($row["launch_date"]);
      $launch_date_c = date_format($launch_date_c,"Y-m-d");
      $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
      if($launch_date_diff<=3){
        $p_badge .= '<span class="badge rounded-pill bg-danger" style="margin-left:5px">Launch in '.$launch_date_diff.' days</span>';
      }elseif($launch_date_diff<=5){
        $p_badge .= '<span class="badge rounded-pill bg-warning" style="margin-left:5px">Launch in '.$launch_date_diff.' days</span>';
      }
    }
    //  -2 already image
    $style_cancel = "";
    if($row["status"]=="cancel"){
      $style_cancel =  "style_cancel";
    }else{
      $style_cancel = "";
    }
    //config_type
    if($row["config_type"]=="parent"){
      //set style
      $tr_class = "class='sub-ticket shadow-sm p-3 mb-5 rounded ".$style_cancel."' style='background: white;'";
      $task_status = '';
      $query_sum="SELECT sum(sku) as total from add_new_job where parent = ".$row["id"];
      $result_sum = mysqli_query($con, $query_sum);
      $data_sum=mysqli_fetch_assoc($result_sum);
      if($row["sku"]<>$data_sum['total']){
        $badge_alert_sku = "<a data-bs-toggle='tooltip' data-bs-placement='top' title='จำนวน SKU ของ ticket แม่ไม่ตรงกับลูก'><ion-icon name='alert-circle-outline' style='color:red!important'  ></ion-icon></a>";
      }else{
        $badge_alert_sku = "";
      }
      $subtask_sum = $row["sku"]." S(".$data_sum['total'].") ".$badge_alert_sku ;
    }else{
      $tr_class = "class='shadow-sm p-3 mb-5 rounded ".$style_cancel."' style='background: white;'";
      $task_status = $status ;
      $subtask_sum = $row["sku"];
    }
      if(!isset($ticket)){$ticket="";}
      if(!isset($tr_class)){$tr_class="";}
      $ticket .= "<tr  ".$tr_class." >";
      $ticket .= "<th scope='row' class='new_lob_list' >NS-".$row["id"]."</th>";
      $ticket .= "<td>".$row["department"]."</td>";
      $ticket .= "<td>".$row["brand"]."</td>";
      $ticket .= "<td>".$subtask_sum."</td>";
      // $ticket .= "<td>".$ri_style ."</td>";
      $ticket .= "<td>".$row["production_type"]."</td>";
      $ticket .= "<td>".$row["project_type"]."</td>";
      // $ticket .= "<td>".$row["business_type"]."</td>";
      $ticket .= "<td>".$launch_date."</td>";
      $ticket .= "<td>".$p_badge."</td>";
      $ticket .= "<td>".$task_status ."</td>";
      $ticket .= "<td>";
      $ticket .= "<button type='button' id='ns_ticket_".$row['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row["id"].")' >
       Detail </button></td>";
      $ticket .=  "</tr>";
      //get sub ticket
      $query_count="SELECT count(*) as total from add_new_job where parent = ".$row["id"];
      $result_count = mysqli_query($con, $query_count);
      $data_count=mysqli_fetch_assoc($result_count);
      $subtask_count = $data_count['total'];
      if(isset($subtask_count) and $subtask_count <> 0 and $subtask_count <>null){
        $query_child = "SELECT * FROM add_new_job where parent = ".$row["id"]." order by id ASC"  or die("Error:" . mysqli_error($con));
        date_default_timezone_set("Asia/Bangkok");
        // $con_get_list= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con_get_list));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $result_child = mysqli_query($con, $query_child);
        $i = 1;
        while($row_child = mysqli_fetch_array($result_child)) {
            $ticket_role = role_user($row_child["request_username"],$row_child["follow_up_by"]);
            // $status = badge_status($row_child['status']);
          if($row_child['status']=="accepted" and $row_child['trigger_status'] <> "on-productions"){
            $status=badge_status("on-production");
          }elseif($row_child['status']=="accepted" and $row_child['trigger_status'] == "on-productions"){
            $status=badge_status("on-productions");
          }else{
            $status =badge_status($row_child['status']);
          }
            //important
          if($i<$subtask_count){
            $th_class = "class='tree_lift'";
            $tr_class = "class='sub-ticket'";
          }else{
            $th_class = "class='tree_lift_end'";
            unset($tr_class);
          }
          //check status of brand ticket match with filter or not
          if($_SESSION['status_filter']<>""){
            if($row_child["status"]==$_SESSION['status_filter']){
              //data row
              if(isset($sub_ticket)){
                if(isset($tr_class)){
                  $sub_ticket .= "<tr ".$tr_class.">";
                }else{
                  $sub_ticket .= "<tr >";
                }
              }else{
                if(isset($tr_class)){
                  $sub_ticket = "<tr ".$tr_class.">";
                }else{
                  $sub_ticket = "<tr >";
                }
              }
              $sub_ticket .= "<th scope='row' ".$th_class." ><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].")</span></th>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td>".$row_child["sku"]."</td>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td></td>";
              $sub_ticket .= "<td>".$status."</td>";
              $sub_ticket .= "<td>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row_child["id"].")' >
              Detail </button></td>";
              $i++;
            }
          }else{
               //data row
          if(!isset($sub_ticket)){$sub_ticket ="";}
          if(!isset($tr_class)){$tr_class="";}
          $sub_ticket .= "<tr ".$tr_class.">";
          $sub_ticket .= "<th scope='row' ".$th_class." ><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].")</span></th>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td>".$row_child["sku"]."</td>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td></td>";
          $sub_ticket .= "<td  >".$status."</td>";
          $sub_ticket .= "<td>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row_child["id"].")' >
           Detail </button></td>";
          $i++;
          }
        }
      }
      if($_SESSION['status_filter']<>""){
        if($row["config_type"]=="parent"){
          if( isset($sub_ticket)){
            echo $ticket.$sub_ticket;
          }
        }else{
          if(isset($sub_ticket)){
            echo $ticket.$sub_ticket;
          }else{
            if(isset($ticket)){ echo $ticket;}
          }
        }
       }else{
        if(isset($sub_ticket)){
          echo $ticket.$sub_ticket;
        }else{
          if(isset($ticket)){ echo $ticket;}
        }
       }
       unset($ticket);
       unset($sub_ticket);
       unset($status);
  }
  mysqli_close($con);
  ?>