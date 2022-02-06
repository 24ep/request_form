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
        <div class="modal-header" style="border-color: transparent;background: #f3f3f3;">
            <h5 class="modal-title" id="exampleModalLabel">'.$row["project_name"].'</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" style="margin:5px">
                <div class="col-8">
                    <small><ion-icon name="people-outline"></ion-icon> Project Owner & Participant</small>
                    <hr>
                    <small><ion-icon name="reader-outline"></ion-icon> Description</small>
                    <p>'.$row["description"].'</p>
                    <hr>
                    <small><ion-icon name="document-attach-outline"></ion-icon> Attachments</small>
                    ';
                    ?>
<?php
                    echo '
                </div>
                <div class="col-4">
                <small>status</small>
                    <select class="form-select" style="border: 0px;background-color: #f5f5f5;"
                    aria-label="Default select example">
                        <option selected value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
            </div>
        </div>';


        echo'
        <table class="table">
        <thead class="table-light">
        <tr>
            <th style="text-align: -webkit-center;border:0px">ID</th>
            <th style="width: 50%;text-align: -webkit-center;border:0px">Task</th>
            <th style="text-align: -webkit-center;border:0px">status</th>
            <th style="text-align: -webkit-center;border:0px">Owner</th>
            <th style="text-align: -webkit-center;border:0px">Action</th>
        </tr>
        </thead>
        <tbody>';

        $query_task = "SELECT title,status,case_officer,id from all_in_one_project.content_request where status <> 'Close' and ticket_template='".$row["prefix"]."'";
        $result_task = mysqli_query($con, $query_task);
        while($row_task = mysqli_fetch_array($result_task)) {
            echo '<tr>';
            echo '<td>'.$row_task["id"].'</td>';
            echo '<td>'.$row_task["title"].'</td>';
            echo '<td style="text-align: -webkit-center;">'.$row_task["status"].'</td>';
            echo '<td style="text-align: -webkit-center;">'.$row_task["case_officer"].'</td>';
            echo '<td style="text-align: -webkit-center;"><ion-icon name="ellipsis-horizontal-outline"></ion-icon></td>';
            echo '</tr>';
        }

        echo '
        </tbody>
        </table>
        ';

        // echo '
        // <div class="modal-header" style="border-color: transparent;background: #f3f3f3;">
            
        //     <h5 class="modal-title" id="exampleModalLabel"><ion-icon name="file-tray-stacked-outline"></ion-icon> Task</h5>
        // </div>
        // <div class="container-sm">
          
        // </div>
        // ';

}



?>