<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>file as of <?php echo $_GET['create_date']; ?></title>
  </head>
  <body>



<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT file.job_number , job_cms.brand , job_cms.sku ,file.id, file.file_name, file.file_path, file.create_at,  file.remark,  file.file_owner
  FROM u749625779_cdscontent.file_manage as file
  left join u749625779_cdscontent.job_cms as job_cms
  on job_cms.job_number = file.job_number
  where file.create_at like '%".$_GET['create_date']."%' and file.file_type in ('Buyerfile') ORDER BY job_number ASC" or die("Error:" . mysqli_error());
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
        $herf = $row['file_path'].$row['file_name'];
        // $herf = str_replace(".xlsm",$herf);
        // $herf = str_replace(".xlsx",$herf);
        $brand = str_replace("'",$row["brand"]);
        $name_download = $row["job_number"]." ".$brand." ".$row["sku"]." SKU ____".$row['file_name'];
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["job_number"]."</th>";
        echo "<td style='background: #ededed;'>".$row["file_name"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["file_owner"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["job_cms_id"]."</td>";
        echo "<td style='background: #ededed;'>".$row["id"]."</td>";
        echo "<td style='background: #ededed;'>".$row["create_at"]."</td>";
        echo "<td style='background: #ededed;'>".$row["remark"]."</td>";
        echo "<td style='background: #ededed;'><a href='".$herf."' download='".$name_download."'>download</a></td>";
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
-->
</body>
</html>
