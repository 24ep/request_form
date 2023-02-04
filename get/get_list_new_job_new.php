<?php
session_start();
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error( $con));
function badge_status($status){
  if($status=="pending"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1shadow-sm" style="background: transparent;color:#5f9ee5;border:#5f9ee5 solid 1px;width: 100%;">pending</span>';
  }elseif($status=="checking"  ){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#ffc107;border:#ffc107 solid 1px;width: 100%;">checking</span>';
  }elseif( $status=="on-productions"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#ff9a59;border:#ff9a59 solid 1px;width: 100%;">on-productions</button>';
  }elseif($status=="approved"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#7befb2;border:#7befb2 solid 1px;width: 100%;">'.$status.'</button>';
  }elseif($status=="waiting confirm"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#499CF7;border:#499CF7 solid 1px;width: 100%;">waiting confirm</span>';
  }elseif($status=="waiting image"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#FE7A6F;border:#FE7A6F solid 1px;width: 100%;">waiting image</button>';
  }elseif($status=="waiting data"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#FE7A6F;border:#FE7A6F solid 1px;width: 100%;">waiting data</button>';
  }elseif($status=="waiting traffic"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#ea79f7;border:#ea79f7 solid 1px;width: 100%;">waiting traffic</button>';
  }elseif($status=="cancel"){
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#efefef;border:#efefef solid 1px;width: 100%;">Cancel</button>';
  }else{
    $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm" style="background: transparent;color:#a9a9a94f;border:#a9a9a94f solid 1px;width: 100%;">'.$status.'</span>';
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
  // $array_status = explode(",",$_SESSION['status_filter']);
  // $array_status_string = "";
  // foreach ($array_status as $value) {
  //   $array_status_string = "'".$value."'";
  // }
  $status_filter_replaced = str_replace(",","','",$_SESSION['status_filter']);
  $status_filter_replaced  = "'".$status_filter_replaced ."'";
  $status_filter ="anj.status in (".$status_filter_replaced.") or anj.status = 'none'";
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
    if($create_date_diff>=10){
      $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1" style="background-color: #d8c5ed!important;color: #673ab7;"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
    }elseif($create_date_diff>=5){
      $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1" style="background-color: #ffcbcb; color: red"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
    }elseif($create_date_diff>=3){
      $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1">Age > '.$create_date_diff.' Days</span>';
    }
    //  launch date
    if($row["launch_date"] <> null){
      $launch_date_c = date_create($row["launch_date"]);
      $launch_date_c = date_format($launch_date_c,"Y-m-d");
      $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
      if($launch_date_diff<=0){
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1" style="background-color: #d8c5ed!important;color: #673ab7;"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon> Over Launch '.($launch_date_diff*(-1)).' days</span>';
      }elseif($launch_date_diff<=5){
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1" style="background-color: #ffcbcb; color: red"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Launch in '.$launch_date_diff.' days</span>';
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
      $tr_class = "class='row sub-ticket shadow-sm p-2 mb-0 rounded ".$style_cancel."' style='background: white;align-items: center;text-align-last: center;'";
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
      $tr_class = "class='row shadow-sm p-2 mb-2 rounded ".$style_cancel."' style='background: white;align-items: center;text-align-last: center;'";
      $task_status = $status ;
      $subtask_sum = $row["sku"];
    }

    if(strpos($task_status,"on-productions")!==false or strpos($task_status,"Cancel")!==false ){
      $p_badge = "";
    }
      if(!isset($ticket)){$ticket="";}
      if(!isset($tr_class)){$tr_class="";}
      $ticket .= "<li  ".$tr_class." >";
      $ticket .= "<div scope='row' class='col new_lob_list' ><strong>NS-".$row["id"]."</strong></div>";
      $ticket .= "<div class='col'>".$row["department"]."</div>";
      $ticket .= "<div class='col'>".$row["brand"]."</div>";
      $ticket .= "<div class='col'>".$subtask_sum."</div>";
      // $ticket .= "<td>".$ri_style ."</td>";
      $ticket .= "<div class='col'>".$row["production_type"]."</div>";
      $ticket .= "<div class='col'>".$row["project_type"]."</div>";
      // $ticket .= "<td>".$row["business_type"]."</td>";
      $ticket .= "<div class='col'>".$launch_date."</div>";
      $ticket .= "<div class='col'>".$p_badge."</div>";
      $ticket .= "<div class='col'>".$task_status ."</div>";
      $ticket .= "<div class='col'>";
      $ticket .= "<button type='button' id='ns_ticket_".$row['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3'  onclick='call_edit_add_new_modal(".$row["id"].")' >
       Detail </button></div>";
      $ticket .=  "</li>";
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
          if($row_child['status']=="on-productions" and $row_child['trigger_status'] <> "on-productions"){
            $status=badge_status("on-productions");
          }elseif($row_child['status']=="on-productions" and $row_child['trigger_status'] == "on-productions"){
            $status=badge_status("on-productions");
          }else{
            $status =badge_status($row_child['status']);
          }
            //important
          if($i<$subtask_count){
            $th_class = "class='col tree_lift p-3'";
            $tr_class = "class='row sub-ticket mb-0'";
          }else{
            $th_class = "class='col tree_lift_end p-3'";
            $tr_class = "class='row mb-2' style='align-items: center;'";
            // unset($tr_class);
          }
          //check status of brand ticket match with filter or not
          if($_SESSION['status_filter']<>""){
            if($row_child["status"]==$_SESSION['status_filter']){
              //data row
              if(isset($sub_ticket)){
                if(isset($tr_class)){
                  $sub_ticket .= "<li ".$tr_class.">";
                }else{
                  $sub_ticket .= "<li class='row mb-2'>";
                }
              }else{
                if(isset($tr_class)){
                  $sub_ticket = "<li ".$tr_class.">";
                }else{
                  $sub_ticket = "<li class='row mb-2' >";
                }
              }
              $sub_ticket .= "<div scope='row' ".$th_class." style='min-width: 250px;' ><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].") ".$row_child["sku"]." SKUs</span></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'></div>";
              $sub_ticket .= "<div class='col'>".$status."</div>";
              $sub_ticket .= "<div class='col'>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3'  onclick='call_edit_add_new_modal(".$row_child["id"].")' >
              Detail </button></div >";
              $i++;
            }
          }else{
               //data row
          if(!isset($sub_ticket)){$sub_ticket ="";}
          if(!isset($tr_class)){$tr_class="";}
          $sub_ticket .= "<li ".$tr_class.">";
          $sub_ticket .= "<div scope='row' ".$th_class." style='min-width: 250px;'><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].") ".$row_child["sku"]." SKUs</span></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col'></div>";
          $sub_ticket .= "<div class='col' >".$status."</div>";
          $sub_ticket .= "<div class='col'>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3' onclick='call_edit_add_new_modal(".$row_child["id"].")' >
           Detail </button></div>";
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