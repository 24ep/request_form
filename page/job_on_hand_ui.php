<!--  -->
<?php
  session_start();
$database = 'all_in_one_project';
            $table = 'account';
            $primary_key_id = 'username';
            $id=$_SESSION['username'];
            $prefix_table = 'ac';
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));

                $query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."'" or die("Error:" . mysqli_error($con));
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)) {
                    $query_column = "SELECT `COLUMN_NAME`
                    FROM `INFORMATION_SCHEMA`.`COLUMNS`
                    WHERE `TABLE_SCHEMA`='".$database."'
                        AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
                    $result_column = mysqli_query($con, $query_column);
                    while($row_column = mysqli_fetch_array($result_column)) {
                        ${$prefix_table."_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
                    }
                }
            ?>

<nav class="nav">
  <a class="nav-link active" aria-current="page" href="#">Active</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled">Disabled</a>
</nav>
<div class="row job_on_hand_list" >
    <div class="col-3 bg-white shadow-sm pe-0 ps-0 mt-0  ms-0 m-0 border-end">
        <div id="get_list_job_on_hand_pending">
        </div>
    </div>
    <div class="col-9 p-0">
        <div id="panel_detail">

        </div>
    </div>

</div>

<script>
    // get_detail_more
function get_list_job_on_hand(ac_role,status,ac_username,ac_nickname) {
    $.post("base/get/get_list_job_on_hand.php", {
            ac_role: ac_role,
            ac_username: ac_username,
            ac_nickname :ac_nickname,
            status:status
        },
        function(data) {
            $('#get_list_job_on_hand_'+status).html(data);
            //Notiflix.Loading.remove();
        });

}
    get_list_job_on_hand('<?php echo $ac_role; ?>','pending','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','inprogress','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','waiting','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','revise','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','revised','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
function interval_run(){
    // Notiflix.Notify.info('Refreshing ..');
    get_list_job_on_hand('<?php echo $ac_role; ?>','pending','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','inprogress','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','waiting','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','revise','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>','revised','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');

}

var time = new Date(),
    secondsRemaining = (60 - time.getSeconds()) * 1000;

setTimeout(function() {
    setInterval(interval_run, 10000000);
}, secondsRemaining);


function call_edit_add_new_panel(id, brand) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("../base/page/ns_detail.php", {
            id: id
        }, function(data) {
            $('#panel_detail').html(data);
            Notiflix.Loading.remove();
        });
    }
}
</script>