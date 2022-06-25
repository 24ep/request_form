<?php

  session_start();
  if($_POST["prefix_project_sticky"]<>""){
    $_SESSION["prefix_project_sticky"] = $_POST["prefix_project_sticky"];
  }else{
    if($_SESSION["prefix_project_sticky"]==""){
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query_default = "SELECT * FROM project_bucket where status <> 'Close' and `default` = 1 ORDER BY id asc" or die("Error:" . mysqli_error($con));
        $result_de = mysqli_query($con, $query_default);
        $_SESSION["prefix_project_sticky"]="'OO'";
        while($row_de = mysqli_fetch_array($result_de)) {
            $_SESSION["prefix_project_sticky"] .= ",'".$row_de["prefix"]."'";
        }
    
      
    }else{
      $_SESSION["prefix_project_sticky"] = $_SESSION["prefix_project_sticky"];
    }
  }

  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT pb.id,pb.project_name,
  pb.description,
  pb.owner,
  pb.sticky,
  pb.status,
  pb.prefix,
  pb.color_project
  FROM all_in_one_project.project_bucket as pb order by pb.sticky DESC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

//   echo '
//         <input type="checkbox" class="btn-check" name="bucket_checking" id="all" autocomplete="off">
//         <label onclick="update_project_sticky_badge()" class="btn btn-outline-primary btn-sm bk-cr" for="all">Show all</label>
//     ';
  while($row = mysqli_fetch_array($result)) {
    if(strpos( $_SESSION["prefix_project_sticky"],$row['prefix'])!==false){
        echo '
        <input type="checkbox" class="btn-check" value="'.$row["prefix"].'"  name="bucket_checking" id="'.$row["prefix"].'" autocomplete="off" checked>
        <label onclick="update_project_sticky_badge()"  class="btn btn-outline-primary btn-sm bk-cr shadow-sm" for="'.$row["prefix"].'" >'.$row["project_name"].'</label>
    ';
    }else{
        echo '
        <input type="checkbox" class="btn-check" value="'.$row["prefix"].'" name="bucket_checking" id="'.$row["prefix"].'" autocomplete="off">
        <label onclick="update_project_sticky_badge()"  class="btn btn-outline-primary btn-sm bk-cr shadow-sm" for="'.$row["prefix"].'">'.$row["project_name"].'</label>
    ';
    }
    
  }

?>