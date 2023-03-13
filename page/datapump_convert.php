<!-- <span style="
    position: fixed;
    color: white;
    background: black;
    padding: 5px 20px;
    border-radius: 0px 0px 10px 0px;
    z-index: 1;"
class="shadow-sm span-ifram">https://cdse-commercecontent.com/base/page_convert_datapump_new.php</span> -->
<!-- <iframe src="https://cdse-commercecontent.com/base/page_convert_datapump_new.php"
    style="
    position: unset;
    top: 0;
    bottom: 0;
    width: 100%;
    height: -webkit-fill-available;
    min-height: 1000px;
    border: none;
    margin: 0;
    width: 100%;
    overflow: hidden;
    z-index: 1;"
    title="cto_datapump">
</iframe> -->

    <style>

    .template-generate-header-s {
        color: #737df4;
    }
    .template-generate-sub-s {
        color: #969696;
    }
    .form-control,
    .form-select {
        /* width: 25%; */
        font-size: 13px;
        margin-bottom: 3%;
    }
    .gen-btn {
        /* margin-top:0.5%; */
        width: 100%;
    }
    </style>
<div class="container-md p-3 bg-white">
    <h4>Datapump <span class="template-generate-header-s"> | Template Generate</span></h4>
    <small class="template-generate-sub-s">Please use lastest Linesheet<small>
            <hr>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <div class="form-floating">
                            <select onchange="update_bh_source();" class="form-select" id="bh_source"
                                aria-label="Floating label select example">
                                <option value="upload" selected>Upload the file</option>
                                <option value="use_ftp">Use cleand file in 24EP</option>
                            </select>
                            <label for="floatingSelect">Input file</label>
                        </div>
                        <input class="form-control" type="file" id="inputfile" name="inputfile">
                        <hr>
                        <!-- <select size="15" class="form-select" style="display:none" id="bh_source_nm" multiple
                            aria-label="multiple select example">
                            <?php //$op_status = getoption_return("store","job_option_cms",""); echo $op_status;?>
                        </select> -->
                        <label for="formFile" class="form-label" style="margin-right:2%;color:black">Generate New file
                            as</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                id="file_type_gen_csv" value="csv" checked>
                            <label class="form-check-label" for="inlineRadio1" style="color:black">CSV</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                id="file_type_gen_xlsx" value="xlsx">
                            <label class="form-check-label" for="inlineRadio2" style="color:black">XlSX</label>
                        </div>
                        <button onClick="send_file_to_convert();" type="button" id="convert_bt"
                            class="btn btn-outline-primary gen-btn btn-sm">Ganerate Template</button>
                            <hr>
                        <select size="15" class="form-select" id="multiselectfile" name="multiselectfile" multiple
                            aria-label="multiple select example">
                            <?php
                            //  date_default_timezone_set("Asia/Bangkok");
                            //  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
                            //  mysqli_query($con, "SET NAMES 'utf8' ");
                            //  $query = "SELECT file.job_number , job_cms.brand as brand, job_cms.sku ,file.id, file.file_name, file.file_path, file.create_at,  file.remark,  file.file_owner
                            //  FROM u749625779_cdscontent.file_manage as file
                            //  left join all_in_one_project.add_new_job as job_cms
                            //  on job_cms.job_number = file.job_number
                            //  where lower(job_cms.datapump)  in ('unsuccessful','wait pump') and job_cms.approved_date is null and file.file_type in ('Buyerfile') ORDER BY job_cms.job_number DESC" or die("Error:" . mysqli_error($con));
                            //  $result = mysqli_query($con, $query);
                            //  while($row = mysqli_fetch_array($result)) {
                            //     $herf = $row['file_path'].$row['file_name'];
                            //     echo "<option value='".htmlentities($herf,ENT_QUOTES)."' >".htmlentities($row["file_name"],ENT_QUOTES)."</option>";
                            //  }
                                ?>
                            <hr>
                             <?php
                             date_default_timezone_set("Asia/Bangkok");
                             $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
                             mysqli_query($con, "SET NAMES 'utf8' ");
                             $query = "SELECT file.ticket_id , job_cms.brand as brand, job_cms.sku ,file.id, file.file_name, file.file_path
                             FROM all_in_one_project.attachment as file
                             left join all_in_one_project.add_new_job as job_cms
                             on job_cms.id  = file.ticket_id
                             where lower(job_cms.datapump)  in ('unsuccessful','wait pump') and job_cms.approved_date is null and file.file_group in ('Original') ORDER BY job_cms.job_number DESC" or die("Error:" . mysqli_error($con));
                             $result = mysqli_query($con, $query);
                             while($row = mysqli_fetch_array($result)) {
                                $file_path = str_replace('../../','../',$row['file_path']);
                                $herf = $file_path.$row['file_name'];
                                // $herf = "https://content-service-gate.cdse-commercecontent.com/".$file_path.$row['file_name'];
                                echo "<option value='".htmlentities($herf,ENT_QUOTES)."' >".htmlentities($row["file_name"],ENT_QUOTES)."</option>";
                             }
                                ?>

                        </select>
                        <button onClick="send_file_to_convert_multi();" type="button" id="convert_multi_bt"
                            class="btn btn-outline-primary gen-btn btn-sm">Ganerate multi Template</button>
                    </div>
                </div>
                <div class="col-9">
                    <div id="call_preview_respone"></div>
                </div>
            </div>
</div>
<script>
function send_file_to_convert() {
    document.getElementById('convert_bt').innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:5px"></span>Loading...';
    var form_data = new FormData();
    var files = document.getElementById('inputfile').files;
    var bh_source = document.getElementById("bh_source").value;
    // var multifile_id = document.getElementById("multiselectfile  option:selected");
    //     $(multifile_id).each(function(index, brand){
    //        var multifile_id_lists =  multifile_id_lists+","+[$(this).val()];
    //     });
    // file type generate
    if (document.getElementById('file_type_gen_csv').checked) {
        file_type_gen = document.getElementById('file_type_gen_csv').value;
    } else if (document.getElementById('file_type_gen_xlsx').checked) {
        file_type_gen = document.getElementById('file_type_gen_xlsx').value;
    } else {
        file_type_gen = document.getElementById('file_type_gen_csv').value;
    }
    form_data.append("files", files[0]); // Appending parameter named file with properties of file_field to form_data
    form_data.append("file_type_gen", file_type_gen);
    form_data.append("bh_source", bh_source);
    // form_data.append("multifile_id", multifile_id_lists);
    // console.log(multifile_id);
    $.ajax({
        url: "../base/convert/phpexcel/datapump_multi_convert.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_preview_respone').html(data);
            document.getElementById('convert_bt').innerHTML = "Success !";
        }
    });
}
function send_file_to_convert_multi() {
    document.getElementById('convert_multi_bt').innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:5px"></span>Loading...';
    var form_data = new FormData();
    var bh_source = document.getElementById("bh_source").value;
     var selected = [];
    for (var option of document.getElementById('multiselectfile').options) {
        if (option.selected) {
            selected.push(option.value);
        }

    }
     var multiselectfile = selected.toString();
    console.log(multiselectfile);
    // file type generate
    if (document.getElementById('file_type_gen_csv').checked) {
        file_type_gen = document.getElementById('file_type_gen_csv').value;
    } else if (document.getElementById('file_type_gen_xlsx').checked) {
        file_type_gen = document.getElementById('file_type_gen_xlsx').value;
    } else {
        file_type_gen = document.getElementById('file_type_gen_csv').value;
    }
    form_data.append("file_type_gen", file_type_gen);
    form_data.append("multiselectfile", multiselectfile);
    console.log('append already');
    $.ajax({
        url: '../base/convert/phpexcel/datapump_multi_convert.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_preview_respone').html(data);
            document.getElementById('convert_multi_bt').innerHTML = "Success !";
        }
    });
}
function update_bh_source() {
    var inputfile = document.getElementById('inputfile');
    // var multiselectfile = document.getElementById("multiselectfile");
    var bh_source = document.getElementById("bh_source").value;
    if (bh_source == "upload") {
        inputfile.style.display = "block";
        // multiselectfile.style.display = "none";
    }
    if (bh_source == "use_ftp") {
        inputfile.style.display = "none";
        // multiselectfile.style.display = "block";
    }
}
</script>
