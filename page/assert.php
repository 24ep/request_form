<div class="container-fluid ">
<nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Asserts</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
      
    </form>
    <!-- list -->
  </div>
  <div class="container-fluid m-3">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb" id="breadcrumb">
        <?php include('../get/get_assert_breadcrumb.php'); ?>
  </ol>
    <div class="d-flex" >
    <div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
        Create New
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Folder</a></li>
        <li><a class="dropdown-item" href="#">Block</a></li>
        <li><a class="dropdown-item" href="#">Upload a files</a></li>
      </ul>
    </div>
    </div>
  </nav>
 
  <ul class="list-group" style="width:100%">
      <div id=list_asserts>
        <?php include('../get/get_list_assert_dri.php'); ?>
      </div>
    </ul>
  </div>
</nav>
</div>

<script>
  function goto_dri(dri_parent){
    $.post("../base/get/get_list_assert_dri.php", {
      dri_parent: dri_parent
    }, function(data) {
         $('#list_asserts').html(data);
    });
  }
 
</script>
<script>
  function change_breadcrumb(dri_id,block_id){
    $.post("../base/get/get_assert_breadcrumb.php", {
      dri_id: dri_id,
      block_id:block_id
    }, function(data) {
         $('#breadcrumb').html(data);
    });
  }
 
</script>
<script>
  function get_block(block_id){
    $.post("../base/get/get_block_editor.php", {
      block_id: block_id
    }, function(data) {
         $('#list_asserts').html(data);
    });
  }
 
</script>
