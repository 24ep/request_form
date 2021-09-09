<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM sku_list where csg_id = ".$_POST['id']." ORDER BY id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
    echo 
    "<table class='table table-bordered'>
        <thead>
            <tr>";
    echo "<th scope='row'>sku</th></th>";  
    echo "<th>status</th>";
    echo "<th>update_by</th>";
    echo "<th>create_date</th>";  
    echo "<th>update_date</th>";
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["sku"]."</th>";
        echo "<td style='background: #ededed;'>".$row["status"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["create_by"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["create_date"]."</td>";
        echo "<td style='background: #ededed;'>".$row["updated_date"]."</td>";
        echo "</tr>";
        $pass = true;
    } 
    if($pass==false){
        echo "<tr>";
        echo "<td colspan='7' style='text-align: center;'>ไม่พบ sku สำหรับ ticket ดังกล่าวในฐานข้อมูล</td>";
        echo  "</tr>";
      }
  echo "</tbody>
  </table>";
  mysqli_close($con);
  ?>
