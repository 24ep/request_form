<?php
session_start();
$target_tb = $_POST['target_tb'];
$target_db = $_POST['target_db'];
$target_prefix = $_POST['target_prefix'];
?>
<nav class="navbar p-3 pb-0 m-0 bg-secondary bg-opacity-25 text-secondary  m-0">
  <div class="container-fluid">
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a onclick="get_page('configurable')">Configurable</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $target_tb; ?></li>
        </ol>
    </nav>

    <div class="d-flex">
      <!-- <button class="btn btn-outline-success" onclick="attribute_detail_page('','','','create')" >Create new attribute</button> -->
      <button class="btn btn-secondary shadow-sm" onclick="add_new_attribute('u749625779_cdscontent','job_attribute','<?php echo $target_tb; ?>','<?php echo $target_db; ?>','<?php echo $target_prefix; ?>');" ><ion-icon name="add-outline"></ion-icon>Create new attribute</button>
    </div>
  </div>
</nav>
<h5 class="p-2 ps-4 pb-4 bg-secondary bg-opacity-25 text-secondary  m-0" style="text-transform: uppercase"><strong><?php echo $target_tb;?></strong></h5>



<?php

function badge_attribute_type($type){
  if($type=='text'){
    return '<span class=" badge p-2 w-100 rounded modern-badge-green">Free Text</span>';
  }elseif($type=='number'){
    return '<span class=" badge p-2 w-100 rounded modern-badge-green">Number only</span>';
  }elseif($type=='datetime'){
    return '<span class="badge p-2 w-100 rounded modern-badge-blue">DateTime</span>';
  }elseif($type=='date'){
    return '<span class="badge p-2 w-100 rounded modern-badge-blue">Date</span>';
  }elseif($type=='single_select'){
    return '<span class="badge p-2 w-100 rounded modern-badge-purple">Simple Select</span>';
  }elseif($type=='multiselect'){
    return '<span class="badge p-2 w-100 rounded modern-badge-purple">Multiple Select</span>';
  }elseif($type=='textarea'){
    return '<span class="badge p-2 w-100 rounded modern-badge-green">Text Area</span>';
  }

}
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT * FROM u749625779_cdscontent.job_attribute where table_name = '".$target_tb."';" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
$attribute .= '
    <tr style="text-align-last: left;border: solid #dee2e6 1px;background-color: transparent;" id="attribute_code_id_'.$row['id'].'">
      <th scope="col">'.$row['attribute_label'].'</th>
      <th >'.$row['attribute_code'].'</th>
      <th >'.badge_attribute_type($row['attribute_type']).'</th>
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
                $('#col_detail').html(data);
            });
  }
  function bypass_table_information(data,target_tb,target_db,target_prefix){
          document.getElementById('ja_edit_table_name').value = target_tb;
          document.getElementById('ja_edit_db_name').value = target_db;
          document.getElementById('ja_edit_prefix').value = target_prefix;
          update_value_attribute(data, 'ja_edit_table_name' , 'ja' , 'u749625779_cdscontent' , 'job_attribute' , 'id');
          update_value_attribute(data, 'ja_edit_db_name' , 'ja' , 'u749625779_cdscontent' , 'job_attribute' , 'id');
          update_value_attribute(data, 'ja_edit_prefix' , 'ja' , 'u749625779_cdscontent' , 'job_attribute' , 'id');

}
function add_new_attribute(db,table,target_tb,target_db,target_prefix) {

  $.post("base/action/action_insert_new_record.php", {
        table : table,
        db : db
      },
      function(data) {
          attribute_detail_page(data,'',table,'create');
          bypass_table_information(data,target_tb,target_db,target_prefix);


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
