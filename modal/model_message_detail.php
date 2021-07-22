<?php
$id=$_POST["id"];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT * FROM all_in_one_project.message_box
where id = ".$id." ORDER BY id  DESC " or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $description = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
    echo '<div class="modal-header">
    <h5 class="modal-title" id="messagemodelLabel">'.$row["title"].'</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="messagebody">
    '.$description.'
    </div>';
}


?>