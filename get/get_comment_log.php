<?php
  $query = "SELECT * FROM comment WHERE ticket_type = 'add_new' and ticket_id = 66 ORDER BY id ASC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
   while($row = mysqli_fetch_array($result)) {
    $arr_comment = array('type' => 'comment');
    $arr_comment = array('value' => $row['comment']);
   }
   print_r($arr_comment);
?>