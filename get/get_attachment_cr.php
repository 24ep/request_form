<?php
//issue get
session_start();
$id = $_POST['id'];
function get_comment_cr($id){
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM attactment WHERE ticket_type = 'content_request' and ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    echo '<ul class="list-group list-group-flush">';
      while($row = mysqli_fetch_array($result)) {
      echo   ' <li class="list-group-item">'.$row["file_name"].'<span class="badge bg-primary rounded-pill">Do</span></li>';
      }
    echo '</ul>';
  }
  get_comment_cr($id);
?>
