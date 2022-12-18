<?php
session_start();
$attribute_code = $_POST['attribute_code'];
$table_name = $_POST['attribute_code'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT *
FROM u749625779_cdscontent.job_attribute where attribute_code='".$attribute_code."' and table_name = '".$table_name."'"  or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $id=$row['id'];
    $attribute_code=$row['attribute_code'];
    $attribute_label=$row['attribute_label'];
    $description=$row['description'];
    $attribute_set=$row['attribute_set'];
    $section_group=$row['section_group'];
    $attribute_type=$row['attribute_type'];
    $allow_display=$row['allow_display'];
    $allow_in_edit=$row['allow_in_edit'];
    $allow_ex_edit=$row['allow_ex_edit'];
    $sort_attribute_set=$row['sort_attribute_set'];
    $sort_section=$row['sort_section'];
    $sort_attribute=$row['sort_attribute'];
    $table_name=$row['table_name'];
    $db_name=$row['db_name'];
    $primary_key_id=$row['primary_key_id'];
    $prefix=$row['prefix'];
    $action_bt=$row['action_bt'];
    $set_complete_attribute=$row['set_complete_attribute'];
    $important=$row['important'];

}

$query = "SELECT *
FROM u749625779_cdscontent.job_attribute_option;
where attribute_code='".$attribute_code."'  and attribute_table = '".$table_name."'"  or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) { 

    $attribute_option_row .= ' <tr>
    <th>'. $row['attribute_option_code'].'</th>
    <td>'. $row['attribute_option_label'].'</td>
    <td><ion-icon name="create-outline"></ion-icon></td>
  </tr>';
}
echo '<div class="container-md p-4">';
echo '
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Configurable</li>
    <li class="breadcrumb-item">Attribute</li>
    <li class="breadcrumb-item active" aria-current="page">'.$attribute_code.'</li>
    </ol>
</nav>
';

echo '<h4><strong>'.$attribute_label.'<strong></h4>';
echo '<small>'.$description.'</small>';
echo '<hr>';


echo '
<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills pe-4 border-end" style="text-align-last: left;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-properties-tab" data-bs-toggle="pill" data-bs-target="#v-pills-properties" type="button" role="tab" aria-controls="v-pills-properties" aria-selected="true">Properties</button>
    <button class="nav-link" id="v-pills-options-tab" data-bs-toggle="pill" data-bs-target="#v-pills-options" type="button" role="tab" aria-controls="v-pills-options" aria-selected="false">Options</button>
    <button class="nav-link" id="v-pills-historical-tab" data-bs-toggle="pill" data-bs-target="#v-pills-historical" type="button" role="tab" aria-controls="v-pills-historical" aria-selected="false">Historical</button>
  </div>
  <div class="tab-content ps-4 pe-4 container-xl" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-properties" role="tabpanel" aria-labelledby="v-pills-properties-tab">
    <h5><strong>General</strong></h5>
    <div class="mb-3">
            <label for="attribute_code" class="form-label">Attribute Code</label>
            <input type="text" class="form-control" id="attribute_code" placeholder="" value="'.$attribute_code.'">
        </div>

        <div class="mb-3">
            <label for="attribute_label" class="form-label">Attribute label</label>
            <input type="text" class="form-control" id="attribute_label" placeholder="" value="'.$attribute_label.'">
        </div>

        <div class="mb-3">
            <label for="attribute_type" class="form-label">Attribute Type</label>
            <input type="text" class="form-control" id="attribute_type" placeholder="" value="'.$attribute_type.'">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" placeholder="" value="'.$description.'">
        </div>
        <hr>
        <h5><strong>Group</strong></h5>

        <div class="mb-3">
            <label for="section_group" class="form-label">Section Group</label>
            <input type="text" class="form-control" id="section_group" placeholder="" value="'.$section_group.'">
        </div>
        <div class="mb-3">
            <label for="attribute_set" class="form-label">Attribute Set</label>
            <input type="text" class="form-control" id="attribute_set" placeholder="" value="'.$attribute_set.'">
        </div>

        <hr>
        <h5><strong>Permission</strong></h5>

        <div class="mb-3">
            <label for="allow_display" class="form-label">Allow Display</label>
            <input type="text" class="form-control" id="allow_display" placeholder="" value="'.$allow_display.'">
        </div>

        <div class="mb-3">
            <label for="allow_edit" class="form-label">Allow Edit</label>
            <input type="text" class="form-control" id="allow_edit" placeholder="" value="'.$allow_in_edit.'">
        </div>

        <hr>
        <h5><strong>Database Config</strong></h5>

        <div class="mb-3">
            <label for="table_name" class="form-label">Data Table name</label>
            <input type="text" class="form-control" id="table_name" placeholder="" value="'.$table_name.'">
        </div>

        <div class="mb-3">
            <label for="db_name" class="form-label">Database name</label>
            <input type="text" class="form-control" id="db_name" placeholder="" value="'.$db_name.'">
        </div>
        
        <div class="mb-3">
            <label for="primary_key_id" class="form-label">Primary key id</label>
            <input type="text" class="form-control" id="primary_key_id" placeholder="" value="'.$primary_key_id.'">
        </div>

        <div class="mb-3">
            <label for="prefix" class="form-label">Prefix</label>
            <input type="text" class="form-control" id="prefix" placeholder="" value="'.$prefix.'">
        </div>

        <div class="mb-3">
            <label for="set_complete_attribute" class="form-label">Set complete attribute</label>
            <input type="text" class="form-control" id="set_complete_attribute" placeholder="" value="'.$set_complete_attribute.'">
        </div>
    </div>';
    //options
    echo '
    <div class="tab-pane fade" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">

    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Option Code</th>
        <th scope="col">Option label</th>
        <th scope="col">Remove</th>
        </tr>
    </thead>
  <tbody>
  '.$attribute_option_row .'
  </tbody>
    </table>
    
    </div>
    <div class="tab-pane fade" id="v-pills-historical" role="tabpanel" aria-labelledby="v-pills-historical-tab">...</div>

  </div>
</div>
';




echo '</div>';


?>