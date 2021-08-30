<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT att.id as id,
  att.file_name as file_name,
  att.file_path as file_path,
  att.file_size as file_size,
  att.file_type as file_type,
  att.is_image as is_image,
  att.file_owner as file_owner,
  att.ticket_id as ticket_id,
  att.ticket_type as ticket_type,
  att.create_date as create_date,
  js.job_number as job_number
  FROM all_in_one_project.attachment as att
  left join u749625779_cdscontent.job_cms as js
  on att.ticket_id = js.csg_request_new_id 
  where create_date like '%".$_GET['create_date']."%' and ticket_type = '".$_GET['ticket_type']."'  ORDER BY job_number DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
    echo 
    "<table class='table table-bordered'>
        <thead>
            <tr>";
    echo "<th scope='row'>job number</th>";  
    echo "<th>file name</th>";
    echo "<th>file owner</th>";
    echo "<th>ticket_id</th>";
    echo "<th>create date</th>";  
    echo "<th>download</th>";
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["job_number"]."</th>";
        echo "<td style='background: #ededed;'>".$row["file_name"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["file_owner"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["ticket_id"]."</td>";
        echo "<td style='background: #ededed;'><a target='_Blank' href='".$row["file_path"]."' download>download</a></td>";
        echo "</tr>";
        $pass = true;
    } 
    if($pass==false){
        echo "<tr>";
        echo "<td colspan='7' style='text-align: center;'>เลข job number จะแสดงเมื่อข้อมูลครบถ้วน พร้อมสำหรับการเปิด Job</td>";
        echo  "</tr>";
      }
  echo "</tbody>
  </table>";
  mysqli_close($con);
  ?>
