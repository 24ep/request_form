<?php
//issue get
session_start();
$id = $_POST['id'];
include($_SERVER['DOCUMENT_ROOT']."/connect.php");
function get_comment_cr($id){
  global $con;
    $query = "SELECT * FROM attactment WHERE ticket_type = 'content_request' and ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    echo '<ul class="list-group list-group-flush">';
      while($row = mysqli_fetch_array($result)) {
      echo   ' <li class="list-group-item">'.$row["file_name"].'<span class="badge bg-primary rounded-pill">Do</span></li>';
      }
    echo '</ul>';
  }
  get_comment_cr($id);
?>
