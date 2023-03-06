<nav class="navbar p-3 pb-0 m-0 bg-secondary bg-opacity-25 text-secondary  m-0">
  <div class="container-fluid">
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a onclick="get_page('configurable')">Configurable</a></li>
          <li class="breadcrumb-item active" aria-current="page">Bucket management</li>
        </ol>
    </nav>

    <div class="d-flex">
      <!-- <button class="btn btn-outline-success" onclick="attribute_detail_page('','','','create')" >Create new attribute</button> -->

    </div>
  </div>
</nav>
<h5 class="p-2 ps-4 pb-4 bg-secondary bg-opacity-25 text-secondary  m-0" style="text-transform: uppercase"><strong>Bucket management</strong></h5>


<?php
include("../get/get_table.php");
displayTable(
    "localhost", "cdse_admin", "@aA417528639",
    "all_in_one_project", "project_bucket",
     array(
        "id",
        "prefix",
        "color_project",
        "project_name",
        "status"
      ),
      "project_bucket");
?>

  <div class="container-fluid">
    <div class="d-flex">

      <!-- <button class="btn btn-outline-success disabled">Create new account</button> -->
    </div>
  </div>
  <script>
  $(document).ready( function () {
  $('#project_bucket').DataTable({
        lengthMenu: [
            [10,20, 50, 100, -1],
            [10, 20,50, 100, 'All'],
        ],
    });

} );

function project_bucket_detail_page(id,attribute_code,table_name,action){
    // create new attribute
      $.post("base/page/project_bucket_detail.php", {
                id:id,
                attribute_code: attribute_code,
                table_name: table_name,
                action:action
            },
            function(data) {
                $('#col_detail').html(data);
            });
  }


</script>


