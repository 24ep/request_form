<?php
 session_start();
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT 
  add_new.id as id,
  add_new.sku as sku,
  add_new.status as status,
  account.firstname as firstname,
  account.lastname as lastname,
  account.nickname as nickname,
  account.work_email as work_email,
  account.office_tell as office_tell,
  add_new.parent as parent
  FROM add_new_job as add_new left join account as account on add_new.follow_up_by = account.username  where parent =".$id  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
    $i=1;
  while($row = mysqli_fetch_array($result)) {
     //stamp color status
     if($row["status"]=="pending"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
    }elseif($row["status"]=="checking"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ffff7e;color:#997300;border:#ffff7e">checking</button>';
    }elseif($row["status"]=="accepted"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#115636">accepted</button>';
    }elseif($row["status"]=="waiting confirm"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">waiting confirm</button>';
    }elseif($row["status"]=="waiting image"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting image</button>';
    }elseif($row["status"]=="waiting data"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting data</button>';
    }elseif($row["status"]=="waiting traffic"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">waiting traffic</button>';
    }else{
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">'.$row["status"].'</button>';
    }
    //end
    if($row["firstname"]==""){
      $subtask .='
        <tr >
              <td ><a href="https://content-service-gate.cdse-commercecontent.com/base/homepage.php?tab=v-pills-request_list&fopenticket='.$row["id"].'">
               NS-'.$row["parent"].'-'.$i.' ('.$row["id"].')</a></td>
              <td >'. $row["sku"].'</td>
              <td >'. $status .'</td>
              <td  colspan="3" >กำลังรอการยืนยัน content person ที่จะมาดูแล ticket นี้</td>
              
        </tr>
      ';

    }else{
      $subtask .='
        <tr >
              <td ><a href="https://content-service-gate.cdse-commercecontent.com/base/homepage.php?tab=v-pills-request_list&fopenticket='.$row["id"].'">
               NS-'.$row["parent"].'-'.$i.' ('.$row["id"].')</a></td>
              <td>'. $row["sku"].'</td>
              <td >'.$status.'</td>
              <td >'. $row["firstname"].' '. $row["lastname"].' ('.$row["nickname"].')</td>
              <td >'. $row["office_tell"].'</td>
              <td >'. $row["work_email"].'</td>
        </tr>
      ';
    }
    $i++;
  }
if($subtask<>""){
?>

<h6><strong>Sub-Ticket</strong></h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">sku</th>
            <th scope="col">status</th>
            <th scope="col">contact person</th>
            <th scope="col">Tell</th>
            <th scope="col">Email</th>

        </tr>
    </thead>
    <tbody class="shadow-sm">

        <?php echo $subtask; ?>

    </tbody>
</table>
<?php } ?>