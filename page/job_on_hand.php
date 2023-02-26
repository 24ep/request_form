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
$username_op = getoption_return_filter("username","account",$_SESSION["username"],"single","all_in_one_project");
$role_op = get_option("role",$_SESSION["role"],"single");
?>

<nav class="nav p-2 bg-light shadow" style="border-bottom: 1px solid #e3e3e3;">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li role="presentation" class="nav-item nav-task" onclick="get_list_job_on_hand('pending');">Pending<span id="c_pending" class="badge text-bg-dark ms-2"></span></li>
        <li role="presentation" class="nav-item nav-task" onclick="get_list_job_on_hand('inprogress');">Inprogress<span id="c_inprogress" class="badge text-bg-dark ms-2"></span></a>
        <li role="presentation" class="nav-item nav-task" onclick="get_list_job_on_hand('waiting');">Waiting information<span id="c_waiting" class="badge text-bg-dark ms-2"></span></li>
        <li role="presentation" class="nav-item nav-task" onclick="get_list_job_on_hand('waiting for other stage');">Waiting for other stage<span id="c_waiting for other stage" class="badge text-bg-dark ms-2"></span></a>
        <li role="presentation" class="nav-item nav-task" onclick="get_list_job_on_hand('rejected');">Rejected<span id="c_rejected" class="badge text-bg-dark ms-2"></span></li>
    </ul>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>
    <div class="position-absolute end-0 me-3 mt-1" style="margin-right: 120px!important;">
        <select  id="username_on_hand" onchange="get_list_job_on_hand('current_status');">
            <?php echo $username_op;?>
        </select>
    </div>
    <div class="position-absolute end-0 me-3 mt-1">
        <select id="role_on_hand" onchange="get_list_job_on_hand('current_status');">
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
    if(status=='current_status'){
        status = document.getElementById('selected_status').value ;
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

