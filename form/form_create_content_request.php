<?php 
  session_start();
        function getoption_cr($col,$table,$select_option,$sorm,$database) {
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error());
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
               return $option_set;
               mysqli_close($con);
              }
       //$department_op = getoption_cr("department","job_option_cms",$department,"single","u749625779_cdscontent");
       $product_website_op = getoption_cr("product_website","job_option_cms","CDS","multi","u749625779_cdscontent");
       $cr_important_op = getoption_cr("cr_important","option","Low","single","all_in_one_project");
       $cr_issue_type_op = getoption_cr("issue_type","option","","single","all_in_one_project");
       $cr_product_category_op = getoption_cr("product_category","option","","single","all_in_one_project");
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
      <label for="cr_ticket_type" class="form-label">*ticket type</label>
      <select id="cr_ticket_type" name="cr_ticket_type" class="form-select form-select-sm">
      <?php echo $cr_issue_type_op;?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="cr_sku" class="form-label">SKU</label>
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
    <div class="form-group col-md-3">
        <label for="inputState" class="form-label">*Online Channel</label>
        <select required="required" multiple="multiple" class="multiple-select" id="cr_online_channel[] "
            name="cr_online_channel[]">
            <?php echo $product_website_op; ?>
        </select>
    </div>
  
    <div class="form-group col-md-3">
        <label for="cr_ticket_template" class="form-label">ticket template</label>
        <select id="cr_ticket_template" name="cr_ticket_template" class="form-select form-select-sm">
           <option value="CR" selected>Content Request</option>
           <option value="PJ">Project</option>
           <option value="DT">Data and Task Support (CSG)</option>
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
        <label for="date" class="form-label">effective date</label>
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
