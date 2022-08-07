<div class="container-fluid ">
<nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Asserts</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-warning btn-sm" type="button">Create folder</button>
      <button class="btn btn-dark btn-sm" type="button">Create Block</button>
    </form>
    <!-- list -->
  </div>
  <div class="container-fluid">
  <ul class="list-group">
        <?php include('base/get/get_list_assert_dri.php'); ?>
    </ul>
  </div>
</nav>
</div>