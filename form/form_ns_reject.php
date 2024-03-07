<?php
$id = $_POST['id'];
include($_SERVER['DOCUMENT_ROOT'].'/get/get_attribute.php');
?>
<h5><strong><ion-icon name="warning-outline"></ion-icon> REJECT</strong></h5>
<div class="row bg-white">
    <ul class="list-group">
        <?php
            $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
            //Get data 24ep
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT  * FROM all_in_one_project.add_new_job where id = '".$id."'" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
              $query_column = "SELECT `COLUMN_NAME`
              FROM `INFORMATION_SCHEMA`.`COLUMNS`
              WHERE `TABLE_SCHEMA`='all_in_one_project'
              AND `TABLE_NAME`='add_new_job'" or die("Error:" . mysqli_error($con));
              $result_column = mysqli_query($con, $query_column);
              while($row_column = mysqli_fetch_array($result_column)) {
                ${"anj_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
              }
            }
            echo return_s_select_box('approved_editing_status','Reject status',"single_select",$anj_approved_editing_status,'rj_edit_approved_editing_status','',$id,'rj','all_in_one_project','add_new_job','id','0');
            echo return_textarea_box('approved_decline_remark','Reject Note',"textarea",$anj_approved_decline_remark,'rj_edit_approved_decline_remark','',$id,'rj','all_in_one_project','add_new_job','id','0');
            echo return_input_box('approved_decline_date','Reject date',"datetime-local",$anj_approved_decline_date,'rj_edit_approved_decline_date','',$id,'rj','all_in_one_project','add_new_job','id','0');
            echo return_input_box('approved_edited_date','Revised date',"datetime-local",$anj_approved_edited_date,'rj_edit_approved_edited_date','',$id,'rj','all_in_one_project','add_new_job','id','0');
        ?>
    </ul>
</div>
