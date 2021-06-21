<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM job_cms where csg_request_new_id = ".$_POST['id']." ORDER BY id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  include('../function/cal_job_status.php');
    echo 
    "<table class='table table-bordered'>
        <thead>
            <tr>";
    echo "<th scope='row'>job number</th>";  
    echo "<th>job type</th>";
    echo "<th>traffic</th>";  
    echo "<th>job state</th>";
    echo "<th>datapump</th>";
    echo "<th>last update</th>";
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
       $state = cal_status(
       $row["job_status_filter"]
      ,$row["approved_editing_status"]
      ,$row["transfer_type"]
      ,$row["content_complete_date"]
      ,$row["approved_by"]
      ,$row["production_type"]
      ,$row["retouch_complete_date"]
      ,$row["upload_image_date"]
      ,$row["shoots_complete_date"]);
        echo "<tr>";
        echo "<th scope='row'>".$row["job_number"]."</th>";
        echo "<td>".$row["job_type"]."</dh>";  
        echo "<td>".$row["traffic"]."</td>";
        echo "<td>".$state ."</td>";  
        echo "<td>".$row["datapump"]."</td>";
        echo "<td>".$row["last_update_at"]."</td>";
        echo "</tr>";
        $pass = true;
    } 
    if($pass==false){
        echo "<tr>";
        echo "<td colspan='6' style='text-align: center;'>เลข job number จะแสดงเมื่อข้อมูลครบถ้วน พร้อมสำหรับการเปิด Job</td>";
        echo  "</tr>";
      }
  echo "</tbody>
  </table>";
  mysqli_close($con);
  ?>
