<?php
session_start();
if( $_GET["fopenticket"]<>""){
  $_SESSION["fopenticket"]=$_GET["fopenticket"];
}
if($_POST["from_post"] ==true ){
  $_SESSION["user_filter"] = $_POST["user_filter"];
  $_SESSION["status_filter"] = $_POST["status_filter"];
  $_SESSION['pagenation'] = $_POST["pagenation_input"];
  $_SESSION['brand_filter'] = $_POST["brand_filter"];
}
  // $pagenation = $_GET["pagenation"];
  $start_item =  ($_SESSION['pagenation'] -1 )* 30;
 if(strpos($_SESSION["page_view"],'Followup')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%,".$_SESSION["user_filter"]."' or  participant like '".$_SESSION["user_filter"].",%' or  participant = '".$_SESSION["user_filter"]."' or  participant like '%,".$_SESSION["user_filter"].",%'";
   }else{
    $position_filter = "(follow_up_by ='' or follow_up_by is null)";
   }
 }elseif(strpos($_SESSION["page_view"],'Buyer')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%,".$_SESSION["user_filter"]."' or  participant like '".$_SESSION["user_filter"].",%' or  participant = '".$_SESSION["user_filter"]."' or  participant like '%,".$_SESSION["user_filter"].",%'";
   }else{
    $position_filter ="(request_username ='' or request_username is null)";
   }
 }else{
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%,".$_SESSION["user_filter"]."' or  participant like '".$_SESSION["user_filter"].",%' or  participant = '".$_SESSION["user_filter"]."' or  participant like '%,".$_SESSION["user_filter"].",%'";
   }else{
    $position_filter ="1=1";
   }
 }
 if($_SESSION['status_filter']<>""){
  $status_filter ="status like '%".$_SESSION['status_filter']."%'";
 }else{
  $status_filter ="1=1";
 }
 if($_SESSION['brand_filter']<>""){
  $brand_filter ="brand like '%".$_SESSION['brand_filter']."%'";
 }else{
  $brand_filter ="1=1";
 }
 if($_SESSION['fopenticket']<>""){
  $query = "SELECT * FROM add_new_job where id =".$_SESSION['fopenticket']." ORDER BY id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error());
  unset($_SESSION['fopenticket']);
 }else{
  $query = "SELECT * FROM add_new_job where ".$status_filter." and ".$brand_filter."
         and ".$position_filter." ORDER BY id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error());
 }
//  echo "<script>console.log('".$filter_ns_list."');</script>";
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  // $query = "SELECT * FROM add_new_job where ".$status_filter." and ".$brand_filter."
  //        and ".$position_filter." ORDER BY id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  echo '<script>console.log("'.htmlspecialchars(stripslashes(str_replace(array("\r", "\n"), '', var_export($query, true)))).'")</script>';
  while($row = mysqli_fetch_array($result)) {
    //check guest
    if($_SESSION['username']==$row["request_username"]){
      $ticket_role = "Owner";
    }elseif($_SESSION['username']==$row["follow_up_by"]){
      $ticket_role = "officer";
    }else{
      $ticket_role = "participant";
    }
    //stamp color status
    if($row["status"]=="pending"){
      $status_style = 'style="background: #a9a9a94f;color:#8f8f8f"';
    }elseif($row["status"]=="checking"){
      $status_style = 'style="background: #ffff7e;color:#997300"';
    }elseif($row["status"]=="accepted"){
      $status_style = 'style="background: #7befb2;color:#115636"';
    }elseif($row["status"]=="waiting confirm"){
      $status_style = 'style="background: #499CF7;color:#093f8e"';
    }elseif($row["status"]=="waiting image"){
      $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting data"){
      $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting traffic"){
      $status_style = 'style="background: #ea79f7;color:#6a2e71"';
    }
    if($row['request_important']=="Urgent"){
      $ri_style = '<span class="badge rounded-pill bg-danger" style="margin-left:5px">'.$row['request_important'].'</span>';
  }else{
    $ri_style = '<span class="badge rounded-pill bg-secondary" style="margin-left:5px">'.$row['request_important'].'</span>';
  }
  if($row['launch_date']<>""){
    $launch_date = date('d/m/y',strtotime($row['launch_date']));
  }else{
    $launch_date = "No launch date";
  }
      echo "<tr>";
      echo "<th scope='row'>NS-".$row["id"]."</th>";
      echo "<td>".$row["department"]."</td>";
      // echo "<td>".date('d/m/y h:i A',strtotime($row['create_date']))."</td>";
      echo "<td>".$row["brand"]."</td>";
      echo "<td>".$row["sku"]."</td>";
      echo "<td>". $ri_style ."</td>";
      
      echo "<td>".$row["production_type"]."</td>";
      echo "<td>".$row["project_type"]."</td>";
      echo "<td>".$row["business_type"]."</td>";
      echo "<td>".$launch_date."</td>";
      echo "<td ".$status_style." ><strong>".$row["status"]."</strong></td>";
      echo "<td>". $ticket_role ."</td>";
      echo "<td>";
      echo "<button type='button' id='ns_ticket_".$row['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row["id"].")' >
      Detail</button></td>";
      echo  "</tr>";
  }
  ?>
