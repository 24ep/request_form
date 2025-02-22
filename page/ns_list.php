<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/get/get_option_function.php');
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
// get_contact_requester
$query = "SELECT * FROM all_in_one_project.account where username = '".$_SESSION['username']."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $nickname = $row['nickname'];
    $department = $row['department'];
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
    $get_contact_buyer = $row['firstname']." ".$row['lastname']." ( ".$nickname." )\nEmail: ".$row['work_email']."\nOffice tell: ".$row['office_tell'];
}
mysqli_close($con);
function get_attribute_list_filter($table){
    $current_value = "";
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM all_in_one_project.job_attribute
    WHERE table_name = '".$table."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
    $result_op = mysqli_query($con, $query_op);
    $i=0;
    while($option = mysqli_fetch_array($result_op)) {
        if($option["default_filter_grid"]==1){
        $selected = 'selected';
        }else{
        $selected = '';
        }
        if($option["attribute_code"]<>"" and $i==0){
        $i++;
        $option_element .= "<option ".$selected ." style='color: #ffffff;' value=''></option>";
        }
        $option_element .= "<option ".$selected ." style='color: #ffffff;' value='".$option["attribute_code"]."'>".$option["attribute_label"]."</option>";
    }
    $input = '
        <select multiple  id="list_of_filter" class="border-0 shadow-sm bg-dark" onchange="get_filter_attribute()">
        '.$option_element.'
        </select>
    <script>
    new SlimSelect({
    select: "#list_of_filter",
    settings: {
        maxValuesShown: 1,
        maxValuesMessage: "{number} filter selected",
        placeholderText: "Add more filter",
        maxSelected: 10,
        allowDeselect: true
    }
    })
    </script>
    ';
    return $input;
}
?>
<!-- create Modal -->
<div class="modal fade" id="create_new_ns_modal" tabindex="-1" aria-labelledby="create_new_ns_modalLabel"
    aria-hidden="true">
    <form class="row g-3">
        <?php
        include($_SERVER['DOCUMENT_ROOT']."/form/form_create_ns_ticket.php"); ?>
    </form>
</div>
</div>
<!-- create Modal -->
<div class="modal fade" id="create_new_ns_modal_new" tabindex="-1" aria-labelledby="create_new_ns_modal_newLabel"
    aria-hidden="true">
    <form class="row g-3">
        <?php
        include($_SERVER['DOCUMENT_ROOT']."/form/form_create_ns_ticket_new.php"); ?>
    </form>
</div>
</div>
<!-- create new  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5"
    style="border-bottom: 1px #e1dede solid;">
    <div class="row" style="width:100%">
        <div style="width:auto;place-self: center;">
            <ion-icon name="filter-outline"></ion-icon><strong>Dynamic Filter</strong>
        </div>
        <div style="width:auto">
            <?php echo get_attribute_list_filter('add_new_job'); ?>
        </div>
        <div style="width:auto">
            <div class="input-group input-group-sm" style="position: inherit;">
                <span class="input-group-text" id="inputGroup-sizing-sm">Page</span>
                <input type="number" class="form-control" style="position: inherit;" id="page_navigator_input" min=1
                    <?php if($_SESSION["total_page_rnj"]<>""){echo "max=".$_SESSION["total_page_rnj"];}?>
                    value="<?php echo $_SESSION["pagenation"];?>" onchange="getFilterInputValues('skip_clear_param')" placeholder=""
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                    placeholder="Dept , Sub Dept , Brand , ID">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <div id="total_page_nj">
                    </div>
                </span>
            </div>
        </div>
        <div style="width:auto">
            <button class="btn btn-danger btn-sm bg-gradient position-absolute " type="button" data-bs-toggle="modal"
                data-bs-target="#create_new_ns_modal" style=" right: 55px;">
                <ion-icon size="small" name="add-outline" style="font-size:12px" role="img"
                    class="md icon-small hydrated" aria-label="add outline">
                </ion-icon>
                Create New
            </button>
    
        </div>
    </div>
</nav>
<nav class="navbar bg-white shadow-sm ps-4 pe-5 mb-3">
    <div class="row g-3 align-items-center" id="dynamic_filter" style="width: 100%;">
    </div>
</nav>
<div style="margin-left: 10px;padding: 0px 20px;">
    <li class="row mb-3 header_list_add_new">
        <div class="col" scope="col">Ticket ID</div>
        <div class="col" scope="col">Department</div>
        <div class="col" scope="col">Brand</div>
        <div class="col" scope="col">SKU</div>
        <div class="col" scope="col">Production</div>
        <div class="col" scope="col">launch date</div>
        <div class="col" scope="col">Badge</div>
        <div class="col" scope="col">Status</div>
        <div class="col" scope="col">Action</div>
    </li>
    <div id="job_list">
    </div>
</div>
<script>
function getFilterInputValues($clear_param) {
    var page_navigator_input = document.getElementById("page_navigator_input").value
    if(page_navigator_input==""){
        document.getElementById("page_navigator_input").value  =1;
        page_navigator_input=1;
    }
    var filterPrefix = "filter_";
    var inputs = document.querySelectorAll(`input[id^="${filterPrefix}"], select[id^="${filterPrefix}"]`);
    var inputValues = {};
    if($clear_param=='clear_param'){
        clearParams();
    }
    
    inputs.forEach(input => {
        var name = input.getAttribute("attribute_code");
        var type = input.getAttribute("attribute_type");
        var value = input.value;
        if (input.type === "select-multiple") {
            // handle multi-select element
            var selectedOptions = Array.from(input.options).filter(option => option.selected);
            value = selectedOptions.map(option => option.value).join("','");
        }
        if (value !== null && value !== "") {
            if (type == 'date') {
                value = value.replace(" ", "");
                value = value.replace(" ", "");
                value = value.replace("AND", "' AND '");
                var formattedValue = `${name} BETWEEN '${value}'`;
            } else if (input.type == 'text') {
                value = value.toLowerCase();
                var formattedValue = `${name} like '%${value}%'`;
            } else if (input.type == 'number') {
                var formattedValue = `${name} = ${value}`;
            } else if (input.type === "select-multiple") {
                var formattedValue = `${name} in ('${value}')`;
            }
            inputValues[name] = formattedValue;
            update_params("par_" + name, value);
        }
        //create all display
    });
    var outputValues = Object.values(inputValues).join(" and ");
    console.log(outputValues);
    //   return `Filter values: ${outputValues}`;
    $.post("/get/get_list_ns.php", {
        page_navigator_input: page_navigator_input,
        outputValues: outputValues
    }, function(data) {
        $('#job_list').html(data);
    });
}
getFilterInputValues("skip_clear_param");
function get_filter_attribute() {
    var selected = [];
    for (var option of document.getElementById('list_of_filter').options) {
        if (option.selected) {
            selected.push("'" + option.value + "'");
        }
    }
    var dynamic_filter = selected.toString();
    var table_name='add_new_job';
    console.log(dynamic_filter);
    // dynamic_filter = "'"+value+"'";
    $.post("/get/get_dynamic_filter.php", {
        dynamic_filter: dynamic_filter,
        table_name:table_name
    }, function(data) {
        $('#dynamic_filter').html(data);
    });
}
get_filter_attribute();
function update_brand_note(dataoutput, brand) {
    $.post("/action/action_update_brand_note.php", {
        dataoutput: dataoutput,
        brand: brand
    }, function(data) {
        // $('#get_list_job_update').html(data);
    });
}
function start_checking(id) {
    if (id) {
        $.post("/action/action_start_checking.php", {
            id: id
        }, function(data) {
            $('#start_checking_resault').html(data);
        });
    }
}
function accepted_stt(id) {
    if (id) {
        // sku_accepted = document.getElementById('sku_accepted').value;
        $.post("/action/action_accept_stt.php", {
            id: id
            // sku_accepted: sku_accepted
        }, function(data) {
            $('#accept_checking_resault').html(data);
        });
    }
}
function cancel_stt(id, status_change) {
    resone_cancel = document.getElementById('resone_cancel').value;
    status_change = 'cancel';
    if (id) {
        $.post("/action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel,
            status_change: status_change
        }, function(data) {
            $('#cancel_checking_resault').html(data);
        });
    }
}
function cancel_ticket(id) {
    resone_cancel = document.getElementById('reason_cancel').value;
    status_change = document.getElementById('type_cancel').value;
    // status_change = 'cancel';
    if (id) {
        $.post("/action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel,
            status_change: status_change
        }, function(data) {
            // $('#cancel_checking_resault').html(data);
            var result = data.includes("Error");
            if (result == false) {
                Notiflix.Notify.success(data);
            } else {
                Notiflix.Report.failure(
                    'Failure',
                    data,
                    'Okay',
                )
            }
        });
    }
}
function snapshot_data(database, table, primary_key_id, id, ticket_type) {
    // console.log(database+ table+ primary_key_id+ id+ ticket_type)
    $.post("/action/action_data_snapshot.php", {
        database: database,
        table: table,
        primary_key_id: primary_key_id,
        id: id,
        ticket_type: ticket_type
    }, function(data) {
        Notiflix.Notify.success(data);
    });
}
function action_submit_add_new_job() {
    Notiflix.Loading.hourglass('Creating new ticket ...');
    brand = document.getElementById('brand').value;
    sub_department = document.getElementById('sub_department').value;
    sku = document.getElementById('sku').value;
    production_type = document.getElementById('production_type').value;
    project_type = document.getElementById('project_type').value;
    launch_date = document.getElementById('launch_date').value;
    bu = document.getElementById('bu').value;
    contact_buyer = document.getElementById('contact_buyer').value;
    contact_vender = document.getElementById('contact_vender').value;
    link_info = document.getElementById('link_info').value;
    remark = document.getElementById('remark').value;
    // status_change = 'cancel';
    if (brand) {
        $.post("/action/action_submit_add_new_job.php", {
            brand: brand,
            sub_department: sub_department,
            sku: sku,
            production_type: production_type,
            project_type: project_type,
            launch_date: launch_date,
            bu: bu,
            contact_buyer: contact_buyer,
            contact_vender: contact_vender,
            link_info: link_info,
            remark: remark
        }, function(data) {
            Notiflix.Loading.remove();
            var result = data.includes("Error");
            if (result == false) {
                Notiflix.Notify.success("Ticket have been create already ! NS-" + data);
                getFilterInputValues("clear_param");
                snapshot_data("all_in_one_project", "add_new_job", "id", data, "add_new_job");
            } else {
                Notiflix.Report.failure(
                    'Failure',
                    data,
                    'Okay',
                )
            }
        });
    }
}
function action_submit_add_new_job_new() {
    Notiflix.Loading.hourglass('Creating new ticket ...');
    var brand = document.getElementById('init_brand');
    var sub_department = document.getElementById('init_sub_department');
    var sku = document.getElementById('init_sku');
    var production_type = document.getElementById('init_production_type');
    var project_type = document.getElementById('init_project_type');
    var launch_date = document.getElementById('init_launch_date');
    var bu = document.getElementById('init_bu');
    var contact_buyer = document.getElementById('init_contact_buyer');
    var contact_vender = document.getElementById('init_contact_vender');
    var link_info = document.getElementById('init_link_info');
    var remark = document.getElementById('init_remark');
    var elementIds = [
        'init_brand',
        'init_sub_department',
        'init_sku',
        'init_production_type',
        'init_project_type',
        'init_launch_date',
        'init_bu',
        'init_contact_buyer',
        'init_contact_vender',
        'init_link_info'
    ];
    var missingValues = [];
    // Check for missing values and add red small text next to input fields
    if(document.getElementById('errorMsg')){
            document.getElementById('errorMsg').remove();
    }
    for (var i = 0; i < elementIds.length; i++) {
        var element = document.getElementById(elementIds[i]);
        console.log(elementIds[i] + " = " + element.value)
        document.getElementById(elementIds[i]).classList.remove('is-invalid');
        document.getElementById(elementIds[i]).classList.remove('is-valid');
        if (element.value === '') {
            missingValues.push(document.getElementById(elementIds[i]));
            document.getElementById(elementIds[i]).classList.add('is-invalid');
            var errorMsg = document.createElement('small');
            errorMsg.innerText = 'This field is required';
            errorMsg.style.color = 'red';
            errorMsg.id = 'errorMsg';
            document.getElementById(elementIds[i]).parentNode.insertBefore(errorMsg, element.nextSibling);
        } else {
            document.getElementById(elementIds[i]).classList.add('is-valid');
        }
    }
    if (missingValues.length === 0) {
        // If no missing values, send data to server
        $.post("/action/action_submit_add_new_job.php", {
            brand: brand.value,
            sub_department: sub_department.value,
            sku: sku.value,
            production_type: production_type.value,
            project_type: project_type.value,
            launch_date: launch_date.value,
            bu: bu.value,
            contact_buyer: contact_buyer.value,
            contact_vender: contact_vender.value,
            link_info: link_info.value,
            remark: remark.value
        }, function(data) {
            Notiflix.Loading.remove();
            var result = data.includes("Error");
            if (result == false) {
                Notiflix.Notify.success("Ticket has been created already! NS-" + data);
                snapshot_data("all_in_one_project", "add_new_job", "id", data, "add_new_job");
            } else {
                Notiflix.Report.failure(
                    'Failure',
                    data,
                    'Okay',
                )
            }
        });
    } else {
        // If missing values, show error message
        Notiflix.Loading.remove();
        Notiflix.Report.failure(
            'Error',
            'Please fill in all required fields.',
            'Okay',
        );
    }
    // filter_update();
}
// action_submit_add_new_job
function itm_confirm_cancel(id, status_change) {
    let message = prompt("พิมพ์ " + status_change + " อีกครั้งเพื่อยืนยัน", "");
    if (message == null || message == "") {
        alert("user cancel prompt");
    } else {
        if (message == status_change) {
            if (id) {
                resone_cancel = document.getElementById('itm_reason_cancel').value;
                $.post("/action/action_cancel_stt.php", {
                    id: id,
                    resone_cancel: resone_cancel,
                    status_change: status_change
                }, function(data) {
                    $('#cancel_checking_result').html(data);
                });
            }
        } else {
            alert("ไม่ตรงกัน ลองใหม่อีกครั้ง");
        }
    }
}
try {
    status_filter_show_object.destroy()
} catch {
    //nothing todo
}
var status_filter_show_object = new SlimSelect({
    select: '#status_filter_show',
    settings: {
        closeOnSelect: false,
        allowDeselectOption: true,
    },
    events: {
        afterChange: (info) => {
            var input_update = "";
            for (let i = 0; i < info.length; i++) {
                if (input_update == "") {
                    input_update = info[i].value;
                } else {
                    input_update = input_update + ',' + info[i].value;
                }
            }
            document.getElementById("status_filter").value = input_update;
        }
    }
})
//toolstips create new ticket
tippy('#brand', {
    content: "ระบุซื่อแบรนด์ของสินค้าที่ใช้สำหรับขึ้นหน้าเว็บไซด์",
    placement: 'right',
    animation: 'fade',
});
tippy('#sub_department', {
    content: "เลือกหมวดหมู่ของสินค้าที่เกี่ยวข้อง",
    placement: 'right',
    animation: 'fade',
});
tippy('#sku', {
    content: "ป้อน จำนวน sku ของ ticket",
    placement: 'right',
    animation: 'fade',
});
tippy('#production_type', {
    content: "<ul><li>Packshort = ถ่ายรูปสินค้าอย่างเดียว</li><li>Model = ถ่ายรูปสินค้าร่สมกับนางแบบ/นายแบบ</li><li>Resize = มีรูปภาพสินค้าอยู่แล้ว แค่ Resize หรือ Retouch เท่านั้น</li><li>No info = ไม่แน่ใจ ให้ทีมติดต่อกลับ</li></ul>",
    placement: 'right',
    animation: 'fade',
    allowHTML: true,
});
tippy('#launch_date', {
    content: "กำหนดวันขึ้นขายของสินค้า ในกรณีที่ระบุ สินค้าจะถูกปรับ Enable ณ วันที่ระบุเท่านั้น",
    placement: 'right',
    animation: 'fade',
});
tippy('#link_info', {
    content: "Link สำหรับ files ข้อมูลของสินค้า และ ไฟล์รูปภาพ",
    placement: 'right',
    animation: 'fade',
});
</script>