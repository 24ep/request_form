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

include_once('../get/get_option_function.php');
// $username_op = getoption_return_filter("username","account",$_SESSION["username"],"single","all_in_one_project");
$role_op = get_option_attribute_entity("role","account",$_SESSION["role"]);
$username_op = get_option_attribute_entity("username","account",$_SESSION["role"]);
?>

<nav class="nav p-2 bg-light shadow" style="border-bottom: 1px solid #e3e3e3;">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li role="presentation" class="pe-3 ps-3 border-end align-self-center" onclick="get_list_job_on_hand('pending');">
            <button class="nav-link nav-task active" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                Pending
                <span id="c_pending" class="badge text-bg-dark ms-2"></span>
            </button>
        </li>
        <li role="presentation" class="pe-3 ps-3 border-end align-self-center" onclick="get_list_job_on_hand('inprogress');">
            <button class="nav-link nav-task" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                Inprogress
                <span id="c_inprogress" class="badge text-bg-dark ms-2"></span>
            </button>
        </li>
        <li role="presentation" class="pe-3 ps-3 border-end align-self-center" onclick="get_list_job_on_hand('waiting');">
            <button class="nav-link nav-task" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                Waiting information
                <span id="c_waiting" class="badge text-bg-dark ms-2"></span>
            </button>
        </li>
        <li role="presentation" class="pe-3 ps-3 border-end align-self-center" onclick="get_list_job_on_hand('waiting for other stage');">
            <button class="nav-link nav-task" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                Waiting for other stage
                <span id="c_waiting for other stage" class="badge text-bg-dark ms-2"></span>
            </button>
        </li>
        <li role="presentation" class="pe-3 ps-3 border-end align-self-center" onclick="get_list_job_on_hand('rejected');">
            <button class="nav-link nav-task" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">
                Rejected
                <span id="c_rejected" class="badge text-bg-dark ms-2"></span>
            </button>
        </li>
    </ul>

    <div class="position-absolute end-0 me-3 mt-1" style="margin-right: 120px!important;">
        <select id="username_on_hand" class="align-self-center" onchange="get_list_job_on_hand('current_status');">
            <?php echo $username_op;?>
        </select>
    </div>
    <div class="position-absolute end-0 me-3 mt-1">
        <select id="role_on_hand" class="align-self-center" onchange="get_list_job_on_hand('current_status');">
            <?php echo $role_op;?>
        </select>
    </div>
</nav>
<div class="row job_on_hand_list" style="--bs-gutter-x: auto;">
    <div class="col-3 bg-secondary bg-opacity-10 shadow-sm pe-0 ps-0 mt-0  ms-0 m-0 border-end">
        <div id="get_list_job_on_hand" class="bg-light bg-opacity-25 shadow-sm">
        </div>
    </div>
    <div class="col-9 p-0">
        <div id="panel_detail">

        </div>
    </div>

</div>
<input type="hidden" id="selected_status">
<script>
// get_detail_more
// function on_stage_change(){

// }

function get_list_job_on_hand(status) {
    if (status == 'current_status') {
        status = document.getElementById('selected_status').value;
    }
    ac_username = document.getElementById('username_on_hand').value;
    ac_role = document.getElementById('role_on_hand').value;
    $.post("base/get/get_list_on_hand.php", {
            ac_role: ac_role,
            ac_username: ac_username,
            status: status
        },
        function(data) {
            $('#get_list_job_on_hand').html(data);
        });
    document.getElementById('selected_status').value = status;

}




get_list_job_on_hand('pending');

function interval_run() {
    get_list_job_on_hand('pending');
    get_list_job_on_hand('inprogress');
    get_list_job_on_hand('waiting');
    get_list_job_on_hand('revise');
    get_list_job_on_hand('revised');
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

new SlimSelect({
    select: "#username_on_hand"
})

new SlimSelect({
    select: "#role_on_hand"
})
</script>