<?php

session_start();

$id = $_POST['id'];

$attribute_code = $_POST['attribute_code'];

$table_name = $_POST['table_name'];
all_in_one_project
date_default_timezone_set("Asia/Bangkok");

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT *

FROM all_in_one_project.job_attribute where attribute_code='".$attribute_code."' and table_name = '".$table_name."'"  or die("Error:" . mysqli_error());

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

  $release_attribute=$row['release_attribute'];

}

echo '<div class="container-md p-4">';

echo '

<nav aria-label="breadcrumb">

<ol class="breadcrumb">

<li class="breadcrumb-item"><a onclick="get_page(&#39;configurable&#39;)">Configurable</a></li>

<li class="breadcrumb-item"><a onclick="get_attribute_config(&#39;'.$table_name.'&#39;)">'.$table_name.'</a></li>

<li class="breadcrumb-item active" aria-current="page">'.$attribute_code.'</li>
all_in_one_project
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

</div>';all_in_one_project
all_in_one_project
if($release_attribute<>'1' ){
all_in_one_project
  ?>

<button type="button" class="btn btn-success btn-sm" id="release_attribute_bt" onclick="release_attribute()">

    <ion-icon name="rocket-outline"></ion-icon>Release Attribute

</button>

<?php

}

echo '

</div>';

//options

echo '

<div class="tab-pane fade" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">

<div id="attribute_option_list"> </div>

';

?>

<button type="button" class="btn btn-dark btn-sm"

    onclick="add_new_option('all_in_one_project','job_attribute_option')" data-bs-toggle="modal"

    data-bs-target="#exampleModal">

    <ion-icon name="add-outline"></ion-icon> Add Option

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

function get_attribute_option_list() {

    var attribute_code = document.getElementById('ja_edit_attribute_code').value;

    var table_name = document.getElementById('ja_edit_table_name').value;

    $.post("/get/get_attribute_option_config_detail.php", {

            attribute_code: attribute_code,

            table_name: table_name

        },

        function(data) {

            $('#attribute_option_list').html(data);

        });

}



function properties_form() {
all_in_one_project
    var id = document.getElementById('id').value;

    var table_name = "'job_attribute'";

    $.post("/form/form_value.php", {

            id: id,

            table_name: table_name

        },

        function(data) {

            $('#properties_form').html(data);

            get_attribute_option_list();

        });

}

properties_form();



function insert_attribute_option_config(id) {

    var attribute_code = document.getElementById('ja_edit_attribute_code').value;

    var table_name = document.getElementById('ja_edit_table_name').value;

    var db_name = document.getElementById('ja_edit_db_name').value;

    document.getElementById('jao_edit_attribute_code').value = attribute_code;

    document.getElementById('jao_edit_attribute_table').value = table_name;

    document.getElementById('jao_edit_db_name').value = db_name;

    update_value_attribute(id, 'jao_edit_attribute_code', 'jao', 'all_in_one_project', 'job_attribute_option', 'id');

    update_value_attribute(id, 'jao_edit_attribute_table', 'jao', 'all_in_one_project', 'job_attribute_option',

    'id');

    update_value_attribute(id, 'jao_edit_db_name', 'jao', 'all_in_one_project', 'job_attribute_option', 'id');

    get_attribute_option_list();

}



function form_attribute_option(id) {

    // var id = document.getElementById('id').value;

    var table_name = "'job_attribute_option'";

    Notiflix.Loading.hourglass('Loading...');

    $.post("/form/form_value.php", {

            id: id,

            table_name: table_name

        },

        function(data) {

            $('#model_lg').html(data);

            Notiflix.Loading.remove();

            insert_attribute_option_config(id);

        });

}

//

function add_new_option(db, table) {

    $.post("/action/action_insert_new_record.php", {

            table: table,

            db: db

        },

        function(data) {

            form_attribute_option(data);

        });

}

//

function delete_option(db, table, id, primary_key_id) {

    Notiflix.Confirm.show(

        'Confirm',

        'Do you want to remove an option id ' + id + '?',

        'Yes',

        'No',

        function okCb() {

            $.post("/action/action_delete_record.php", {

                    table: table,

                    db: db,

                    id: id,

                    primary_key_id: primary_key_id

                },

                function(data) {

                    if (!data.startsWith("Error")) {

                        Notiflix.Notify.success('Option id ' + data + ' have been removed');

                        // Get a reference to the div element

                        var div = document.getElementById('attribute_option_id_' + data);

                        div.remove();

                    } else {

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



function release_attribute() {

    var table = document.getElementById('ja_edit_table_name').value;

    var db = document.getElementById('ja_edit_db_name').value;

    var column = document.getElementById('ja_edit_attribute_code').value;

    var type = document.getElementById('ja_edit_attribute_type').value;

    var id = document.getElementById('ja_edit_id').value;

    $.post("/action/action_alter_column.php", {

            table: table,

            db: db,

            column: column,

            type: type

        },

        function(data) {

            if (!data.startsWith("Error")) {

                Notiflix.Report.success(

                    'Released',

                    'Attribute ' + column + ' have been released',

                    'Okay',

                );

                document.getElementById('release_attribute_bt').hidden = true;

                document.getElementById('ja_edit_release_attribute').value = 1;

                update_value_attribute(id, 'ja_edit_release_attribute', 'ja', 'all_in_one_project',

                    'job_attribute', 'id');

            } else {

                Notiflix.Report.failure(

                    'Release Failure',

                    data,

                    'Okay',

                );

            }

        });

}

</script>