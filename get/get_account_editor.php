<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");

    $query =  "SELECT * FROM all_in_one_project.account where username = '".$_SESSION['username']."'";

    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $nickname = $row["nickname"];
        $work_email = $row["work_email"];
        $office_tell = $row["office_tell"];
        $pf_theam = $row["pf_theam"];
    }

?>

<h2><?php echo ucwords($firstname)." ".ucwords($lastname);?></h2>
<hr>