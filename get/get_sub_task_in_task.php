<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM add_new_job where parent =".$id  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
    $i=0;
  while($row = mysqli_fetch_array($result)) {

      $subtask .='
        <tr>
              <td scope="col" style="background: #ededed;"><a href="https://content-service-gate.cdsecommercecontent.ga/homepage.php?tab=v-pills-request_list&fopenticket='.$row["id"].'">
               NS-'.$row["parent"].'-'.$i.' ('.$row["id"].')</a></td>
              <td scope="col" style="background: #ededed;">'. $row["sku"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["status"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["contact_person"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["tell"].'</td>
              <td scope="col" style="background: #ededed;">'. $row["Email"].'</td>
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
<?php } ?>