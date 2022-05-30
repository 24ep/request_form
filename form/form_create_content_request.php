<?php 
  session_start();
  function return_option_create_cr($current_value,$attr_id){
    session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      $query_op = "SELECT * FROM content_service_gate.attribute_option
      WHERE attribute_id = ".$attr_id." and function = 'content_request' ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));
      $result_op = mysqli_query($con, $query_op);
      if($current_value==""){
        $option_element = "<option selected value=''></option>";
      }
      while($option = mysqli_fetch_array($result_op)) {
        if($option["attribute_option"]==$current_value){
            $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
          }else{
            $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
          }
      }
    return $option_element;
  }
  function project_bucket(){
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM project_bucket where status <> 'Close' ORDER BY id asc" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
              if($row["prefix"]=="CR"){
                $option .=  "<option selected value='".$row["prefix"]."'>".$row["project_name"]."</option>";
              }else{
                $option .=  "<option value='".$row["prefix"]."'>".$row["project_name"]."</option>";
              }
              
            }
            return $option;

  }
        function getoption_cr($col,$table,$select_option,$sorm,$database) {
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
          // split array store
                  if($sorm=="multi"){
                    if($col=="store" or $col=="itemmize_type" or $col=="product_website" or $col=="tags"){
                      $array_store = explode(', ', $select_option);
                      $duplicate_op = false;
                      $loop_in_null = false;
                      foreach($array_store as $store)
                      {
                        if($row[$col] <> '' ) {
                          if($store==$row[$col]){
                            $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                            $duplicate_op = true;
                          }
                        }
                      }
                      if($row[$col] <> ''){
                        if($duplicate_op == false){
                          $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                        }
                      }
                    }
                  }else{
                    if($loop_in_null==false){
                      $option_set .= '<option value=""></option>';
                      $loop_in_null=true;
                    }
                      if($row[$col] <> '' )
                      {
                          if($select_option==$row[$col]){
                            $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                          }else{
                              $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                          }
                      }
              }
            }
               mysqli_close($con);
               return $option_set;
               
              }
       //$department_op = getoption_cr("department","job_option_cms",$department,"single","u749625779_cdscontent");
      //  $product_website_op = getoption_cr("product_website","job_option_cms","CDS","multi","u749625779_cdscontent");
       $cr_important_op = getoption_cr("cr_important","option","Low","single","all_in_one_project");
      //  $cr_issue_type_op = getoption_cr("issue_type","option","","single","all_in_one_project");
      //  $cr_product_category_op = getoption_cr("product_category","option","","single","all_in_one_project");

       $project_bucket = project_bucket();
       $cr_issue_type_op = return_option_create_cr("","39");
?>
  <div class="row">
    <div class="form-group">
        <label for="cr_title" class="cr_title" >Topic</label>
        <input type="text" class="form-control form-control-sm" placeholder="ใส่หัวข้อเรื่องของคุณที่นี่" id="cr_title" name="cr_title" aria-describedby="emailHelp">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group" style="margin-top:10px">
        <textarea class="form-control form-control-sm" id="cr_description" name="cr_description" rows=12" placeholder="กรุณาระบุ ข้อมูลโดยละเอียด และ SKU ที่เกี่ยวข้องให้ชัดเจน"></textarea>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
      <label for="cr_ticket_type" class="form-label">*Request for</label>
      <select id="cr_ticket_type" onchange="SelectedBucket()" name="cr_ticket_type" class="form-select form-select-sm">
      <?php echo $cr_issue_type_op;?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="cr_sku" class="form-label">Total SKU</label>
      <input type="number" value=0 class="form-control form-control-sm" id="cr_sku" name="cr_sku" min="0">
    </div>
    <?php
       //Calculate min date
      //---set holiday
        $holiday = array(
              '2017-12-16\T00:00' => 'Victory Day of Bangladesh',
              '2017-12-25\T00:00' => 'Christmas'
        );
        $i = 0;
        $work_day = date("Y-m-d\Th:i"); //---get current day
        while($i != 1) //---loop 7 day for set min date
        {
          $work_day = date('Y-m-d\Th:i', strtotime('+1 day', strtotime($work_day))); 
          $day_name = date('l', strtotime($work_day));
                 if($day_name != 'Saturday' && $day_name != 'Sunday' && !isset($holiday[$work_day]))
                  {
                      $min_launch_date = $work_day;
                      $i++;
                  }
           }
    ?>
    <!-- <div class="form-group col-md-3">
        <label for="inputState" class="form-label">*Online Channel</label>
        <select required="required" multiple="multiple" class="multiple-select" id="cr_online_channel[] "
            name="cr_online_channel[]">
            <?php //echo $product_website_op; ?>
        </select>
    </div>
   -->
    <div class="form-group col-md-3">
        <label for="cr_ticket_template" class="form-label">Bucket & Project</label>
        <select id="cr_ticket_template" disabled name="cr_ticket_template" class="form-select form-select-sm">
           <?php  echo $project_bucket; ?>
        </select>
    </div>

  </div>
  <hr>
  <div class="row">
    <div class="form-group col-md-3">
      <label for="inputState" class="form-label">*Piority</label>
      <select id="cr_piority" name="cr_piority" class="form-select form-select-sm">
      <?php echo $cr_important_op;?>
      </select>
    </div>
    <div class="form-group col-md-3">
        <label for="date" class="form-label">Effective Date</label>
        <input class="form-control form-control-sm" type="datetime-local" min="<?php echo $min_launch_date; ?>"
            id="cr_effective_date" name="cr_effective_date">
        <small>เฉพาะ request ที่จำเป็นต้องตั้ง Schedule เท่านั้น หากต้องการให้มีผลทันทีไม่ต้องกรอก</small>
    </div>
    <div class="form-group col-md-6">
      <label for="formFileMultiple" class="form-label">Multiple files input</label>
      <input class="form-control form-control-sm" type="file" id="cr_attachment" name="cr_attachment[]" multiple="multiple">
      <small>ขนาดไฟล์ต้องไม่เกิน 2MB</small>
    </div>
</div>
<?php if($_SESSION['username']=="poojaroonwit"){
  ?>
<button type="button" onclick="attaction_alert_cr()" class="btn btn-primary" >
  Submit
</button>

<?php
}
?>


<script>
  function SelectedBucket(){
    var cr_ticket_type = document.getElementById("cr_ticket_type").value;
    if(cr_ticket_type=="Datapump"){
      document.getElementById('cr_ticket_template').value="DP";
      document.getElementById('cr_piority').value="Urgent";
      
    }else if(cr_ticket_type=="System development"){
      document.getElementById('cr_ticket_template').value="DT";
    }else if(cr_ticket_type=="NPS"){
      document.getElementById('cr_ticket_template').value="NPS";
    }else{
      document.getElementById('cr_ticket_template').value="CR";
    }
  }

</script>
<!-- <script>
     function submit_cr_form(id) {
       
    }
</script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function attaction_alert_cr(id){
    var cr_ticket_type = document.getElementById("cr_ticket_type").value;
    if(cr_ticket_type=="Datapump"){
      result.isConfirmed = true;
    }
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success m-2',
    cancelButton: 'btn btn-danger m-2'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Attantion',
  icon: 'info',
  html: '<strong>Your request will be processed within 1 business day</strong>'+
        '<strong>Notice :</strong>'+
        '<li>Covid items ex. Mask , Alcohol gel have to keep at WH 10138 only.</li>'+
        '<li>GWP should be keep at WH 10138 except Brand pick from store 100%</li><hr>'+
        '<strong>ระบบจะดำเนินการเสร็จสิ้นภายใน 1 วันทำการ</strong>'+
        '<strong>หมายเหตุ :</strong>'+
        '<li>สินค้า Covid เช่น หน้ากาอนามัย , แอลกอฮอล์เจล ควรจัดเก็บที่คลังออนไลน์ 10138 เท่านั้น</li>'+
        '<li>GWP ควรจัดเก็บที่คลังออนไลน์ 10138 ยกเว้น สินค้าที่ขายที่สาขา 100%</li>',
  showCancelButton: true,
  confirmButtonText: 'Understoods',
  cancelButtonText: 'Cancel',
  reverseButtons: true,
  width:'50rem'
}).then((result) => {
  if (result.isConfirmed) {
    // --
        var form_data = new FormData();
        var cr_title = document.getElementById("cr_title").value;
        var cr_description = document.getElementById("cr_description").value;
        var cr_issue_type = document.getElementById("cr_issue_type").value;
        var myIFrame = document.getElementById("cr_description_ifr");
        var cr_description = myIFrame.contentWindow.document.body.innerHTML;
        var cr_sku = document.getElementById("cr_sku").value;
        var cr_ticket_template = document.getElementById("cr_ticket_template").value;
        var cr_piority = document.getElementById("cr_piority").value;
        var cr_effective_date = document.getElementById("cr_effective_date").value;
        var files = document.getElementById('cr_attachment').files.length;
        for (var x = 0; x < files; x++) {
            form_data.append("files[]", document.getElementById('cr_attachment').files[x]);
        }
        form_data.append("cr_title", cr_title) 
        form_data.append("cr_description", cr_description) 
        form_data.append("cr_issue_type", cr_issue_type) 
        form_data.append("cr_sku", cr_sku) 
        form_data.append("cr_ticket_template", cr_ticket_template) 
        form_data.append("cr_piority", cr_piority) 
        form_data.append("cr_effective_date", cr_effective_date) 
        form_data.append("id", id)
        $.ajax({
            url: "base/action/action_submit_add_content_request.php",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post',
            success: function(data) {
                // $('#call_ticket_comment_ins').html(data);
                swalWithBootstrapButtons.fire(
                  'Complete!',
                  'Your request has been submited.',
                  'success'
                )
          
            }
        });
    // --
   
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    // swalWithBootstrapButtons.fire(
    //   'Cancelled',
    //   'Your imaginary file is safe :)',
    //   'error'
    // )
  }
})
  }
</script>