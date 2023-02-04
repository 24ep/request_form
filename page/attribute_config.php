
<nav class="navbar navbar-light bg-white">
  <div class="container-fluid">
    <a class="navbar-brand">Attribute</a>
    <div class="d-flex">
      <!-- <button class="btn btn-outline-success" onclick="attribute_detail_page('','','','create')" >Create new attribute</button> -->
      <button class="btn btn-outline-success" onclick="add_new_attribute('u749625779_cdscontent','job_attribute')" ><ion-icon name="add-outline"></ion-icon>Create new attribute</button>
    </div>
  </div>
</nav>
<?php
session_start();
$table = $_POST['table'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT *
FROM u749625779_cdscontent.job_attribute where table_name = '".$table."'"; or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
$attribute .= '
    <tr style="text-align-last: left;border: solid #dee2e6 1px;background-color: transparent;" id="attribute_code_id_'.$row['id'].'">
      <th scope="col">'.$row['attribute_label'].'</th>
      <th >'.$row['attribute_code'].'</th>
      <th >'.$row['attribute_type'].'</th>
      <th >'.$row['table_name'].'</th>
      <th>
      <button type="button" class="btn btn-dark btn-sm" onclick="attribute_detail_page(&#39;'.$row['id'].'&#39,&#39;'.$row['attribute_code'].'&#39,&#39;'.$row['table_name'].'&#39,&#39;update&#39;)"
      ><ion-icon name="create-outline" style="margin: 0;"></ion-icon></button>
      <button type="button"  class="btn btn-danger btn-sm" onclick="delete_attribute(&#39;'.$row['db_name'].'&#39;,&#39;'.$row['table_name'].'&#39;,'. $row['id'].',&#39;'.$row['primary_key_id'].'&#39;,&#39;'.$row['release_attribute'].'&#39;,&#39;'.$row['attribute_code'].'&#39;)" >
      <ion-icon name="trash-outline" style="margin: 0;"></ion-icon></button>
      </th>
    </tr>
';
}
echo '<table class="table" id="st_attribute_config" name="st_attribute_config">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Attribute Label</th>
      <th scope="col">Attribute Code</th>
      <th scope="col">Type</th>
      <th scope="col">Table</th>
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
function add_new_attribute(db,table) {
  $.post("base/action/action_insert_new_record.php", {
        table : table,
        db : db
      },
      function(data) {
          attribute_detail_page(data,'',table,'create');
      });
}
function alter_delete_attribute(db,table,column) {
$.post("base/action/action_alter_delete_column.php", {
      table : table,
      db : db,
      column : column
    },
    function(data) {
      if (!data.startsWith("Error")) {
                Notiflix.Report.success('Attribute ' + column+' have been removed');
              }else{
                Notiflix.Report.failure(
                  'Remove Failure',
                  data,
                  'Okay',
                  );
              }
    });
}
function delete_attribute(db,table,id,primary_key_id,release_attribute,column) {
  var table_record = "job_attribute";
  var db_record = "u749625779_cdscontent";
  var primary_key_id_record = "id";
  Notiflix.Confirm.show(
      'Confirm',
      'Do you want to remove an attribute '+column+' ?',
      'Yes',
      'No',
        function okCb() {
          $.post("base/action/action_delete_record.php", {
              table : table_record,
              db : db_record,
              id : id,
              primary_key_id : primary_key_id_record
            },
            function(data) {
              if (!data.startsWith("Error")) {
                Notiflix.Notify.success('Attribute  ' + column+' have been removed');
                 // Get a reference to the div element
                var div = document.getElementById('attribute_code_id_'+data);
                div.remove();
                if(release_attribute==1){
                    alter_delete_attribute(db,table,column);
                }
              }else{
                Notiflix.Report.failure(
                  'Remove Failure',
                  data,
                  'Okay',
                  );
              }
            });
        },
        function cancelCb() {
          //nothing
        },
  );
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
