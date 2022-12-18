<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
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
      <th scope="col" onclick="attribute_detail_page(&#39;'.$row['attribute_code'].'&#39;)">'.$row['Edit'].'</th>
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
<script>
  function attribute_detail_page(attribute_code){
    // var value_change = document.getElementById(id_name).value;
    if (id) {
        $.post("base/page/attribute_config_detail.php", {
                attribute_code: attribute_code
            },
            function(data) {
                $('#nav-attribute').html(data);
            });
    }
  }

  
</script>
