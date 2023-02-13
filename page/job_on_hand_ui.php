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

<nav class="nav p-2 bg-light shadow" style="border-bottom: 1px solid #e3e3e3;">
    <a class="nav-link active" aria-current="page" onclick="get_list_job_on_hand('<?php echo $ac_role; ?>', 'pending', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');">Pending</a>
    <a class="nav-link" onclick="get_list_job_on_hand('<?php echo $ac_role; ?>', 'inprogress', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');">Inprogress</a>
    <a class="nav-link" onclick="get_list_job_on_hand('<?php echo $ac_role; ?>', 'waiting', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');">Waiting</a>
    <a class="nav-link" onclick="get_list_job_on_hand('<?php echo $ac_role; ?>', 'revise', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');">Revise</a>
    <a class="nav-link" onclick="get_list_job_on_hand('<?php echo $ac_role; ?>', 'revised', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');">Revised</a>

    <div class="position-absolute end-0 me-3">
        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
</nav>
<div class="row job_on_hand_list">
    <div class="col-3 bg-secondary bg-opacity-10 shadow-sm pe-0 ps-0 mt-0  ms-0 m-0 border-end">
        <div id="get_list_job_on_hand">
        </div>
    </div>
    <div class="col-9 p-0">
        <div id="panel_detail">

        </div>
    </div>

</div>

<script>
// get_detail_more
function get_list_job_on_hand(ac_role, status, ac_username, ac_nickname) {
    $.post("base/get/get_list_on_hand.php", {
            ac_role: ac_role,
            ac_username: ac_username,
            ac_nickname: ac_nickname,
            status: status
        },
        function(data) {
            $('#get_list_job_on_hand').html(data);
        });

}

get_list_job_on_hand('<?php echo $ac_role; ?>', 'pending', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');

function interval_run() {
    get_list_job_on_hand('<?php echo $ac_role; ?>', 'pending', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>', 'inprogress', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>', 'waiting', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>', 'revise', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
    get_list_job_on_hand('<?php echo $ac_role; ?>', 'revised', '<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>');
}
// interval_run();

// var time = new Date(),
//     secondsRemaining = (60 - time.getSeconds()) * 1000;

// setTimeout(function() {
//     setInterval(interval_run, 10000000);
// }, secondsRemaining);


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