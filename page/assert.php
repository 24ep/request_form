<link rel="stylesheet" href="base/action/notiflix/dist/notiflix-3.2.5.min.css" />
<script src="base/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
<div class="container-fluid ">
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Asserts</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">

            </form>
            <!-- list -->
        </div>
        <div class="container-fluid m-3">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb" id="breadcrumb">
                    <?php include('../get/get_assert_breadcrumb.php'); ?>
                </ol>
            </nav>
            <div class="btn-group" style="margin-bottom: 15px;">
                <button type="button" class="btn btn-outline-dark dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Create New
                </button>
                <ul class="dropdown-menu">
                    <li><a type="button" class="dropdown-item" onclick="ask_label('Folder')">Folder</a></li>
                    <li><a type="button" class="dropdown-item" onclick="ask_label('type')">Block</a></li>
                    <li><a type="button" class="dropdown-item" onclick="ask_label('upload_a_file')">Upload a files</a>
                    </li>
                </ul>
            </div>

            <ul class="list-group" style="width:100%">
                <div id=list_asserts>
                    <?php include('../get/get_list_assert_dri.php'); ?>
                </div>
            </ul>
        </div>
    </nav>
</div>

<script>
function goto_dri(dri_parent) {
    $.post("../base/get/get_list_assert_dri.php", {
        dri_parent: dri_parent
    }, function(data) {
        $('#list_asserts').html(data);
    });
}
</script>
<script>
function change_breadcrumb(dri_id, block_id) {
    $.post("../base/get/get_assert_breadcrumb.php", {
        dri_id: dri_id,
        block_id: block_id
    }, function(data) {
        $('#breadcrumb').html(data);
    });
}
</script>
<script>
function get_block(block_id) {
    $.post("../base/get/get_block_editor.php", {
        block_id: block_id
    }, function(data) {
        $('#list_asserts').html(data);
    });
}
</script>
<script>
function create_assert(label, create_type) {
    var label = label.toLowerCase();
    var code = label.toLowerCase();
    var code = code.replace(/[^a-zA-Z ]/g, "_");
    var parent = document.getElementById('parent').value;
    var path_id = document.getElementById('under_path').value;
    $.post("../base/action/action_create_assert.php", {
        parent: parent,
        label: label,
        code: path_id + '_' + code,
        path_id: path_id,
        create_type: create_type
    }, function(data) {
        // $('#list_asserts').html(data);

        goto_dri(parent);
        Notiflix.Notify.success('asserts have been create :)');


    });
}

function ask_label(create_type) {
    Notiflix.Confirm.prompt(
        'Create assert',
        create_type + ' name',
        create_type + '_name',
        'Submit',
        'Cancel',
        function okCb(clientAnswer, create_type) {
            create_assert(clientAnswer, create_type)
        },
        function cancelCb(clientAnswer) {
            //nothing
        },
    );
}

function remove_assert(assert_type,remove_id) {
    Notiflix.Confirm.show(
        'Confirm',
        'Do you want to remove?',
        'Remove',
        'Cancel',
        function okCb() {
          action_remove_assert(assert_type,remove_id);
          goto_dri(parent);
          Notiflix.Notify.success('asserts have been remove :)');
        },
        function cancelCb() {
            //alert('If you say so...');
        },
    );
}

function action_remove_assert(assert_type,remove_id){
  $.post("../base/action/action_remove_assert.php", {
              assert_type: assert_type,
              remove_id: remove_id
          }, function(data) {
             //nothing
      
          });
}
</script>