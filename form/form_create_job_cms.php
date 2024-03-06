

<?php

 session_start();

function mapping_house_department($sub_department){

    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    mysqli_query($con, "SET NAMES 'utf8' ");

    $query = "SELECT * FROM all_in_one_project.mapping_dept_subdept where sub_department = '".$sub_department."' ORDER BY id asc" or die("Error:" . mysqli_error($con));

    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {

       $house =  $row["house"];

    }

    return $house;

}

function getoption_return_create_job($col,$table,$select_option,$sorm,$database) {

    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4",$database,"10628") or die("Error: " . mysqli_error($con));

    mysqli_query($con, "SET NAMES 'utf8' ");

    $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));

    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {

  // split array store

          if($sorm=="multi"){

            if($col=="store" or $col=="itemmize_type" or $col=="product_website" ){

              $array_store = explode(', ', $select_option);

              $duplicate_op = false;

              $loop_in_null = false;

              foreach($array_store as $store)

              {

                if($row[$col] <> '' ) {

                  if($store==$row[$col]){

                    $option_set .= '<option selected value="'.$row[$col].'">'.$row[$col].'</option>';

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

          }else{all_in_one_project
all_in_one_project
            if($loop_in_null==false){all_in_one_project
all_in_one_project
              $option_set .= '<option value=""></option>';all_in_one_project
all_in_one_project
              $loop_in_null=true;all_in_one_project
all_in_one_project
            }all_in_one_project
all_in_one_project
              if($row[$col] <> '' )all_in_one_project
all_in_one_project
              {all_in_one_project
all_in_one_project
                  $value_allow_internal = array("Itemmize - Credit", "Closslising", "Itemmize - Consignment");

                  if($select_option==$row[$col]){

                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';

                  }else{

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

       mysqli_close($con);

       return $option_set;



      }



      if(strpos($tags,"Free Gift")!==false){

        $df_type = "Free Gift";

      }else{

        $df_type = "Normal";

      }

      $s_fashion = array("MARKS AND SPENCER", "WOMEN", "MEN", "MUJI");

      $s_product = array("BEAUTY", "HOME & KITCHEN", "MOBILES TABLETS & GADGETS", "SMALL APPLIANCE","SANRIO","TRAVEL & LUGGAGE","JEWELRY  WATCHES & ACCESSORIES","MOM KIDS & TOYS","AUTOMOTIVE & TOOLS","SPORTS & OUTDOORS","STATIONERY & OFFICE","COUPON");

      if(in_array($sub_department,$s_fashion)!==false){

        $df_psort = "Fashion";

      }else{

        $df_psort = "Product";

      }

       $bu_op = getoption_return_create_job("bu","job_option_cms",$bu,"single","all_in_one_project");

       $transfer_type_op = getoption_return_create_job("transfer_type","job_option_cms","Data and Photo","single","all_in_one_project");

       $sub_department_op = getoption_return_create_job("sub_department","job_option_cms",$sub_department,"single","all_in_one_project");

       $product_sell_type_op = getoption_return_create_job("product_sell_type","job_option_cms",$df_type,"single","all_in_one_project");

       $product_sorting_op = getoption_return_create_job("product_sorting","job_option_cms",$df_psort,"single","all_in_one_project");

       $job_status_filter_op = getoption_return_create_job("job_status_filter","job_option_cms","Wait image","single","all_in_one_project");

       $product_website_op = getoption_return_create_job("product_website","job_option_cms","","multi","all_in_one_project");

       $department_op = getoption_return_create_job("department","job_option_cms",mapping_house_department($sub_department),"single","all_in_one_project");

       $production_type_op = getoption_return_create_job("production_type","job_option_cms",$production_type,"single","all_in_one_project");

       $business_type_op = getoption_return_create_job("itemmize_type","job_option_cms",$business_type,"multi","all_in_one_project");

       $project_type_op = getoption_return_create_job("itemmize_type","job_option_cms",$project_type,"multi","all_in_one_project");

       $store_op = getoption_return_create_job("store","job_option_cms",$stock_source,"multi","all_in_one_project");

       $product_website_op = getoption_return_create_job("product_website","job_option_cms",$online_channel,"multi","all_in_one_project");

       $content_nickname_op = getoption_return_create_job("nickname","user_cms",$follow_assign_nickname,"single","all_in_one_project");

  ?>

<!-- Extra large modal -->

<style>

.multiple-select_adj {

    width: 185px;

}



.multiple-select_adj .ms-choice {

    background: #f1f1f1;

}

</style>

<div class="row">

    <div class="col">

        <label for="exampleInputEmail1">Job number

            <small style="color: #cecece;">

                <ion-icon name="flash-outline" style="color: #ecc400;"></ion-icon>

            </small>

        </label>

        <!-- <input type="text" class="form-control col-form-label-sm" value="<?php //include($_SERVER['DOCUMENT_ROOT'].'get_max_job_number.php');get_max_job(); ?>"  maxlength=12 required placeholder="12 Char only" id="job_number" name="job_number"> -->

        <input type="text" class="form-control form-control-sm" value="AUTO GENERATE" maxlength=12 disabled

            placeholder="12 Char only" id="job_number" name="job_number">

    </div>

    <div class="col">

        <label for="exampleInputEmail1">store</label>

        <select style="background: #f1f1f1" multiple="multiple" class="multiple-select_adj" required id="store_adj"

            name="store_adj[]">

            <?php echo  $store_op; ?>

        </select>

    </div>

    <div class="col">

        <label for="exampleInputEmail1">BU</label>

        <select style="background: #f1f1f1" id="bu_adj" name="bu_adj" required class="form-select form-select-sm">

            <?php echo $bu_op; ?>

        </select>

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Transfer type</label>

        <select style="background: #ffe9b2" id="transfer_type_adj" name="transfer_type_adj" required

            class="form-select form-select-sm">

            <?php echo $transfer_type_op; ?>

        </select>

    </div>

</div>

<div class="row">

    <div class="col">

        <label for="exampleInputEmail1">Production Type</label>

        <select style="background: #f1f1f1" id="production_type_adj" name="production_type_adj" required

            class="form-select form-select-sm">

            <?php echo $production_type_op; ?>

        </select>

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Department</label>

        <select style="background: #f1f1f1" id="department_adj" name="department_adj" required

            class="form-select form-select-sm">

            <?php echo $department_op; ?>

        </select>

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Sub department</label>

        <select style="background: #f1f1f1" id="sub_department_adj" name="sub_department_adj" required

            class="form-select form-select-sm">

            <?php echo $sub_department_op; ?>

        </select>

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Product Type</label>

        <input type="text" class="form-control form-control-sm" required placeholder="" id="product_type_adj"

            name="product_type_adj">

    </div>

</div>

<div class="row">

    <div class="col">

        <label for="exampleInputEmail1">Launch date</label>

        <input style="background: #f1f1f1" type="date" class="form-control form-control-sm placeholder="

            value="<?php echo str_replace(" ","T",$launch_date); ?>" id="actual_launch_date_adj" name="actual_launch_date_adj">

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Wrong ls from buyer</label>

        <input type="text" class="form-control form-control-sm" placeholder="" id="wrong_data_linesheet_adj"

            name="wrong_data_linesheet_adj">

    </div>

    <div class="col">

        <label for="exampleInputEmail1">SKU</label>

        <input style="background: #f1f1f1" type="number" class="form-control form-control-sm"

            value="<?php echo $sku; ?>" required id="sku_adj" name="sku_adj">

    </div>

    <div class="col">

        <label for="exampleInputEmail1">Product sell Type</label>

        <select style="background: #ffe9b2" class="form-select form-select-sm" id="product_sell_type_adj" required

            name="product_sell_type_adj">

            <?php echo $product_sell_type_op; ?>

        </select>

    </div>

</div>

<div class="row">

    <div class="col-3">

        <label for="exampleInputEmail1">Product sorting</label>

        <select style="background: #ffe9b2" class="form-select form-select-sm" id="product_sorting_adj" required

            name="product_sorting_adj">

            <?php echo $product_sorting_op; ?>

        </select>

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Job status filter</label>

        <select style="background: #ffe9b2" class="form-select form-select-sm" id="job_status_filter_adj" required

            name="job_status_filter_adj">

            <?php echo $job_status_filter_op; ?>

        </select>

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Brand</label>

        <input style="background: #f1f1f1" type="text" class="form-control form-control-sm" required

            value="<?php echo $brand; ?>" placeholder="" id="brand_adj" name="brand_adj">

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Product Website</label>

        <select style="background: #f1f1f1" multiple="multiple" class="multiple-select_adj" id="product_website_adj"

            name="product_website_adj[]">

            <?php echo $product_website_op; ?>

        </select>

    </div>

</div>

<div class="row">

    <div class="col-3">

        <label for="exampleInputEmail1">Duplicate sku in MDC</label>

        <input type="number" class="form-control form-control-sm" placeholder="" id="dulplicate_sku_in_mdc_adj"

            name="dulplicate_sku_in_mdc_adj">

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Wrong data sku</label>

        <input type="number" class="form-control form-control-sm" placeholder="" id="wrong_data_sku_adj"

            name="wrong_data_sku_adj">

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Receive Ticket date</label>

        <input style="background: #f1f1f1" type="datetime-local" class="form-control form-control-sm"

            value="<?php echo str_replace(" ","T",$request_date); ?>" required placeholder="yyyy-MM-dd"

            id="recive_mail_date_adj" name="recive_mail_date_adj">

    </div>

    <div class="col-3">

        <label for="exampleInputEmail1">Project type</label>

        <select style="background: #f1f1f1" multiple="multiple" class="multiple-select_adj" required

            id="itemmize_type_adj" name="itemmize_type_adj[]">

            <?php echo $business_type_op; ?>

        </select>

    </div>

</div>

<div class="row">

  <div class="col-3">

        <label for="exampleInputEmail1">Content Writer assign name</label>

        <select style="background: #ffe9b2" class="form-select form-select-sm" id="content_assign_name_adj"

            name="content_assign_name_adj">

            <?php echo $content_nickname_op; ?>

        </select>

  </div>

  <div class="col-3">

        <label for="exampleInputEmail1">Content Writer assign date</label>

        <input style="background: #ffe9b2" type="datetime-local" class="form-control form-control-sm"

            value="<?php echo date("Y-m-d H:i:s"); ?>"  placeholder="yyyy-MM-dd"

            id="content_assign_date_adj" name="content_assign_date_adj">

  </div>

</div>

<div class="row" style="padding-top: 10px;">

    <div class="col">

        <label for="inputState">Traffic Remark</label>

        <textarea style="background: #f1f1f1" class="form-control form-control-sm" id="remark_adj" name="remark_adj"

            rows="3"><?php echo $remark; ?></textarea>

    </div>

</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">

    <input type="submit" class="btn btn-success" style="margin-top:20px" id="create_job_manage" name="create_job_manage"

        Value="Create">

</div>

<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

<script>

$(function() {

    $(".multiple-select_adj").multipleSelect()

});

</script>

