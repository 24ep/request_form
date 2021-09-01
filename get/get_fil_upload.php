<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT job_number , id, file_name, file_path, create_at,  remark,  file_owner
  FROM u749625779_cdscontent.file_manage as file
  where create_at like '%".$_GET['create_date']."%' and file_type in ('Buyerfile')  ORDER BY job_number DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
    echo 
    "<table class='table table-bordered'>
        <thead>
            <tr>";
    echo "<th scope='row'>job number</th>";  
    echo "<th>file name</th>";
    echo "<th>file owner</th>";
    echo "<th>job_cms_id</th>";
    echo "<th>file_id</th>";
    echo "<th>create date</th>"; 
    echo "<th>Remark</th>"; 
    echo "<th>download</th>";
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
        $herf = str_replace("../..",'https://cdsecommercecontent.ga',$row['file_path'].$row['file_name']);
        // $herf = str_replace(".xlsm",$herf);
        // $herf = str_replace(".xlsx",$herf);
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["job_number"]."</th>";
        echo "<td style='background: #ededed;'>".$row["file_name"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["file_owner"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["job_cms_id"]."</td>";
        echo "<td style='background: #ededed;'>".$row["id"]."</td>";
        echo "<td style='background: #ededed;'>".$row["create_date"]."</td>";
        echo "<td style='background: #ededed;'>".$row["remark"]."</td>";
        echo "<td style='background: #ededed;'><a href='".$herf."' download='".$row["job_number"]." ".$row["file_name"]."'>download</a></td>";
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
