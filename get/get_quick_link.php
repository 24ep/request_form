<?php
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT * from quick_link" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo '
    <div class="card">
        <div class="card-body">
        <a href="'.$row["link"].'" target="_blank" ><h5 class="card-header">'.$row["label"].'</h5></a>
                '.$row["description"].'
            </div>
        </div>';
}
    
?>