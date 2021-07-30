<?php 
session_start();
        function get_option_return($attribute_code,$default_option,$select_type,$function){
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639","content_service_gate") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT 
            attribute_option.option_id as option_id,
            attribute_option.attribute_id as attribute_id,
            attribute_option.attribute_option as attribute_option,
            attribute_option.function as function,
            attribute_entity.attribute_code 
            FROM content_service_gate.attribute_option as attribute_option
            left join content_service_gate.attribute_entity as attribute_entity
            on attribute_option.attribute_id = attribute_entity.attribute_id 
            where attribute_code =  '".$attribute_id."' and function='".$function."' 
            ORDER BY id asc" or die("Error:" . mysqli_error());
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                if($select_type=="multi"){
                    $array_default = explode(', ', $default_option);
                    $option_set .= '<option value=""></option>';
                    foreach($array_default as $option)
                      {
                        if($option==$row["attribute_option"]){
                            $option_set .= '<option selected value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }else{
                            $option_set .= '<option value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }
                        
                      }

                }
            }
            return $option_set;
            mysqli_close($con);
        }
        function getoption_return_edit_job($col,$table,$select_option,$sorm,$database) {
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error());
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
          // split array store
                  if($sorm=="multi"){
                    if($col=="store" or $col=="product_website" or $col=="tags"){
                      $array_store = explode(', ', $select_option);
                      $duplicate_op = false;
                      $loop_in_null = false;
                      foreach($array_store as $store)
                      {if($row[$col] <> '' ) {
                          if($store==$row[$col]){
                              if(
                                $row[$col]<>"NJ" and
                                $row[$col]<>"BN" and
                                $row[$col]<>"CL" and
                                $row[$col]<>"CO" and
                                $row[$col]<>"CO_KIS" and
                                $row[$col]<>"RBS_OL" and
                                $row[$col]<>"RBS_VENDER" and
                                $row[$col]<>"RBS_RAMA9" and
                                $row[$col]<>"RH" and
                                $row[$col]<>"SY" and
                                $row[$col]<>"SC" and
                                $row[$col]<>"EV" and
                                $row[$col]<>"R2" and
                                $row[$col]<>"WG" and
                                $row[$col]<>"CM3" and
                                $row[$col]<>"PT" and
                                $row[$col]<>"PY" and
                                $row[$col]<>"HY2" and
                                $row[$col]<>"PK" and
                                $row[$col]<>"MG" and
                                $row[$col]<>"RS" and
                                $row[$col]<>"RI" and
                                $row[$col]<>"KR" and
                                $row[$col]<>"UD" and
                                $row[$col]<>"SM" and
                                $row[$col]<>"CJ" and
                                $row[$col]<>"LP" and
                                $row[$col]<>"RBS_RB" and
                                $row[$col]<>"RBS_KK" and
                                $row[$col]<>"RBS_PN" and
                                $row[$col]<>"RBS_BK" and
                                $row[$col]<>"RBS_SR" and
                                $row[$col]<>"NJMJ" and
                                $row[$col]<>"ZWMJ" and
                                $row[$col]<>"10153_Patong" and
                                $row[$col]<>"PA" 
                              ){
                                $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                                $duplicate_op = true;
                              }
                          }
                        }
                      }
                      if($row[$col] <> ''){
                        if($duplicate_op == false){
                            if(
                                $row[$col]<>"NJ" and
                                $row[$col]<>"BN" and
                                $row[$col]<>"CL" and
                                $row[$col]<>"CO" and
                                $row[$col]<>"CO_KIS" and
                                $row[$col]<>"RBS_OL" and
                                $row[$col]<>"RBS_VENDER" and
                                $row[$col]<>"RBS_RAMA9" and
                                $row[$col]<>"RH" and
                                $row[$col]<>"SY" and
                                $row[$col]<>"SC" and
                                $row[$col]<>"EV" and
                                $row[$col]<>"R2" and
                                $row[$col]<>"WG" and
                                $row[$col]<>"CM3" and
                                $row[$col]<>"PT" and
                                $row[$col]<>"PY" and
                                $row[$col]<>"HY2" and
                                $row[$col]<>"PK" and
                                $row[$col]<>"MG" and
                                $row[$col]<>"RS" and
                                $row[$col]<>"RI" and
                                $row[$col]<>"KR" and
                                $row[$col]<>"UD" and
                                $row[$col]<>"SM" and
                                $row[$col]<>"CJ" and
                                $row[$col]<>"LP" and
                                $row[$col]<>"RBS_RB" and
                                $row[$col]<>"RBS_KK" and
                                $row[$col]<>"RBS_PN" and
                                $row[$col]<>"RBS_BK" and
                                $row[$col]<>"RBS_SR" and
                                $row[$col]<>"NJMJ" and
                                $row[$col]<>"ZWMJ" and
                                $row[$col]<>"10153_Patong" and
                                $row[$col]<>"PA" 
                              ){
                          $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                              }
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
                            $value_allow_internal = array("Itemmize - Credit", "Closslising", "Itemmize - Consignment");
                            if(in_array($row[$col],$value_allow_internal)){
                                if(strpos($_SESSION["department"],"Content")!==false){
                                  $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                                }
                              }else{
                                $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                              }
                          }
                      }
              }
            }
               return $option_set;
               mysqli_close($con);
              }
       //get buyer department
        if($department=="Buyer Beauty"){
            $department_user = "BEAUTY";
        }elseif($department=="Buyer Fashion"){
            $department_user = "FASHION";
        }
        elseif($department=="Buyer  Home"){
            $department_user = "HOME";
        }
        elseif($department=="Buyer Mom and Kids"){
            $department_user = "MOM&KIDS";
        }
        elseif($department=="Content Admin"){
            $department_user = "HOME";
        }
        echo '<script>console.log("department '.$department_user.'");</script>';
    //    $sub_department_op = getoption_return_edit_job("sub_department","option",$sub_department_user,"single","all_in_one_project");
       $department_op = getoption_return_edit_job("department","job_option_cms",$department_user,"single","u749625779_cdscontent");
       $production_type_op = getoption_return_edit_job("production_type","job_option_cms","","single","u749625779_cdscontent");
       $business_type_op = getoption_return_edit_job("itemmize_type","job_option_cms","","single","u749625779_cdscontent");
       $project_type_op = getoption_return_edit_job("project_type","option","New SKU","single","all_in_one_project");
       $store_op = getoption_return_edit_job("store","job_option_cms","","multi","u749625779_cdscontent");
       $bu_op = getoption_return_edit_job("bu","job_option_cms","","single","u749625779_cdscontent");
       $product_website_op = getoption_return_edit_job("product_website","job_option_cms","CDS, RBS","multi","u749625779_cdscontent");
       $request_important_op = getoption_return_edit_job("request_important","option","Normal","single","all_in_one_project");
       $tags_op = getoption_return_edit_job("tags","option","","multi","all_in_one_project"); 

       
?>
<style>
.ms-choice {
    background: white;
}
</style>
<div class="row">
    <div class="col-md-3">
        <label for="Brand" class="form-label">*Brand</label>
        <input type="text" class="form-control form-control-sm" id="brand" placeholder="ชื่อแบรนด์" required
            name="brand">
        <small id="brandhelp" class="form-text text-muted">ชื่อแบรนด์ต้องตรงกับที่จะขายหน้าเว็บ</small>
    </div>
    <div class="col-md-3">
        <label for="department" class="form-label">*Department</label>
        <select required class="form-select form-select-sm" aria-label="Default select example" id="department"
            name="department">
            <?php 
            if($_SESSION["username"] == 'poojaroonwit'){
                $department_op_2 = get_option_return("department","","single","add_new");
                echo $department_op;
            }else{
                echo $department_op;
            }
            
            
            
            ?>
        </select>
    </div>
    <!-- <div class="col-md-3">
        <label for="department" class="form-label">*Sub Department</label>
        <select required class="form-select form-select-sm" aria-label="Default select example" id="sub_department"
            name="sub_department">
            <?php echo //$sub_department_op; ?>
        </select>
    </div> -->
    <div class="col-md-3">
        <label for="inputAddress" class="form-label">*SKU</label>
        <input required type="number" class="form-control form-control-sm" id="sku" placeholder="จำนวน SKU ทั้งหมด"
            name="sku" required min="1" max="99999">
    </div>
    <div class="col-md-3">
        <label for="photo" class="form-label">*Production type</label>
        <select class="form-select form-select-sm" required aria-label="Default select example" id="production_type"
            name="production_type">
            <?php echo $production_type_op; ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label for="credit_type" class="form-label">*Business type</label>
        <select required class="form-select form-select-sm" aria-label="Default select example" id="business_type"
            name="business_type">
            <?php echo $business_type_op; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="model" class="form-label">*Project Type</label>
        <select class="form-select form-select-sm" required aria-label="Default select example" id="project_type"
            name="project_type">
            <?php echo $project_type_op; ?>
        </select>
    </div>
    <?php
                                        //Calculate min date
                                            //---set holiday
                                            $holiday = array(
                                                // '2017-12-16\T00:00' => 'Victory Day of Bangladesh',
                                                // '2017-12-25\T00:00' => 'Christmas'
                                            );
                                            $i = 0;
                                            $work_day = date("Y-m-d\Th:i"); //---get current day
                                            while($i != 1) //---loop 7 day for set min date
                                            {
                                                //$work_day = date('Y-m-d\Th:i', strtotime('+1 day', strtotime($work_day))); 
                                                $work_day = date('Y-m-d', strtotime('+1 day', strtotime($work_day)));
                                                $day_name = date('l', strtotime($work_day));
                                                if($day_name != 'Saturday' && $day_name != 'Sunday' && !isset($holiday[$work_day]))
                                                {
                                                        $min_launch_date = $work_day;
                                                        $i++;
                                                    }
                                                }
                                        ?>
    <div class="col-md-3">
        <label for="priority" class="form-label">Priority</label>
        <select class="form-select form-select-sm" required aria-label="Default select example" id="request_important"
            name="request_important">
            <?php echo $request_important_op; ?>
        </select>
        <small id="emailHelp" class="form-text text-muted" style="color:red!important">หากว่าด่วน รบกวนระบุวัน luanch date ได้เลยครับ
</small>
    </div>
    <div class="col-md-3">
        <label for="date" class="form-label">Launch Date</label>
        <input class="form-control form-control-sm" type="date" min="<?php echo $min_launch_date; ?>" id="launch_date"
            name="launch_date">
        <small id="emailHelp" class="form-text text-muted">ระบุเฉพาะที่ต้องมีการตั้ง Schedule สำหรับปรับขึ้นขายเท่านั้น หากต้องการให้ทันที ภายใน 12 วันทำการไม่ต้องกรอกในช่องนี้
</small>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label class="form-label">tags (new brand , Campaign)</label>
        <select multiple="multiple" class="multiple-select" id="tags[]" name="tags[]">
            <?php echo $tags_op; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="stock_source" class="form-label">*Store</label>
        <select  multiple="multiple" class="multiple-select" required id="stock_source[]" name="stock_source[]">
            <?php echo $store_op; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="bu" class="form-label">*Business Unit</label>
        <select class="form-select form-select-sm" required aria-label="Default select example" id="bu" name="bu">
            <?php echo $bu_op; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="online_channel" class="form-label">*Online Channel</label>
        <select required multiple="multiple" class="multiple-select" id="online_channel[]" name="online_channel[]">
            <?php echo $product_website_op; ?>
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <label for="text" class="form-label">*Contact Buyer</label>
        <textarea class="form-control form-control-sm" required id="contact_buyer" name="contact_buyer"
            rows="4"><?php echo $get_contact_buyer; ?></textarea>
        <small id="emailhelp" class="form-text text-muted">ช่องทางการติดต่อจัดซื้อ</small>
    </div>
    <div class="col-md-6">
        <label for="text" class="form-label">*Contact Vender</label>
        <textarea required class="form-control form-control-sm" id="contact_vender" name="contact_vender"
            rows="4"></textarea>
        <small id="emailhelp" class="form-text text-muted">ช่องทางการติดต่อแบรนด์</small>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label for="link" class="form-label">*Link for information</label>
        <input type="url" class="form-control form-control-sm" required id="link_info" name="link_info" placeholder="">
        <small id="linkhelp" class="form-text text-muted">รบกวนเปิด Public หรือ สิทธิ์ในการเข้าถึง
            cdse-commercecontent@central.co.th</small>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="remark" class="form-label">Remark</label>
        <textarea class="form-control form-control-sm" value="<?php echo $remark;?>" id="remark" name="remark"
            rows="2"></textarea>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>