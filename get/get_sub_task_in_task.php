<?php
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
  account.office_tell as office_tell
  FROM add_new_job as add_new left join account as account on add_new.follow_up_by = account.username  where parent =".$id  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
    $i=1;
  while($row = mysqli_fetch_array($result)) {

      $subtask .='
        <tr>
              <td scope="col" style="background: #ededed;"><a href="https://content-service-gate.cdsecommercecontent.ga/homepage.php?tab=v-pills-request_list&fopenticket='.$row["id"].'">
               NS-'.$row["parent"].'-'.$i.' ('.$row["id"].')</a></td>
              <td scope="col" style="background: #ededed;">'. $row["sku"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["status"].'</td>
              <td scope="col" style="background: #ededed;"></td>
              <td scope="col" style="background: #ededed;">'. $row["office_tell"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["work_email"].'</td>
        </tr>
      ';
    $i++;
  }
if($subtask<>""){

?>

<h6><strong>Sub ticket</strong> - <small class="card-text">Contact person</small></h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">sku</th>
            <th scope="col">status</th>
            <th scope="col">contact person</th>
            <th scope="col">Tell</th>
            <th scope="col">Email</th>

        </tr>
    </thead>
    <tbody>

        <?php echo $subtask; ?>

    </tbody>
</table>
<?php }else{ ?>
<h6><strong>Contact Person</strong> | <small class="card-text">Content & Studio Team - Follow up</small></h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Tell</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php if($follow_up_name==""){
                      echo '<td colspan="3" style="text-align: center;" >กำลังรอการยืนยัน content person ที่จะมาดูแล ticket นี้</td>';
                  }else{
                      echo '<td scope="col" style="background: #ededed;">'. $follow_up_name.'</td>
                            <td scope="col" style="background: #ededed;">'. $office_tell.'</td>
                            <td scope="col" style="background: #ededed;">'. $work_email.'</td>';
                  }?>

        </tr>
    </tbody>
</table>
<?php



} ?>