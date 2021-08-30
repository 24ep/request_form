<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT att.id as id,
  att.file_name as file_name,
  att.file_path as file_path,
  att.file_size as file_size,
  att.file_type as file_type,
  att.is_image as file_type,
  att.file_owner as file_owner,
  att.ticket_id as ticket_id,
  att.ticket_type as ticket_type,
  att.create_date as create_date,
  js.job_number as job_number,
  cm.ticket_id as csg_id
  FROM all_in_one_project.attachment as att
  left join all_in_one_project.comment as cm
  on cm.id = att.ticket_id 
  left join u749625779_cdscontent.job_cms as js
  on cm.ticket_id = js.csg_request_new_id 
  where att.create_date like '%".$_GET['create_date']."%' and att.ticket_type = '".$_GET['ticket_type']."' and js.job_number is not null  ORDER BY js.job_number DESC" or die("Error:" . mysqli_error());
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
        $herf = str_replace("../..",'https://cdsecommercecontent.ga',$row['file_path'].$row['file_name']);
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["job_number"]."</th>";
        echo "<td style='background: #ededed;'>".$row["file_name"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["file_owner"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["ticket_id"]."</td>";
        echo "<td style='background: #ededed;'>".$row["create_date"]."</td>";
        echo "<td style='background: #ededed;'><a target='_Blank' href='".$herf."' download='".$row["job_number"]." ".$row["file_name"]."'>download</a></td>";
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
