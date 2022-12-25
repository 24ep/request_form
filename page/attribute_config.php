
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Attribute</a>
    <div class="d-flex">
      
      <button class="btn btn-outline-success" onclick="attribute_detail_page('','','','create')" >Create new attribute</button>
    </div>
  </div>
</nav>

<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT attribute_code,attribute_label,description,attribute_set,attribute_type,table_name,id
FROM u749625779_cdscontent.job_attribute;" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
$attribute .= '
    <tr style="text-align-last: left;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">'.$row['attribute_label'].'</th>
      <th >'.$row['attribute_code'].'</th>
      <th >'.$row['attribute_type'].'</th>
      <th >'.$row['attribute_set'].'</th>
      <th >'.$row['description'].'</th>
      <th onclick="attribute_detail_page(&#39;'.$row['id'].'&#39,&#39;'.$row['attribute_code'].'&#39,&#39;'.$row['table_name'].'&#39,&#39;update&#39;)">
      <button type="button" class="btn"><ion-icon name="create-outline"></ion-icon></button></th>
    </tr>
';
  
}


echo '<table class="table" id="st_attribute_config" name="st_attribute_config">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Attribute Label</th>
      <th scope="col">Attribute Code</th>
      <th scope="col">Type</th>
      <th scope="col">Set</th>
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
  function attribute_detail_page(id,attribute_code,table_name,action){
    // create new attribute

    if(action=='create'){
      Notiflix.Confirm.prompt(
      'Which attribute code ?',
      'Option code may contain only letters, numbers and underscores',
      '',
      'Create',
      'Cancel',
          function okCb(clientAnswer) {
            var attribute_code = clientAnswer;
            $.post("base/page/attribute_config_detail.php", {
                id:id,
                attribute_code: attribute_code,
                table_name: table_name,
                action:action
            },
            function(data) {
                $('#nav-attribute').html(data);
            });
          },
          function cancelCb(clientAnswer) {
            // alert('Client answer was: ' + clientAnswer);
          },
        
    );
    }else{
      $.post("base/page/attribute_config_detail.php", {
                id:id,
                attribute_code: attribute_code,
                table_name: table_name,
                action:action
            },
            function(data) {
                $('#nav-attribute').html(data);
            }); 
    }   
  }

function add_new_attribute(db,table) {

  $.post("base/action/action_insert_new_record.php", {
        table : table,
        db : db
      },
      function(data) {
          attribute_detail_page(data,'',table,'create')
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
