<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT attribute_code,attribute_label,description
FROM u749625779_cdscontent.job_attribute;" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
$attribute .= '
    <tr>
      <th scope="col">'.$row['attribute_label'].'</th>
      <th >'.$row['attribute_code'].'</th>
      <th >'.$row['description'].'</th>
      <th onclick="attribute_detail_page(&#39;'.$row['attribute_code'].'&#39;)">
      <button type="button" class="btn btn-dark"><ion-icon name="create-outline"></ion-icon></button></th>
    </tr>
';
  
}


echo '<table class="table table-bordered" id="st_attribute_config" name="st_attribute_config">
<thead>
    <tr>
      <th scope="col">Attribute Label</th>
      <th scope="col">Attribute Code</th>
      <th scope="col">Description</th>
      <th scope="col">Edit</th>
    </tr>
</thead>
<tbody>';
echo $attribute ;
echo '</tbody>
</table>';
?>
<script>
  function attribute_detail_page(attribute_code){
    // var value_change = document.getElementById(id_name).value;
        $.post("base/page/attribute_config_detail.php", {
                attribute_code: attribute_code
            },
            function(data) {
                $('#nav-attribute').html(data);
            });
    
  }

  
</script>


<script>
  $(document).ready( function () {
  $('#st_attribute_config').DataTable({
        lengthMenu: [
            [10,20, 50, 100, -1],
            [10, 20,50, 100, 'All'],
        ],
    });

} );



</script>
