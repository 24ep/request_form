<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_tg = "SELECT message_box.id as id, target.target_username as username, target.readable as readable, target.accepted_date as accepted_date, target.read_date as read_date, target.create_date as create_date, target.update_date as update_date, target.msid as msid, message_box.title as title,message_box.description as description 
  FROM all_in_one_project.target_message_box as target
  left join all_in_one_project.message_box as message_box on target.msid = message_box.id where target.target_username = '".$_SESSION["username"]."' ORDER BY message_box.id  DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query_tg);
  while($row = mysqli_fetch_array($result)) {
    //   if($row["important"]==1){
    //     $important = '<ion-icon name="star"></ion-icon>';
    //   }else{
    //     unset($important);
    //   }
        echo "<tr class='shadow-sm p-3 mb-5 bg-body rounded' style='border-bottom: 1px solid #e0e0e0;>";
        echo "<td ></td>";
        echo "<td >".$row["id"]."</td>";
        echo "<td >".$row["title"]."</td>";  
        echo "<td ><button type='button' class='btn btn-warning btn-sm'>ตรวจสอบ</button></td>";
        echo "</tr>";
    } 

  mysqli_close($con); 
  ?>
