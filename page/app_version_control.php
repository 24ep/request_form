<nav class="navbar p-3 pb-0 m-0 bg-secondary bg-opacity-25 text-secondary  m-0">
  <div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a onclick="get_page('configurable')">Configurable</a></li>
    <li class="breadcrumb-item active" aria-current="page">App version control</li>
    </ol>
    </nav>
    <div class="d-flex">
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Release new version</button>
    </div>
  </div>
</nav>
<h5 class="p-2 ps-4 pb-4 bg-secondary bg-opacity-25 text-secondary  m-0" style="text-transform: uppercase"><strong>App version control</strong></h5>
<?php session_start();?>
<?php
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
//get list file attachment
$query = "SELECT * FROM all_in_one_project.attachment  WHERE ticket_type = 'ticket_files' and ticket_id = ".$_POST['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo '<ul class="list-group list-group-flush">';
while($row = mysqli_fetch_array($result)) {
}
echo '</ul>';
?>
<script>
function call_release_new_app_version() {
  Notiflix.Loading.hourglass('Loading...');
    $.post("../base/modal/release_new_app_version.php", {
    }, function(data) {
      $('#model_lg').html(data);
      Notiflix.Loading.remove();
    });
}
</script>
<!--  -->