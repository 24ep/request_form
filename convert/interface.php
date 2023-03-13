<?php
session_start();
$id = $_POST["id"];
$job_number = $_POST["job_number"];
$launch_date = $_POST["launch_date"];
$content_assign_name = $_POST["content_assign_name "];

function get_value($crid,$col_re,$db){
    $con_cr= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con_cr));
    mysqli_query($con_cr, "SET NAMES 'utf8' ");
    $query_cr = "SELECT * FROM u749625779_cdscontent.".$db." ORDER BY id DESC" or die("Error:" . mysqli_error($con_cr));
    $result_cr = mysqli_query($con_cr, $query_cr);
    while($row_cr = mysqli_fetch_array($result_cr)) {
            if($crid==$row_cr["id"]){
                $current_cr = $row_cr[$col_re];
            }
    }
    mysqli_close($con_cr);
    return $current_cr;
}
// get fill setting convert from pim db
  $con_pim= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con_pim));
  mysqli_query($con_pim, "SET NAMES 'utf8' ");
  $query_pim = "SELECT * FROM u749625779_cdscontent.pim_attribute_convert_im_form " or die("Error:" . mysqli_error( $con_pim));
  $result_pim = mysqli_query($con_pim, $query_pim);
  while($row_pim= mysqli_fetch_array($result_pim)) {
    if($row_pim["linesheet_type"]=="convert_setting" and $row_pim["is_create_first"]=="Yes"){
      if($row_pim["default_setting"]=="use_ticket_value"){
        $setting_value = get_value($id,$row_pim["linesheet_code"],"job_cms");
      }else{
        $setting_value = $row_pim["default_setting"];
      }
      $setting_form .= '
                        <div class="row align-items-center mb-2">
                            <div class="col-auto">
                                <label for="'.$row_pim["linesheet_code"].'" style="width:100px;justify-content:left;">'.$row_pim["linesheet_code"].'</label>
                            </div>
                            <div class="col-auto">
                                <input style="width:250px" type="text" id="'.$row_pim["linesheet_code"].'" name="'.$row_pim["linesheet_code"].'" class="form-control  form-control-sm mx-sm-3" aria-describedby="'.$row_pim["linesheet_code"].'HelpInline" value="'.$setting_value.'">
                            </div>
                            <div class="col-auto">
                                <small id="'.$row_pim["linesheet_code"].'HelpInline" class="text-muted">
                                    '.$row_pim["help_des_attribute"].'
                                </small>
                            </div>
                        </div>
                      ';
    }
  }
  $get_setting_pim_convert =  $setting_form;
  unset($setting_form);
  $query_pim = "SELECT * FROM u749625779_cdscontent.pim_function_convert_control " or die("Error:" . mysqli_error($con_pim));
  $result_pim = mysqli_query($con_pim, $query_pim);
  while($row_pim= mysqli_fetch_array($result_pim)) {
      $array_option = explode(',',$row_pim["more_option"] );
      foreach ($array_option as $option) {
          if($row_pim["default_setting"]==$option){
              $option_function .= "<option selected>".$option."</option>";
          }else{
              $option_function .= "<option>".$option."</option>";
          }
        }
      $setting_form .= '<div class="row align-items-center mb-2">
                            <div class="col-auto">
                                <label for="'.$row_pim["code"].'" style="justify-content:left;">'.$row_pim["code"].'</label>
                            </div>
                          <div class="col-auto">
                            <select class="form-select form-select-sm" id="'.$row_pim["code"].'" name="'.$row_pim["code"].'">
                                    '.$option_function.'
                            </select>
                          </div>

                      </div>';
                //       <div class="col-auto">
                //       <small id="'.$row_pim["code"].'HelpInline" class="text-muted" style="margin-left:10px">
                //           '.$row_pim["help_info"].'
                //       </small>
                //   </div>
    unset($option_function);
  }
  $get_setting_pim_convert_function =  $setting_form;
    unset($setting_form);
  //-end getting------------------------------------------------------
    ?>
<div class="bg-white p-5">
    <h6 class="modal-title " id="staticBackdropLabel">Convert <strong style="color:#dc3545"> IM Form </strong> to
        <strong style="color:#663399">PIM</strong>
        Template <strong><?php echo $job_number; ?></strong> ID <strong><?php echo $id; ?></strong> | Writer by <strong>
            <?php echo $content_assign_name; ?> </strong>
    </h6>
    <div class="custom-file mb-2 mt-2">

        <input type="file" class="form-control form-control-sm custom-file-input" id="linesheet_akeneo_file"
            name="linesheet_akeneo_file" aria-describedby="linesheet_akeneo_file" style="opacity: 1;width:80%">
    </div>
    <hr>

    <form id="pre_convert_form">
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <input type="hidden" id="job_number" name="job_number" value="<?php echo $job_number; ?>">
        <div class="row mt-2">

            <div class="col-6">
                <small><strong>Job Setting</strong></small>
                <?php echo $get_setting_pim_convert; ?>
            </div>

            <div class="col-6">
                <small><strong>Grouping</strong></small>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">skutype</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="skutype" name="skutype" value="GR"
                            oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">BU Create</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="bu_create" name="bu_create" value="CDS"
                            oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">User ID</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="ug_id" name="ug_id"
                            value="<?php echo sprintf("%02d", $_SESSION["group_id"]); ?>" oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">Year</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="g_year" name="g_year" value="<?php echo date("y"); ?>"
                            oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">Month</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="g_month" name="g_month"
                            value="<?php echo date("m"); ?>" oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">Running (4 DG)</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="g_running" name="g_running" value=""
                            placeholder="XXXX" oninput="changed_parent()">
                    </div>
                </div>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">Parent : </label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px;border: 0px;font-weight: bold;" readonly type="text"
                            class="form-control  form-control-sm mx-sm-3" id="parent" name="parent" value="">
                    </div>
                </div>
                <hr>
                <div class="row  align-items-center mb-2">
                    <div class="col-auto">
                        <label style="width:100px;justify-content:left;">Sheet Name</label>
                    </div>
                    <div class="col-auto">
                        <input style="width:250px" type="text" class="form-control  form-control-sm mx-sm-3"
                            aria-describedby="typeHelpInline" id="sheet_name" name="sheet_name" value="IM FORM"
                            placeholder="work sheet name in excel">
                    </div>
                </div>
                <hr>
                <small><strong>Function control</strong></small>
                <?php echo $get_setting_pim_convert_function; ?>
    </form>
    <hr>
    <button type="button" onclick="convert()" class="btn btn btn-danger bg-gradient "
        style="position: absolute;border:none">
        <ion-icon name="sync-outline"></ion-icon>Convert to Template
    </button>
    <small>Have a good day, :> </small>
</div>
</div>
</div>

<?php mysqli_close($con_pim); ?>
<script>
changed_parent();

function changed_parent() {
    var skutype = document.getElementById("skutype").value;
    var bu_create = document.getElementById("bu_create").value;
    var ug_id = document.getElementById("ug_id").value;
    var g_year = document.getElementById("g_year").value;
    var g_month = document.getElementById("g_month").value;
    var g_running = document.getElementById("g_running").value;
    document.getElementById("parent").value = skutype + bu_create + ug_id + g_year + g_month + g_running;
}

function convert(id) {
    try {
        Notiflix.Loading.hourglass('Converting , pls wait ...');
        var form_data = new FormData();

        const onlyInputs = document.querySelectorAll('#pre_convert_form input');
        // const formElements = Array.from(form.elements);

        onlyInputs.forEach(input => {
            // var element = document.getElementById(element).value;
            console.log(input.id + "=>" + input.value);
            form_data.append(input.id, input.value)

        });

        const onlySelects = document.querySelectorAll('#pre_convert_form select');
        // const formElements = Array.from(form.elements);

        onlySelects.forEach(select => {
            // var element = document.getElementById(element).value;
            console.log(select.id + "=>" + select.value);
            form_data.append(select.id, select.value)

        });

        // var count_files = document.getElementById('linesheet_akeneo_file').files.length;
        // for (var x = 0; x < count_files; x++) {
        //     form_data.append("linesheet_akeneo_file", document.getElementById('linesheet_akeneo_file').files[x]);
        // }
        form_data.append("linesheet_akeneo_file", document.getElementById('linesheet_akeneo_file').files[0]);

        $.ajax({
            url: "base/convert/phpexcel/function_convert_im_form_to_akeneo.php",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post',
            success: function(data) {
                $('#model_lg').html(data);
                Notiflix.Loading.remove();
            }
        });
    } catch (err) {
        Notiflix.Loading.remove();
        Notiflix.Report.failure(
            'Failure',
            err.message,
            'Okay',
        )
    }
}
</script>