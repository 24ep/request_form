<?php
 session_start();
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM u749625779_cdscontent.job_cms as job 
  left join all_in_one_project.add_new_job as request 
  ON job.csg_request_new_id = request.id
  WHERE job.approved_editing_status <> 'on-productions' and job.job_status_filter <> 'cancel'  and request.request_username = '".$_SESSION['username']."' ";
$query_count = "SELECT count(*)  as total FROM u749625779_cdscontent.job_cms as job 
left join all_in_one_project.add_new_job as request 
ON job.csg_request_new_id = request.id
WHERE job.approved_editing_status <> 'on-productions' and job.job_status_filter <> 'cancel' and request.request_username = '".$_SESSION['username']."' ";
  $result = mysqli_query($con, $query);
  $result_count = mysqli_query($con, $query_count);
  $data=mysqli_fetch_assoc($result_count);
  $count_job_inprogress = $data['total'];
  echo "<h6>ข้อมูลเรียบร้อย อยู่ระหว่างทำคอนเทนต์ <strong> จำนวน ".$count_job_inprogress." งาน</strong></h6>";
  include('function/cal_job_status.php');
    echo 
    "<table class='table  table-hover'>
        <thead style='background: transparent;border: transparent;'>
            <tr style='background: transparent;border: transparent;'>";
    echo "<th scope='row'>job number</th>"; 
    echo "<th>Brand</th>";
    echo "<th>SKU</th>";
    echo "<th>traffic</th>";  
    echo "<th>job state</th>";
    echo "<th>last update</th>";
    echo "<th>Ticket id</th>";
    echo  "</tr>
    </thead>
     <tbody >";
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
; 
        echo "<td>".$row["brand"]."</td>";
        echo "<td>".$row["sku"]."</td>";
        echo "<td>".$row["traffic"]."</td>";
        echo "<td>".$state ."</td>";  
        echo "<td class='timeago' datetime='".$row["last_update_at"]."'>".$row["last_update_at"]."</td>";
        echo "<td>".$row["csg_request_new_id"]."</td>";
        echo "</tr>";
        $pass = true;
    } 
    if($pass==false){
        echo "<tr>";
        echo "<td colspan='6'>เลข job number จะแสดงเมื่อข้อมูลครบถ้วน พร้อมสำหรับการเปิด Job</td>";
        echo  "</tr>";
      }
  echo "</tbody>
  </table>";
  mysqli_close($con);
//   function count_job_inprogress(){
//         include('action/connect.php');
//         $sql="SELECT count(*) FROM u749625779_cdscontent.job_cms as job 
//         left join all_in_one_project.add_new_job as request 
//         ON job.csg_request_new_id = request.id
//         WHERE job.approved_editing_status <> 'on-productions' and request.request_username = '".$_SESSION['username']."' ";
//         $result=mysqli_query($con,$sql);
//         $data=mysqli_fetch_assoc($result);
//         $count = $data['total'];
//         return $count;
//         mysqli_close($con);
//   }
  ?>
