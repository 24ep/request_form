<?php 
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT 
pb.project_name,
pb.description,
pb.owner,
pb.sticky,
pb.status,
pb.prefix,
ac.profile_url
FROM all_in_one_project.project_bucket as pb 
left join all_in_one_project.account as ac
on pb.owner = ac.username 
where pb.id=".$_POST["id"] or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {

    echo '
        <div class="modal-header" style="border-color: transparent;">
            <h5 class="modal-title" id="exampleModalLabel">'.$row["project_name"].'</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <small>Description<small>
        <p>'.$row["description"].'</p>
        </div>';

}



?>