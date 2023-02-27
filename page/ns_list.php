
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/slim-select@latest/dist/slimselect.css" />
<?php
session_start();
include_once('../get/get_option_function.php');
$username_op = getoption_return_filter("username","account",$_SESSION["user_filter"],"single","all_in_one_project");
$brand_op = getoption_return_filter_disting("brand","add_new_job","","single","all_in_one_project");
$request_new_status_op = get_option_attribute_entity("status","add_new_job",$_SESSION["status_filter"]);
$business_type_op = get_option_return_filter("business_type","","single","add_new");
$production_type_op = get_option_return_filter("production_type","","single","add_new");
$project_type_op = get_option_return_filter("project_type","New SKU","single","add_new");
$sub_department_op = get_option_return_filter("sub_department","","single","add_new");
$bu_op = get_option_return_filter("bu","CDS","single","add_new");
$tags_op = get_option_return_filter("tags","","multi","add_new");
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


function get_attribute_list_filter(){
    $current_value = "";
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute
    WHERE table_name = 'add_new_job' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
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
        paceholderText: "Add more filter",
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
    <form class="row g-3" >
            <?php include("../form/form_create_ns_ticket.php"); ?>
    </form>
    </div>
</div>
<!-- create Modal -->
<div class="modal fade" id="create_new_ns_modal_new" tabindex="-1" aria-labelledby="create_new_ns_modal_newLabel"
    aria-hidden="true">
    <form class="row g-3" >
            <?php include("../form/form_create_ns_ticket_new.php"); ?>
    </form>
    </div>
</div>
<!-- create new  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5" style="border-bottom: 1px #e1dede solid;">
    <div class="row" style="width:100%">
        <div style="width:auto;place-self: center;">
        <ion-icon name="filter-outline"></ion-icon><strong>Dynamic Filter</strong>
        </div>
            <div style="width:auto">
            <?php echo get_attribute_list_filter(); ?>
            </div>
            <div style="width:auto">
                <div class="input-group input-group-sm" style="position: inherit;">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Page</span>
                        <input type="number" class="form-control" style="position: inherit;" id="pagenation_input" min=1
                            <?php if($_SESSION["total_page_rnj"]<>""){echo "max=".$_SESSION["total_page_rnj"];}?>
                            value="<?php echo $_SESSION["pagenation"];?>" onchange="getFilterInputValues()" placeholder=""
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                            placeholder="Dept , Sub Dept , Brand , ID">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                            <div id="total_page_nj">
                                <?php include('../get/get_total_page_nj.php'); ?>
                            </div>
                        </span>
                </div>
            </div>
        <div style="width:auto">
        <button class="btn btn-danger btn-sm bg-gradient position-absolute "
        type="button" data-bs-toggle="modal" data-bs-target="#create_new_ns_modal"
        style=" right: 55px;">
            <ion-icon size="small" name="add-outline" style="font-size:12px"
            role="img" class="md icon-small hydrated" aria-label="add outline">
            </ion-icon>
            Create New
        </button>
        <?php if($_SESSION['username']=='poojaroonwit'){ ?>
                <button class="btn btn-danger btn-sm bg-gradient position-absolute "
            type="button" data-bs-toggle="modal" data-bs-target="#create_new_ns_modal_new"
            style=" right: 55px;">
                <ion-icon size="small" name="add-outline" style="font-size:12px"
                role="img" class="md icon-small hydrated" aria-label="add outline">
                </ion-icon>
                Create New 2
            </button>
        <?php
        }
        ?>
        </div>
     </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5">
        <div class="row g-3 align-items-center" id="dynamic_filter" style="width: 100%;">

        </div>

</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5">
        <div class="row g-3 align-items-center" id="filter_selected" style="width: 100%;">


        </div>

</nav>
<div style="margin-left: 10px;padding: 0px 20px;">
    <div class="tab-content" id="myTabContent">
        <div class="row align-items-center p-3">
        <div class="col-2">

                </div>



            </ul>
            </nav>
        </div>
    </div>
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
// function update_applyed_filter(){
// //clear selected

// //add new filter

// }
function clearParams() {
    let  queryParams = new URLSearchParams(window.location.search);
    let  pageParam = queryParams.get('page');

  // Delete all query parameters
  queryParams.forEach((value, key) => {
    if (key !== 'page') {
      queryParams.delete(key);
    }
  });

  // Add the "page" parameter back if it was present
  if (pageParam !== null) {
    queryParams.set('page', pageParam);
  }

  let urlWithoutParams = window.location.origin + window.location.pathname;
  if (queryParams.toString()) {
    urlWithoutParams += '?' + queryParams.toString();
  }

  window.history.replaceState({}, document.title, urlWithoutParams);
}



function getFilterInputValues() {
  var pagenation_input = document.getElementById("pagenation_input").value
  var filterPrefix = "filter_";
  var inputs = document.querySelectorAll(`input[id^="${filterPrefix}"], select[id^="${filterPrefix}"]`);
  var inputValues = {};
  clearParams();

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
        if( type=='date'){
            value = value.replace(" ", "");
            value = value.replace(" ", "");
            value = value.replace("AND", "' AND '");
            var formattedValue = `${name} BETWEEN '${value}'`;
        }else if(input.type=='text'){
            value = value.toLowerCase();
            var formattedValue = `${name} like '%${value}%'`;
        }else if(input.type=='number'){
            var formattedValue = `${name} = ${value}`;
        }else if(input.type === "select-multiple"){
            var formattedValue = `${name} in ('${value}')`;
        }

        inputValues[name] = formattedValue;
        updateparams("par_"+name, value);
    }

//create all display

  });

  var outputValues = Object.values(inputValues).join(" and ");
  console.log(outputValues);
//   return `Filter values: ${outputValues}`;
    $.post("../base/get/get_list_ns.php", {
        pagenation_input: pagenation_input,
        outputValues:outputValues
    }, function(data) {
        $('#job_list').html(data);
    });
}


getFilterInputValues();

function get_filter_attribute(){

    var selected = [];
    for (var option of document.getElementById('list_of_filter').options)
    {
        if (option.selected) {
            selected.push("'"+option.value+"'");

        }
    }
    var dynamic_filter = selected.toString();
    console.log(dynamic_filter);
    // dynamic_filter = "'"+value+"'";

    $.post("../base/get/get_dynamic_filter.php", {
        dynamic_filter:dynamic_filter
    }, function(data) {
        $('#dynamic_filter').html(data);
    });
}
get_filter_attribute();


function filter_update(be) {
        var pagenation_input = document.getElementById("pagenation_input").value

        $.post("../base/get/get_list_ns.php", {
            pagenation_input: pagenation_input
        }, function(data) {
            $('#job_list').html(data);
        });

        $.post("../base/get/get_total_page_nj.php", {
            user_filter: user_filter,
            status_filter: status_filter,
            from_post: from_post,
            pagenation_input: pagenation_input,
            brand_filter: brand_filter
        }, function(data) {
            $('#total_page_nj').html(data);
        });
    updateparams('user_filter', user_filter);
    updateparams('brand_filter', brand_filter);

}

function update_brand_note(dataoutput, brand) {
    $.post("../base/action/action_update_brand_note.php", {
        dataoutput: dataoutput,
        brand: brand
    }, function(data) {
        // $('#get_list_job_update').html(data);
    });
}

function start_checking(id) {
    if (id) {
        $.post("../base/action/action_start_checking.php", {
            id: id
        }, function(data) {
            $('#start_checking_resault').html(data);
        });
    }
}

function accepted_stt(id) {
    if (id) {
        // sku_accepted = document.getElementById('sku_accepted').value;
        $.post("../base/action/action_accept_stt.php", {
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
        $.post("../base/action/action_cancel_stt.php", {
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
        $.post("../base/action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel,
            status_change: status_change
        }, function(data) {
            // $('#cancel_checking_resault').html(data);
            var result = data.includes("Error");
                if(result==false){
                  Notiflix.Notify.success(data);
                }else{
                  Notiflix.Report.failure(
                  'Failure',
                  data,
                  'Okay',
                  )
                }
        });
    }
}
function snapshot_data(database,table,primary_key_id,id,ticket_type){

$.post("../base/action/action_data_snapshot.php", {
            database: database,
            table: table,
            primary_key_id: primary_key_id,
            id:id,
            ticket_type:ticket_type
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
        $.post("../base/action/action_submit_add_new_job.php", {
            brand: brand,
            sub_department: sub_department,
            sku: sku,
            production_type: production_type,
            project_type: project_type,
            launch_date: launch_date,
            bu : bu ,
            contact_buyer: contact_buyer,
            contact_vender: contact_vender,
            link_info: link_info,
            remark: remark
        }, function(data) {
            Notiflix.Loading.remove();
            var result = data.includes("Error");
                if(result==false){
                  Notiflix.Notify.success("Ticket have been create already ! NS-"+data);
                  snapshot_data("all_in_one_project","add_new_job","id",data,"add_new_job");
                }else{
                  Notiflix.Report.failure(
                  'Failure',
                  data,
                  'Okay',
                  )
                }
        });
    }
    filter_update();
}
function action_submit_add_new_job_new() {

    var brand = document.getElementById('brand');
    var sub_department = document.getElementById('sub_department');
    var sku = document.getElementById('sku');
    var production_type = document.getElementById('production_type');
    var project_type = document.getElementById('project_type');
    var launch_date = document.getElementById('launch_date');
    var bu = document.getElementById('bu');
    var contact_buyer = document.getElementById('contact_buyer');
    var contact_vender = document.getElementById('contact_vender');
    var link_info = document.getElementById('link_info');
    var remark = document.getElementById('remark');

    var inputs = [brand, sub_department, sku, production_type, project_type, launch_date, bu, contact_buyer, contact_vender, link_info, remark];
    var missingValues = [];

    // Check for missing values and add "in-valid" class to input fields
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value === '') {
            missingValues.push(inputs[i]);
            inputs[i].classList.add('in-valid');
        }
    }

    if (missingValues.length === 0) {
        Notiflix.Loading.hourglass('Creating new ticket ...');
        // If no missing values, send data to server
        $.post("../base/action/action_submit_add_new_job.php", {
            brand: brand.value,
            sub_department: sub_department.value,
            sku: sku.value,
            production_type: production_type.value,
            project_type: project_type.value,
            launch_date: launch_date.value,
            bu : bu.value,
            contact_buyer: contact_buyer.value,
            contact_vender: contact_vender.value,
            link_info: link_info.value,
            remark: remark.value
        }, function(data) {
            Notiflix.Loading.remove();
            var result = data.includes("Error");
            if(result==false){
                Notiflix.Loading.remove();
                Notiflix.Notify.success("Ticket has been created already! NS-"+data);
                snapshot_data("all_in_one_project","add_new_job","id",data,"add_new_job");
            } else {
                Notiflix.Loading.remove();
                Notiflix.Report.failure(
                    'Failure',
                    data,
                    'Okay',
                )
            }
        });

    }
    filter_update();
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
                $.post("../base/action/action_cancel_stt.php", {
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
}
catch{
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
        filter_update();
    }
  }
})


filter_update();
//tooltips
tippy('#brand_filter', {
  content: "สามารถค้นห้า ticket ของคุณได้ด้วยเลข ID , Department , Sub-Department , Brand ของ Ticket",
  placement: 'bottom',
  animation: 'fade',
});
tippy('#user_filter', {
  content: "ป้อน username ของคุณ หรือของผู้ที่คุณต้องการค้นหา",
  placement: 'bottom',
  animation: 'fade',
});
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