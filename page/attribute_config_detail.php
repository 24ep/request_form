<?php
session_start();



$id = $_POST['id'];
$attribute_code = $_POST['attribute_code'];
$table_name = $_POST['table_name'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

//create new attribute
if($_POST['action']=='create'){
        $sql = "INSERT INTO job_attribute (
          attribute_code
        )
          VALUES(
            '".$attribute_code."'
          )";
          $query = mysqli_query($con,$sql);
          $id = $con->insert_id;
}

// end create new attribute
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

function get_attribute_option{

  $query = "SELECT *
  FROM u749625779_cdscontent.job_attribute_option
  where attribute_code='".$attribute_code."'  and attribute_table = '".$table_name."'"  or die("Error:" . mysqli_error());
  $result =  mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) { 

      $attribute_option_row .= ' <tr id="attribute_option_id_'.$row['id'].'">
      <th>'. $row['attribute_option_code'].'</th>
      <td>'. $row['attribute_option_label'].'</td>
      <td>
      <button type="button" data-bs-toggle="modal" 
      data-bs-target="#exampleModal" onclick="form_attribute_option('. $row['id'].')" class="btn btn-dark btn-sm">
      <ion-icon name="create-outline" style="margin: 0;"></ion-icon></button>

      <button type="button"  class="btn btn-danger btn-sm" onclick="delete_option(&#39;u749625779_cdscontent&#39;,&#39;job_attribute_option&#39;,'. $row['id'].',&#39;id&#39;)" >
      <ion-icon name="trash-outline" style="margin: 0;"></ion-icon></button>
      </td>

      
    </tr>';

    return $attribute_option_row ;
  }

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
    <button class="nav-link active" id="v-pills-properties-tab" data-bs-toggle="pill" data-bs-target="#v-pills-properties" type="button" role="tab" aria-controls="v-pills-properties" aria-selected="true">Properties</button>';

    if($attribute_type=='multiselect' or $attribute_type=='single_select'){
        echo '<button class="nav-link" id="v-pills-options-tab" data-bs-toggle="pill" data-bs-target="#v-pills-options" type="button" role="tab" aria-controls="v-pills-options" aria-selected="false">Options</button>';
    }
    echo '
    
    <button class="nav-link" id="v-pills-historical-tab" data-bs-toggle="pill" data-bs-target="#v-pills-historical" type="button" role="tab" aria-controls="v-pills-historical" aria-selected="false">Historical</button>
  </div>
  <div class="tab-content ps-4 pe-4 container-xl" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-properties" role="tabpanel" aria-labelledby="v-pills-properties-tab">
    <input type="hidden" class="form-control" id="id" placeholder="" value="'.$id.'">
    <input type="hidden" class="form-control" id="table_name" placeholder="" value="'.$table_name.'">
        <div id="properties_form">
        
        ';
       
    echo '
    </div>
    </div>';

    //options
    echo '
    <div class="tab-pane fade" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">

    <table class="table table-striped" id="option_list">
    <thead>
        <tr>
        <th scope="col">Option Code</th>
        <th scope="col">Option label</th>
        <th scope="col">Edit</th>
        </tr>
    </thead>
  <tbody>
  ';

  echo get_attribute_option;

  echo '
  
  </tbody>
    </table>
    ';
    ?>


    <button 
            type="button"
            class="btn btn-dark btn-sm" 
            onclick="add_new_option('u749625779_cdscontent','job_attribute_option')"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
    >
            Add Option
    </button>
    
    <?php
    echo '
    </div>
    <div class="tab-pane fade" id="v-pills-historical" role="tabpanel" aria-labelledby="v-pills-historical-tab">...</div>

  </div>
</div>
';



echo '</div>';


?>


<script>

  
function insert_attribute_option_config(id){

var attribute_code =  document.getElementById('ja_edit_attribute_code').value;
var table_name =  document.getElementById('ja_edit_table_name').value;
var db_name =  document.getElementById('ja_edit_db_name').value;

document.getElementById('jao_edit_attribute_code').value = attribute_code;
document.getElementById('jao_edit_attribute_table').value = table_name;
document.getElementById('jao_edit_db_name').value = db_name;

update_value_attribute(id, 'jao_edit_attribute_code' , 'jao' , 'u749625779_cdscontent' , 'job_attribute_option' , 'id');
update_value_attribute(id, 'jao_edit_attribute_table' , 'jao' , 'u749625779_cdscontent' , 'job_attribute_option' , 'id');
update_value_attribute(id, 'jao_edit_db_name' , 'jao' , 'u749625779_cdscontent' , 'job_attribute_option' , 'id');

// // Insert to table
//   // Get a reference to the table element
//   var table = document.getElementById('option_list');
  
//   // Insert a new row at the end of the table
//   var newRow = table.insertRow(-1);
  
//   // Insert cells into the new row
//   var cell1 = newRow.insertCell(0);
//   var cell2 = newRow.insertCell(1);
//   var cell2 = newRow.insertCell(1);
  
//   // Set the content of the cells
//   cell1.innerHTML = 'Cell 3';
//   cell2.innerHTML = 'Cell 4';

}

  function properties_form(){
    var id = document.getElementById('id').value;
    var table_name = "'job_attribute'";
    

        $.post("base/form/form_value.php", {
            id : id,
            table_name : table_name

            },
            function(data) {
                $('#properties_form').html(data);
            });
    
  }
  properties_form();

  function form_attribute_option(id) {
    // var id = document.getElementById('id').value;
    var table_name = "'job_attribute_option'";
    Notiflix.Loading.hourglass('Loading...');
    $.post("base/form/form_value.php", {
            id : id,
            table_name : table_name
        },
        function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
            insert_attribute_option_config(id);
        });
}

//
function add_new_option(db,table) {

    $.post("base/action/action_insert_new_record.php", {
          table : table,
          db : db
        },
        function(data) {

          
          form_attribute_option(data);
          
          
        });

           
        
}

//
function delete_option(db,table,id,primary_key_id) {

  Notiflix.Confirm.show(
      'Confirm',
      'Do you want to remove an option?',
      'Yes',
      'No',
        function okCb() {
          $.post("base/action/action_delete_record.php", {
              table : table,
              db : db,
              id : id,
              primary_key_id : primary_key_id
            },
            function(data) {
              if (!data.startsWith("Error")) {
                Notiflix.Notify.success('Option id ' + data+' have been remove');
                 // Get a reference to the div element
                 var div = document.getElementById('attribute_option_id_'+data);
                
                div.remove();
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