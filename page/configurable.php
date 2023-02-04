
<style>
.dataTables_wrapper {
    position: initial!important;
    clear: both;
    background: white;
    padding: 30px;
}
</style>



<nav>
  <div class="nav nav-tabs shadow-sm bg-white" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-account" type="button" role="tab" aria-controls="nav-account" aria-selected="true">Accounts</button>
    <button class="nav-link" id="nav-attribute-tab" data-bs-toggle="tab" data-bs-target="#nav-attribute" type="button" role="tab" aria-controls="nav-attribute" aria-selected="false">Attribute</button>
    <button class="nav-link" id="nav-app_version_control-tab" data-bs-toggle="tab" data-bs-target="#nav-app_version_control" type="button" role="tab" aria-controls="nav-app_version_control" aria-selected="false">App version control</button>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab" tabindex="0">
  <?php include('account.php'); ?>
</div>
  <div class="tab-pane fade" style="overflow: auto;" id="nav-attribute" role="tabpanel" aria-labelledby="nav-attribute-tab" tabindex="0">
    <?php //include('attribute_config.php'); ?>
    <?php include('data_table.php'); ?>
  </div>
  <div class="tab-pane fade" style="overflow: auto;" id="nav-app_version_control" role="tabpanel" aria-labelledby="nav-app_version_control-tab" tabindex="0">
    <?php include('app_version_control.php'); ?>
  </div>
</div>
<script>
  $(document).ready( function () {
  $('#st_account_tb').DataTable({
        lengthMenu: [
            [10,20, 50, 100, -1],
            [10, 20,50, 100, 'All'],
        ],
    });

} );



</script>
