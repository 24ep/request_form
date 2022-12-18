<?php
session_start();
$attribute_code = $_POST['attribute_code'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");


//get column 

$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='u749625779_cdscontent' 
    AND `TABLE_NAME`='job_attribute';" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $COLUMN_NAME= $row['COLUMN_NAME'];
    


}


echo '
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Configurable</a></li>
    <li class="breadcrumb-item" aria-current="page">Attribute</li>
    <li class="breadcrumb-item active" aria-current="page">'.$attribute_code.'</li>
    </ol>
</nav>
';

echo '<h6>'.$attribute_code.'</h6>';
echo '<hr>';


echo '
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-properties-tab" data-bs-toggle="tab" data-bs-target="#nav-properties" type="button" role="tab" aria-controls="nav-properties" aria-selected="true">Properties</button>
    <button class="nav-link" id="nav-options-tab" data-bs-toggle="tab" data-bs-target="#nav-options" type="button" role="tab" aria-controls="nav-options" aria-selected="false">Options</button>
    <button class="nav-link" id="nav-historical-tab" data-bs-toggle="tab" data-bs-target="#nav-historical" type="button" role="tab" aria-controls="nav-historical" aria-selected="false">Historical</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-properties" role="tabpanel" aria-labelledby="nav-properties-tab">...</div>
  <div class="tab-pane fade" id="nav-options" role="tabpanel" aria-labelledby="nav-options-tab">...</div>
  <div class="tab-pane fade" id="nav-historical" role="tabpanel" aria-labelledby="nav-historical-tab">...</div>
</div>
';



?>