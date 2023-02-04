
<!--
General setting
- Account
- App version confontrol
- add new job attribtue
- job_cms attribute
- content request attribute
Table setting
- attribute setting
- attribute option setting

-->

<?php
$configurable_session_map = array("general_setting","table_setting");
//  session |icon | table | header | description
$configurable_map = array (
    array(
        'session'=>'general_setting',
        'icon'=>'apps',
        'table'=>'app_version_control',
        'title'=>'LinesheetApp',
        'description'=>'Manage lineshetAPP'),
    array(
        'session'=>'general_setting',
        'icon'=>'people',
        'table'=>'account',
        'title'=>'ServiceGate accounts',
        'description'=>'Manage any register account in system'),
    array(
        'session'=>'general_setting',
        'icon'=>'rocket',
        'table'=>'add_new_job',
        'title'=>'add_new_job',
        'description'=>'Manage attribute of new product creation (NS ticket)'),
    array(
        'session'=>'general_setting',
        'icon'=>'grid',
        'table'=>'job_cms',
        'title'=>'job_cms',
        'description'=>'manage attribute of new product creation (production job)'),
    array(
        'session'=>'general_setting',
        'icon'=>'ticket',
        'table'=>'content_request',
        'title'=>'content_request',
        'description'=>'Manage attribute of new product update (CR,DP ticket)'),
    array(
        'session'=>'settings',
        'icon'=>'settings',
        'table'=>'job_attribute',
        'title'=>'Attribute setting',
        'description'=>'Manage an attribute of config table'),
    array(
        'session'=>'settings',
        'icon'=>'settings',
        'table'=>'job_attribute_option',
        'title'=>'Attribute option setting',
        'description'=>'Manage an attribute of config table')
);
$length_configurable_session_map = count($configurable_session_map);
$length_configurable_map = count($configurable_map);
for ($i=0; $i < $length_configurable_session_map; $i++) {
    echo '<hr><h4>'.$configurable_session_map[$i].'</h4>
    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">';
    for ($j=0; $j  < $length_configurable_map; $j++) {
        if($configurable_session_map[$i]==$configurable_map[$j][0]){
            echo '
            <div class="col" onclick="get_attribute_config(&#39;'.$configurable_map[$j]['table'].'&#39;)">
                <div class="card p-3">
                    <ion-icon name="'.$configurable_map[$j]['icon'].'" style="font-size: 50px;color: #ababab;"></ion-icon>
                    <div class="card-body">
                        <h5 class="card-title">'.$configurable_map[$j]['title'].'</h5>
                        <p class="card-text">'.$configurable_map[$j]['description'].'</p>
                    </div>
                </div>
            </div>
            ';
        }
    }
    echo '</div>';
}

?>

<!--
<div class="row row-cols-1 row-cols-md-3 g-4 m-3">

</div>

<hr>
<h4>Table setting</h4>
<div class="row row-cols-1 row-cols-md-3 g-4 m-3">
<div class="col" onclick="get_attribute_config('account')">
<div class="card p-3">
<ion-icon name="people" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Account table</h5>
<p class="card-text">Manage account that register on the ServiceGate</p>
</div>
</div>
</div>
<div class="col" onclick="get_attribute_config('add_new_job')">
<div class="card p-3">
<ion-icon name="rocket" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Add new job table </h5>
<p class="card-text">Manage the an attribute of ns-ticket</p>
</div>
</div>
</div>
<div class="col" onclick="get_attribute_config('content_request')">
<div class="card p-3">
<ion-icon name="ticket" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Content Request table </h5>
<p class="card-text">CR-Ticket, DP-Ticket - Manage an attribute of content-request ticket</p>
</div>
</div>
</div>
<div class="col" onclick="get_attribute_config('job_cms')">
<div class="card p-3">
<ion-icon name="grid" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Job CMS table (24EP)</h5>
<p class="card-text">Manage an attribute of writer job in 24EP system (old)</p>
</div>
</div>
</div>
<div class="col" onclick="get_attribute_config('job_attribute')">
<div class="card p-3">
<ion-icon name="settings" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Attribute config table</h5>
<p class="card-text">Manage an attribute of config table</p>
</div>
</div>
</div>
<div class="col" onclick="get_attribute_config('job_attribute_option')">
<div class="card p-3">
<ion-icon name="settings" style="font-size: 50px;color: #ababab;"></ion-icon>
<div class="card-body">
<h5 class="card-title">Attribute option config table</h5>
<p class="card-text">Manage an attribtue option of config table</p>
</div>
</div>
</div>
</div> -->

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