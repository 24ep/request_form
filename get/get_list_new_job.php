<style>
.tree_label {
    position: relative;
    display: inline-block;
    background: transparent;
    color: #727476;
    vertical-align: -webkit-baseline-middle;
}

.tree_label:after {
  position: absolute;
    top: 0em;
    left: -25%;
    display: block;
    height: 50%;
    width: 20%;
    border-bottom: 2px solid #727476;
    border-left: 2px solid #727476;
    border-radius: 0 0 0 .4em;
    content: '';
}

.tree_lift {
   /* position: absolute;
    padding-left: 20.5px !important;
    border-left: 2px solid #727476;
    margin-left: 2.5%;
    height: 65px; */
    position: relative;
    left: 67px !important;
    border-left: 2px solid #727476;
    margin-left: 2.5%;
}

.tree_lift_end {
  /* position: absolute;
    padding-left: 21.5px !important;
    border-left: 2px solid transparent;
    margin-left: 2.5%;
    height: 5%; */
    position: relative;
    left: 67px !important;
    border-left: 2px solid transparent;
    margin-left: 2.5%;
    height: 0px
    
}

.sub-ticket{
		  border:0px solid transparent
	  }
label.tree_label:hover {
    color: #666;
}
</style>

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
  $brand_filter ="brand like '%".$_SESSION['brand_filter']."%' or id = ".str_replace('NS-','',$_SESSION['brand_filter']);
 }else{
  $brand_filter ="1=1";
 }
 if($_SESSION['fopenticket']<>""){
  $query = "SELECT * FROM add_new_job where id =".$_SESSION['fopenticket']."  ORDER BY id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error());
  unset($_SESSION['fopenticket']);
 }else{
  $query = "SELECT * FROM add_new_job where ((".$status_filter.") and (".$brand_filter.")
         and (".$position_filter.")) and parent is null ORDER BY id DESC LIMIT 30 OFFSET ".$start_item  or die("Error:" . mysqli_error());
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
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
    }elseif($row["status"]=="checking"){
      $status_style = 'style="background: #ffff7e;color:#997300"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ffff7e;color:#997300;border:#ffff7e">checking</button>';
    }elseif($row["status"]=="accepted"){
      $status_style = 'style="background: #7befb2;color:#115636"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#115636">accepted</button>';
    }elseif($row["status"]=="waiting confirm"){
      $status_style = 'style="background: #499CF7;color:#093f8e"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">waiting confirm</button>';
    }elseif($row["status"]=="waiting image"){
      $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting image</button>';
    }elseif($row["status"]=="waiting data"){
      $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting data</button>';
    }elseif($row["status"]=="waiting traffic"){
      $status_style = 'style="background: #ea79f7;color:#6a2e71"';
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">waiting traffic</button>';
    }
    if($row['request_important']=="Urgent"){
      $ri_style = '<span class="badge rounded-pill bg-danger" style="margin-left:5px">'.$row['request_important'].'</span>';
    }else{
      $ri_style = '<span class="badge rounded-pill bg-secondary" style="margin-left:5px">'.$row['request_important'].'</span>';
    }
  if($row['launch_date']<>""){
    $launch_date = date('d/m/y',strtotime($row['launch_date']));
  }else{
    $launch_date = "<span style='color:#E0E0E0'>No launch date</span>";
  }

  if($row["config_type"]=="parent"){
    $tr_class = "class='sub-ticket shadow-sm p-3 mb-5 bg-body rounded' style='border-bottom: 1px solid #e0e0e0;'";
    $task_status = '';
    $query_sum="SELECT sum(sku) as total from add_new_job where parent = ".$row["id"];
    $result_sum = mysqli_query($con, $query_sum);
    $data_sum=mysqli_fetch_assoc($result_sum);
    $subtask_sum = $row["sku"]." S(".$data_sum['total'].")";
  }else{
    $tr_class = "class='shadow-sm p-3 mb-5 bg-body rounded' style='border-bottom: 1px solid #e0e0e0;'";
    $task_status = $status ;
    $subtask_sum = $row["sku"];
  }

      echo "<tr ".$tr_class." >";
      echo "<th scope='row'>NS-".$row["id"]."</th>";
      echo "<td>".$row["department"]."</td>";
      // echo "<td>".date('d/m/y h:i A',strtotime($row['create_date']))."</td>";
      echo "<td>".$row["brand"]."</td>";
      echo "<td>".$subtask_sum."</td>";
      echo "<td>". $ri_style ."</td>";
      
      echo "<td>".$row["production_type"]."</td>";
      echo "<td>".$row["project_type"]."</td>";
      echo "<td>".$row["business_type"]."</td>";
      echo "<td>".$launch_date."</td>";
      echo "<td >". $task_status ."</td>";
      echo "<td>". $ticket_role ."</td>";
      echo "<td>";
      echo "<button type='button' id='ns_ticket_".$row['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row["id"].")' >
       Detail </button></td>";
      echo  "</tr>";

      //get sub ticket
      $query_count="SELECT count(*) as total from add_new_job where parent = ".$row["id"];
      $result_count = mysqli_query($con, $query_count);
      $data_count=mysqli_fetch_assoc($result_count);
      $subtask_count = $data_count['total'];
      $query_child = "SELECT * FROM add_new_job where parent = ".$row["id"]." order by id ASC"  or die("Error:" . mysqli_error());
      date_default_timezone_set("Asia/Bangkok");
      $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
      mysqli_query($con, "SET NAMES 'utf8' ");
      $result_child = mysqli_query($con, $query_child);
      $i = 1;
      while($row_child = mysqli_fetch_array($result_child)) {
            //check guest
          if($_SESSION['username']==$row_child["request_username"]){
            $ticket_role = "Owner";
          }elseif($_SESSION['username']==$row_child["follow_up_by"]){
            $ticket_role = "officer";
          }else{
            $ticket_role = "participant";
          }
          //stamp color status
          if($row_child["status"]=="pending"){
            $status_style = 'style="background: #a9a9a94f;color:#8f8f8f"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
          }elseif($row_child["status"]=="checking"){
            $status_style = 'style="background: #ffff7e;color:#997300"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ffff7e;color:#997300;border:#ffff7e">checking</button>';
          }elseif($row_child["status"]=="accepted"){
            $status_style = 'style="background: #7befb2;color:#115636"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#ffff7e">accepted</button>';
          }elseif($row_child["status"]=="waiting confirm"){
            $status_style = 'style="background: #499CF7;color:#093f8e"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">waiting confirm</button>';
          }elseif($row_child["status"]=="waiting image"){
            $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting image</button>';
          }elseif($row_child["status"]=="waiting data"){
            $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting data</button>';
          }elseif($row_child["status"]=="waiting traffic"){
            $status_style = 'style="background: #ea79f7;color:#6a2e71"';
            $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">waiting traffic</button>';
          }
 

        if($i<$subtask_count){
          $th_class = "class='tree_lift'";
          $tr_class = "class='sub-ticket'";
        }else{
          
          $th_class = "class='tree_lift_end'";
          unset($tr_class);
        }
        //data row
        echo "<tr ".$tr_class.">";
        echo "<th scope='row' ".$th_class." ><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].")</span></th>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>".$row_child["sku"]."</td>";
        echo "<td></td>";
        
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td  >".$status."</td>";
        echo "<td>". $ticket_role ."</td>";
        echo "<td>";
        echo "<button type='button' id='ns_ticket_".$row_child['id']."' class='btn btn-dark btn-sm' data-bs-toggle='offcanvas' data-bs-target='#edit_add_new' aria-controls='offcanvasExample' onclick='call_edit_add_new_modal(".$row_child["id"].")' >
         Detail </button></td>";
        echo  "</tr>";
        $i++;
      }

  }
  ?>