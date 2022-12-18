<?php
session_start();
$attribute_code = $_POST['attribute_code'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");


echo '<div class="container-md">';
echo '
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Configurable</li>
    <li class="breadcrumb-item">Attribute</li>
    <li class="breadcrumb-item active" aria-current="page">'.$attribute_code.'</li>
    </ol>
</nav>
';

echo '<h4><strong>'.$attribute_code.'<strong></h4>';
echo '<hr>';


echo '
<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-properties-tab" data-bs-toggle="pill" data-bs-target="#v-pills-properties" type="button" role="tab" aria-controls="v-pills-properties" aria-selected="true">Properties</button>
    <button class="nav-link" id="v-pills-options-tab" data-bs-toggle="pill" data-bs-target="#v-pills-options" type="button" role="tab" aria-controls="v-pills-options" aria-selected="false">Options</button>
    <button class="nav-link" id="v-pills-historical-tab" data-bs-toggle="pill" data-bs-target="#v-pills-historical" type="button" role="tab" aria-controls="v-pills-historical" aria-selected="false">Historical</button>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <h5><strong>General</strong></h5>
    <div class="mb-3">
            <label for="attribute_code" class="form-label">Attribute Code</label>
            <input type="text" class="form-control" id="attribute_code" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="attribute_label" class="form-label">Attribute label</label>
            <input type="text" class="form-control" id="attribute_label" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="attribute_type" class="form-label">Attribute Type</label>
            <input type="text" class="form-control" id="attribute_type" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" placeholder="" value="">
        </div>
        <hr>
        <h5><strong>Group</strong></h5>

        <div class="mb-3">
            <label for="section_group" class="form-label">Section Group</label>
            <input type="text" class="form-control" id="section_group" placeholder="" value="">
        </div>
        <div class="mb-3">
            <label for="attribute_set" class="form-label">Attribute Set</label>
            <input type="text" class="form-control" id="attribute_set" placeholder="" value="">
        </div>

        <hr>
        <h5><strong>Permission</strong></h5>

        <div class="mb-3">
            <label for="allow_display" class="form-label">Allow Display</label>
            <input type="text" class="form-control" id="allow_display" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="allow_edit" class="form-label">Allow Edit</label>
            <input type="text" class="form-control" id="allow_edit" placeholder="" value="">
        </div>

        <hr>
        <h5><strong>Database Config</strong></h5>

        <div class="mb-3">
            <label for="table_name" class="form-label">Data Table name</label>
            <input type="text" class="form-control" id="table_name" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="db_name" class="form-label">Database name</label>
            <input type="text" class="form-control" id="db_name" placeholder="" value="">
        </div>
        
        <div class="mb-3">
            <label for="primary_key_id" class="form-label">Database name</label>
            <input type="text" class="form-control" id="primary_key_id" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="prefix" class="form-label">Prefix</label>
            <input type="text" class="form-control" id="prefix" placeholder="" value="">
        </div>

        <div class="mb-3">
            <label for="set_complete_attribute" class="form-label">Set complete attribute</label>
            <input type="text" class="form-control" id="set_complete_attribute" placeholder="" value="">
        </div>
    </div>
    <div class="tab-pane fade" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">...</div>
    <div class="tab-pane fade" id="v-pills-historical" role="tabpanel" aria-labelledby="v-pills-historical-tab">...</div>

  </div>
</div>
';




echo '</div>';


?>