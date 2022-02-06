<?php 
function badge_status($status){
    if($status=="Pending"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
    }elseif( $status=="Inprogress"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ff9a59;color:white;border:#ff9a59">Inprogress</button>';
    }elseif($status=="Close" or $status=="approved"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#115636">'.$status.'</button>';
    }elseif($status=="Waiting CTO"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">Waiting CTO</button>';
    }elseif($status=="Waiting Execution"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FA9193;color:#white;border:#FA9193">Waiting Execution</button>';
    }elseif($status=="Waiting Buyer"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting buyer</button>';
    }elseif($status=="Inreview"){
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #2bf2ca;color:black;border:#2bf2ca">Inreview</button>';
    }else{
      $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">'.$status.'</button>';
    }
    
  return $status;
  }
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

                    $query_att = "SELECT  att.id, att.file_name, att.file_path, att.is_image, att.file_owner,
                    att.ticket_id, att.ticket_type , cr.ticket_template ,
                    CASE 
                    when att.ticket_type='cr_content_request' then cm.comment
                    else 'Ticket file'
                    end as comment
                    FROM all_in_one_project.attachment as att
                    left join all_in_one_project.content_request cr 
                    on cr.id = att.ticket_id and att.ticket_type = 'content_request'
                    left join all_in_one_project.comment cm 
                    on cm.ticket_id = att.ticket_id  and att.ticket_type = 'cr_content_request'
                    where cr.ticket_template = '".$row["prefix"]."'
                    limit 20";
                    $result_att = mysqli_query($con, $query_att);
                    while($row_att = mysqli_fetch_array($result_att)) {
                        echo '
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">'.$row_att["file_name"].'</h5>
                                <p class="card-text">
                                '.$row_att["comment"].'
                                </p>
                                <small>Ticket no : '.$row_att["ticket_id"].' <small>
                                <small> Download <small>
                                
                            </div>
                        </div>
                        ';
                    }

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
            $status=badge_status($row_task["status"]);
            echo '<tr>';
            echo '<td style="padding:20px">'.$row_task["id"].'</td>';
            echo '<td style="padding:20px">'.$row_task["title"].'</td>';
            echo '<td style="text-align: -webkit-center;padding:20px">'.$status.'</td>';
            echo '<td style="text-align: -webkit-center;padding:20px">'.$row_task["case_officer"].'</td>';
            echo '<td style="text-align: -webkit-center;padding:20px">
            <ion-icon name="ellipsis-horizontal-outline" data-bs-toggle="offcanvas"
            data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle('.$row_task['id'].')"></ion-icon></td>';
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