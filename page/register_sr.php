<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT attribute_code
FROM u749625779_cdscontent.job_attribute;" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
echo '
    <tr>
      <th scope="col">'.$row['attribute_code'].'</th>
      <th scope="col">'.$row['attribute_label'].'</th>
      <th scope="col">'.$row['description'].'</th>
      <th scope="col">'.$row['Edit'].'</th>
    </tr>
';
  
}


echo '<table class="table table-bordered" id="filter name="st_attribute_config">
<thead>
    <tr>
      <th scope="col">Attribute Code</th>
      <th scope="col">Attribute Label</th>
      <th scope="col">Description</th>
      <th scope="col">Edit Label</th>
    </tr>
</thead>
<tbody>';

echo '</tbody>
</table>';
?>