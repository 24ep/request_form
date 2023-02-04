<div class="row row-cols-1 row-cols-md-3 g-4 m-3">
  <div class="col" onclick="get_attribute_config('account')">
    <div class="card p-3">
    <ion-icon name="people" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Account table</h5>
        <p class="card-text">Manage account that register on the ServiceGate</p>
      </div>
    </div>
  </div>
  <div class="col" onclick="get_attribute_config('add_new_job')">
    <div class="card p-3">
    <ion-icon name="rocket" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Add new job table </h5>
        <p class="card-text">Manage the an attribute of ns-ticket</p>
      </div>
    </div>
  </div>
  <div class="col" onclick="get_attribute_config('content_request')">
    <div class="card p-3">
    <ion-icon name="ticket" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Content Request table </h5>
        <p class="card-text">CR-Ticket, DP-Ticket - Manage an attribute of content-request ticket</p>
      </div>
    </div>
  </div>
  <div class="col" onclick="get_attribute_config('job_cms')">
    <div class="card p-3">
    <ion-icon name="grid" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Job CMS table (24EP)</h5>
        <p class="card-text">Manage an attribute of writer job in 24EP system (old)</p>
      </div>
    </div>
  </div>
  <div class="col" onclick="get_attribute_config('job_attribute')">
    <div class="card p-3">
    <ion-icon name="settings" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Attribute config table</h5>
        <p class="card-text">Manage an attribute of config table</p>
      </div>
    </div>
  </div>
  <div class="col" onclick="get_attribute_config('job_attribute_option')">
    <div class="card p-3">
    <ion-icon name="settings" style="font-size: 80px;color: #ababab;"></ion-icon>
      <div class="card-body">
        <h5 class="card-title">Attribute option config table</h5>
        <p class="card-text">Manage an attribtue option of config table</p>
      </div>
    </div>
  </div>
</div>

<script>
    function get_attribute_config(table) {
    Notiflix.Loading.hourglass('Loading...');
    $.post("base/page/attribute_config.php", {
        table:table
    }, function(data) {
        $('#col_detail').html(data);
        Notiflix.Loading.remove();
    });
}
</script>