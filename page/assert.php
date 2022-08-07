<div class="container-fluid ">
<nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Asserts</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-warning btn-sm me-2" type="button">Create folder</button>
      <button class="btn btn-dark btn-sm" type="button">Create Block</button>
    </form>
    <!-- list -->
  </div>
  <div class="container-fluid m-3">
  <ul class="list-group">
      <div id=list_asserts>
        <?php include('../get/get_list_assert_dri.php'); ?>
      </div>
    </ul>
  </div>
</nav>
</div>

<script>
  function goto_dri(dri_id){
    $.post("../get/get_list_assert_dri.php", {
        dri_id: dri_id
    }, function(data) {
         $('#list_asserts').html(data);
    });
  }
 
</script>
