<?php

  date_default_timezone_set("Asia/Bangkok");

  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error:" . mysqli_error( $con));

  mysqli_query($con, "SET NAMES 'utf8' ");

  $query = "SELECT * FROM account where username = ".$_GET['username']." ORDER BY id DESC " or die("Error:" . mysqli_error( $con));

  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {

      echo "username".$row["username"]."<br>";

      echo "firstname".$row["firstname"]."<br>";



  }





?>