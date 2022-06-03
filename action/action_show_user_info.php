<?php

  date_default_timezone_set("Asia/Bangkok");
  $con = mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or  die("Error:" . mysqli_error($con));
  $query = "SELECT * FROM account where username = '".$_GET['username']."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {

      echo "user id : ".$row["id"]."<br>";

      echo "username : ".$row["username"]."<br>";

      echo "firstname : ".$row["firstname"]."<br>";

      echo "lastname : ".$row["lastname"]."<br>";

      echo "nickname : ".$row["nickname"]."<br>";

      echo "work-email : ".$row["workemail"]."<br>";



  }





?>