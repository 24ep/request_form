<?php

  session_start();
  if($_POST["prefix_project_sticky"]<>""){
    $_SESSION["prefix_project_sticky"] = $_POST["prefix_project_sticky"];
  }else{
    if($_SESSION["prefix_project_sticky"]==""){
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
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
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT pb.prefix,pb.project_name,count(cr.id) as count_ticket
  FROM all_in_one_project.project_bucket as pb
  left join all_in_one_project.content_request as cr
  on cr.ticket_template = pb.prefix and lower(cr.status) not in ('close','cancel','archive') 
  group by pb.prefix , pb.project_name
  order by pb.prefix  ASC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
    if(strpos( $_SESSION["prefix_project_sticky"],$row['prefix'])!==false){
        echo '
        <input type="checkbox" class="btn-check"  value="'.$row["prefix"].'"  name="bucket_checking" id="'.$row["prefix"].'" autocomplete="off" checked>
        <label  onclick="update_project_sticky_badge(&#39;'.$row["prefix"].'&#39;);" class="btn btn-outline-dark btn-sm bk-cr shadow-sm btn-bucket-cr " for="'.$row["prefix"].'" >
        '.$row["project_name"].'
        <span class="badge rounded-pill bg-danger">'.$row["count_ticket"].'</span>
        </label>
    ';
    }else{
        echo '
        <input type="checkbox" class="btn-check"  value="'.$row["prefix"].'" name="bucket_checking" id="'.$row["prefix"].'" autocomplete="off">
        <label  onclick="update_project_sticky_badge(&#39;'.$row["prefix"].'&#39;);" class="btn btn-outline-dark btn-sm bk-cr shadow-sm btn-bucket-cr " for="'.$row["prefix"].'">
        '.$row["project_name"].'
        <span class="badge rounded-pill bg-danger">'.$row["count_ticket"].'</span>
        </label>
    ';
    }
    
  }

?>