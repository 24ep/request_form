<?php
function pid(){
  global $bu_ticket;
  global $ws_linesheet;
  global $IMFORM_column_number_ibc;
  global $row_get_ls;
  $ibc = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_ibc,  $row_get_ls)->getValue();
  return $bu_ticket.$ibc;
}
function brand_name(){
  global $con;
  global $job_number;
  //new getting
  $query = "SELECT
  case
  when bc.brand_pim_online is null then jc.brand
  else  bc.brand_pim_online
  end as brand
  FROM job_cms as jc
  left join pim_online_brand_convert as bc
  on bc.brand_linesheet = jc.brand
  where jc.job_number = '".$job_number."'"  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $brand = $row["brand"];
    break;
  }
  $brand_name_cleaned = preg_replace("/[^a-z\d]/i", '_', $brand);
  return $brand_name_cleaned;
}
function shipping_methods(){
  global $con;
  global $ws_linesheet;
  global $IMFORM_column_number_brand;
  global $IMFORM_column_number_one_hr_pickup;
  global $IMFORM_column_number_product_sell_type;
  global $IMFORM_column_number_sub_dept;
  global $id;
  global $IMFORM_column_number_package_dimension;
  global $row_get_ls;
  $brand = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_brand,  $row_get_ls)->getValue();
  //get brand from ticket
  $query_job_cms = "SELECT jc.id,jc.brand,jc.department,jc.sub_department ,dm.`number` as number_dm ,
  sdm.`number` as number_sdm , sm.one_hr ,sm.tree_hr  FROM u749625779_cdscontent.job_cms as jc
  left join content_service_gate.dept_subdept_number_mapping dm
  on dm.name = jc.department
  left join content_service_gate.dept_subdept_number_mapping sdm
  on sdm.name = jc.sub_department
  left join u749625779_cdscontent.shipping_mapping sm
  on sdm.`number` = sm.sub_department and lower(jc.brand) = lower(sm.brand_group)
  where id = ".$id or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query_job_cms);
  while($row = mysqli_fetch_array($result)) {
    $brand_name = $row["brand"];
    $one_hr_ct = $row["one_hr"];
    $tree_hr_ct = $row["tree_hr"];
  }
  $package_dimension = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_package_dimension,  $row_get_ls)->getValue();
  $sub_dept = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_sub_dept,  $row_get_ls)->getValue();
  $product_sell_type = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_sell_type,  $row_get_ls)->getValue();
  $one_hr_pickup = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_one_hr_pickup,  $row_get_ls)->getValue();
  if($one_hr_pickup=="Yes" and $one_hr_ct <> "No"){
    $one_hr_flag = TRUE;
  }else{
    if($one_hr_ct == "Yes"){
      $one_hr_flag = TRUE;
    }
    // - check brand in list
    // $query_brand = "SELECT * FROM brand_attribute where brand_name = '".$brand_name ."'" or die("Error:" . mysqli_error($con));
    // $result = mysqli_query($con, $query_brand);
    // while($row_condition= mysqli_fetch_array($result)) {
      //     if($row_condition["brand_type"]=="FLAG"){
        //       $one_hr_flag = TRUE;
        //       break;
        //     }
        // }
      }
      // normall condition
      if($product_sell_type == "Pre-order"){
        return "Standard_Delivery";
      }elseif($sub_dept == "707" and  $package_dimension <> "40 x 45 x 35 cm." and $package_dimension <> "Special Size"){
        return  "MultiShipping,1_Hour_Pickup,ship_from_store";
      }elseif(($one_hr_flag == TRUE and $package_dimension <> "40 x 45 x 35 cm." and $package_dimension <> "Special Size") or ($tree_hr_ct =="Yes") ){
        return  "Standard_Pickup,MultiShipping,Standard_Delivery,1_Hour_Pickup,ship_from_store";
      }else{
        return  "Standard_Pickup,MultiShipping,Standard_Delivery";
      }
    }
    function allow_cc(){
      if(strpos(shipping_methods(),"Standard_Pickup")!==false ){
        return TRUE;
      }
    }
    function payment_methods(){
      global $allow_cod;
      global $allow_installment;
      global $IMFROM_column_number_original_price_in_vat;
      global $ws_linesheet;
      global $row_get_ls;
      $original_price_in_vat = $ws_linesheet->getCellByColumnAndRow($IMFROM_column_number_original_price_in_vat,  $row_get_ls)->getValue();
      if($original_price_in_vat >= 7000){
        $allow_cod = "FALSE";
      }
      $payment_value = "Bank_Transfer___Counter_Services,Credit_Card__Full_Payment_,payment_service_dolfin";
      if($allow_cod =="TRUE"){
        $payment_value = "Bank_Transfer___Counter_Services,Credit_Card__Full_Payment_,payment_service_dolfin,Pay_On_Delivery,Pay_at_Store";
      }
      if($allow_installment=="TRUE"){
        $payment_value .= ",Payment_service_installment";
      }
      return $payment_value;
    }
    function last_status_update(){
      return date("Y-m-d");
    }
    function content_note(){
      global $nickname;
      $content_note =  "Generate template from 24EP (New IM-FORM) by ".$nickname." ".date("Y/m/d H:m:s");
      return $content_note;
    }
    function size(){
      global $ws_linesheet;
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_size;
      global $IMFORM_column_number_size_standard;
      global $row_get_ls;
      $categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories  ,  $row_get_ls)->getValue();
      $size_standard = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size_standard  ,  $row_get_ls)->getValue();
      $size = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size,  $row_get_ls)->getValue();
      if($categories=="Shoes"){
        $size = $size." ".$size_standard;
      }
      $target_cell_cleaned = preg_replace("/[^a-z\d]/i", '_', $size);
      $target_cell_cleaned = str_replace("/","_",$target_cell_cleaned);
      $target_cell_cleaned = str_replace(".","_",$target_cell_cleaned);
      $target_cell_cleaned = str_replace("-","_",$target_cell_cleaned);
      $target_cell_cleaned = str_replace("+","_",$target_cell_cleaned);
      $target_cell_cleaned = str_replace(" ","_",$target_cell_cleaned);
      return $target_cell_cleaned;
    }
    function shade(){
      //todo next
      //check categories is beauty , makeup
      global $bu;
      global $ws_linesheet;
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_special_shade_en;
      global $IMFORM_column_number_special_shade_th;
      global $IMFORM_column_number_hex_cod;
      global $IMFORM_column_number_color;
      global $row_get_ls;
      global $export_shade_wb;
      global $shade_generate_code;
      global $shade_generate_en;
      global $shade_generate_th;
      global $shade_generate_hex_cod;
      $pid = pid();
      $special_shade_en = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_en  ,  $row_get_ls)->getValue();
      $special_shade_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_th  ,  $row_get_ls)->getValue();
      $special_shade_hex_cod = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_hex_cod,$row_get_ls)->getValue();
      $shade_normal = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_color  ,  $row_get_ls)->getValue();
      $categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories  ,  $row_get_ls)->getValue();
      if((strpos($categories,"Makeup")!==false or strpos($categories,"Beauty")!==false)
      and $special_shade_en <>""
      and $special_shade_th <>""
      and $special_shade_en <>null
      and $special_shade_th <>null ){
        //create new shade
        // - return shade to tempate
        $shade_code = preg_replace("/[^a-z\d]/i", '_', $pid."-".$special_shade_en);
        $shade_generate_code[]= $shade_code;
        $shade_generate_en[]= $special_shade_en;
        $shade_generate_th[]= $special_shade_th;
        $shade_generate_hex_cod[]= $special_shade_hex_cod;
        return strtolower($shade_code);
      }else{
        //flase > use standard shade sku+shade
        // - return offline shade
        //convert unit
        $shade_normal = look_up_label( $shade_normal,"option_code","shade");
        $shade_normal = preg_replace("/[^a-z\d]/i", '_', $shade_normal);
        return $shade_normal;
      }
    }
    function shade_display($lg){
      //todo next
      //check categories is beauty , makeup
      global $bu;
      global $ws_linesheet;
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_special_shade_en;
      global $IMFORM_column_number_special_shade_th;
      global $IMFORM_column_number_hex_cod;
      global $IMFORM_column_number_color;
      global $row_get_ls;
      global $export_shade_wb;
      global $shade_generate_code;
      $special_shade_en = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_en  ,  $row_get_ls)->getValue();
      $special_shade_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_th  ,  $row_get_ls)->getValue();
      $shade_normal = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_color  ,  $row_get_ls)->getValue();
      $categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories  ,  $row_get_ls)->getValue();
      if( $special_shade_en <>""
      and $special_shade_th <>""
      and $special_shade_en <>null
      and $special_shade_th <>null ){
        if($lg=="en"){
          return $special_shade_en;
        }else{
          return $special_shade_th;
        }
      }else{
        if($lg=="en"){
          $shade_normal = look_up_label($shade_normal,"option_en","shade");
        }else{
          $shade_normal = look_up_label($shade_normal,"option_th","shade");
        }
        return $shade_normal;
      }
    }
    function min_qty(){
      # refer Youtrack TS-137
      //todo next
      // flag one hour or IHB brand > true
      global $con;
      global $ws_linesheet;
      global $IMFORM_column_number_brand;
      global $IMFORM_column_number_one_hr_pickup;
      global $IMFORM_column_number_product_sell_type;
      global $row_get_ls;
      $one_hr_pickup = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_one_hr_pickup,  $row_get_ls)->getValue();
      // - check brand in list
      if($one_hr_pickup=="Yes"){
        return 1;
      }else{
        $query_brand = "SELECT * FROM brand_attribute where brand_name = '".$IMFORM_column_number_brand."'" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query_brand);
        while($row_condition= mysqli_fetch_array($result)) {
          if($row_condition["brand_type"]=="FLAG"){
            $one_hr_flag = true;
            break;
          }
        }
        if($one_hr_flag == true){
          return 1;
        }else{
          return null;
        }
      }
    }
    function use_config_min_qty(){
      # refer Youtrack TS-137
      $min_qty = min_qty();
      if($min_qty ==1){
        return TRUE;
      }else{
        return null;
      }
    }
    function convert_gender(){
      global $ws_linesheet;
      global $IMFORM_column_number_gender_value;
      global $IMFORM_column_number_age;
      global $row_get_ls;
      $gender = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_gender_value,  $row_get_ls)->getValue();
      $age = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_age,  $row_get_ls)->getValue();
      //-- replace with gender
      if($gender=="N"){
        $gender = "";
      }elseif($gender=="M"){
        $gender = "ผู้ชาย";
      }elseif($gender=="F"){
        $gender = "ผู้หญิง";
      }elseif($gender=="U"){
        $gender = "ยูนิเซ็กส์";
      }else{
        $gender = "";
      }
      //replacr with age
      if($gender=="ผู้ชาย" and ($age == "เด็กเล็ก" or  $age == "เด็กโต" or $age == "ทารก")){
        $gender = "เด็กผู้ชาย";
      }elseif($gender=="ผู้หญิง" and ($age == "เด็กเล็ก" or  $age == "เด็กโต" or $age == "ทารก")){
        $gender = "เด็กผู้หญิง";
      }
      return $gender;
    }
    function categories(){
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_online_sub_categories;
      global $IMFORM_column_number_boutique_categories;
      global $IMFORM_column_number_boutique_sub_Categories;
      global $IMFORM_column_number_gift_sub_categories;
      global $IMFORM_column_number_age;
      global $IMFORM_column_number_occasion;
      global $ws_linesheet;
      global $con;
      global $row_get_ls;
      $online_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories,  $row_get_ls)->getValue();
      $online_sub_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_sub_categories,  $row_get_ls)->getValue();
      $boutique_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_boutique_categories,  $row_get_ls)->getValue();
      $boutique_sub_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_boutique_sub_Categories,  $row_get_ls)->getValue();
      $gift_sub_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_gift_sub_categories,  $row_get_ls)->getValue();
      //$gender = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_gender,  $row_get_ls)->getValue();
      $age = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_age,  $row_get_ls)->getValue();
      $occasion = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_occasion,  $row_get_ls)->getValue();
      //mapping gender function
      //-- replace with gender
      $gender = convert_gender();
      //end mapping gender
      $n_cate_id_cds = ",";
      $b_cate_id_cds = ",";
      $g_cate_id_cds = ",";
      // -- query normal cetegories
      if($online_categories<>""){
        $query_set_department =  "department = '".$online_categories."'";
        $query_set_sub_department =  "sub_department = '".$online_sub_categories."'";
        // query gender
        if( $gender <>""){
          $query_set_gender =  "(gender like '".$gender."' or gender is null)";
        }else{
          $query_set_gender =  "gender is null";
        }
        // query age
        if( $age<>""){
          $query_set_age =  "(age like '".$age."' or age is null)";
        }else{
          $query_set_age =  "age is null";
        }
        // query occasion
        if( $occasion<>""){
          $query_set_occasion =  "(occasion like '".$occasion."' or occasion is null)";
        }else{
          $query_set_occasion =  "occasion is null";
        }
      }
      $query = "SELECT * FROM pim_cate_convert_condition
      where review_status = 'Approved' and
      ".$query_set_department." and
      ".$query_set_sub_department." and
      ".$query_set_gender." and
      ".$query_set_age." and
      ".$query_set_occasion
      or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($row= mysqli_fetch_array($result)) {
        $n_cate_id_cds .= ",".$row["category_path_id_cds"];
      }
      // -- query boutique categories
      if($boutique_categories<>""){
        $query_set_boutique_department =  "boutique_department = '".$boutique_categories."'";
        $query_set_boutique_sub_department =  "boutique_sub_department = '".$boutique_sub_categories."'";
        $query = "SELECT * FROM pim_cate_convert_condition
        where review_status = 'Approved' and ".$query_set_boutique_department." and ".$query_set_boutique_sub_department
        or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        while($row= mysqli_fetch_array($result)) {
          $b_cate_id_cds .= ",".$row["category_path_id_cds"];
        }
      }
      // -- gift sub department
      if($gift_sub_categories<>""){
        $query_set_gift_sub_department =  "gift_sub_department = '".$gift_sub_categories."'";
        $query = "SELECT * FROM pim_cate_convert_condition
        where review_status = 'Approved' and ".$query_set_gift_sub_department
        or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        while($row= mysqli_fetch_array($result)) {
          $g_cate_id_cds .= ",".$row["category_path_id_cds"];
        }
      }
      $categories = $n_cate_id_cds.$b_cate_id_cds.$g_cate_id_cds;
      $categories = trim($categories,",");
      // unique categories
      $categories_list = explode(",",$categories);
      $categories_list_unique = array_unique($categories_list);
      $categories_unique =  implode(",",$categories_list_unique);
      return $categories_unique;
    }
    function family(){
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_online_sub_categories;
      global $IMFORM_column_number_age;
      global $IMFORM_column_number_occasion;
      global $ws_linesheet;
      global $con;
      global $row_get_ls;
      $online_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories,  $row_get_ls)->getValue();
      $online_sub_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_sub_categories,  $row_get_ls)->getValue();
      $age = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_age,  $row_get_ls)->getValue();
      $occasion = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_occasion,  $row_get_ls)->getValue();
      //mapping gender function
      //-- replace with gender
      $gender = convert_gender();
      // -- query normal cetegories
      if($online_categories<>""){
        $query_set_department =  "department = '".$online_categories."'";
        $query_set_sub_department =  "sub_department = '".$online_sub_categories."'";
        // query gender
        if( $gender <>""){
          $query_set_gender =  "(gender like '".$gender."' or gender is null)";
        }else{
          $query_set_gender =  "gender is null";
        }
        // query age
        if( $age<>""){
          $query_set_age =  "(age like '".$age."' or age is null)";
        }else{
          $query_set_age =  "age is null";
        }
        // query occasion
        if( $occasion<>""){
          $query_set_occasion =  "(occasion like '".$occasion."' or occasion is null)";
        }else{
          $query_set_occasion =  "occasion is null";
        }
      }
      $query = "SELECT * FROM pim_cate_convert_condition
      where review_status = 'Approved' and ".$query_set_department." and
      ".$query_set_sub_department." and
      ".$query_set_gender." and
      ".$query_set_age." and
      ".$query_set_occasion
      or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($row= mysqli_fetch_array($result)) {
        $family = $row["attribute_set"];
      }
      return $family;
    }
    function translate_size_to_th($size){
      $size = trim($size," ");
      $size = trim($size,".");
      $array_ml = ["มล.","ml","มิลลิลิตร","มล"];
      $array_l = ["ลิตร","l",",ลิตร","ล"];
      $array_gg = ["กก.","gg","กิโลกรัม","กก"];
      $array_g = ["กรัม","g","กรัม","ก"];
      $array_cm = ["ซม.","cm","เซนติเมตร","ซม"];
      $array_m = ["เมตร.","m","เมตร","ม"];
      $array_name = [$array_ml,$array_l,$array_gg ,$array_g,$array_cm,$array_m];
      foreach ($array_name  as $array){
        foreach ($array as $value) {
          if(str_ends_with(strtolower($size), $value)){
            return str_replace($value,$array[0],$size);
          }
        }
      }
    }
    function look_up_label($excel_value,$return_col,$linesheet_code){
      global $con;
      $query_att_trans = "SELECT * FROM pim_attr_convert_option_lu where review_status = 'Approved' and linesheet_code = '".$linesheet_code."'" or die("Error:" . mysqli_error($con));
      $result_att_trans = mysqli_query($con, $query_att_trans);
      while($row_att_trans= mysqli_fetch_array($result_att_trans)) {
        if($row_att_trans["input_option"]==$excel_value ){
          $output_mapping =  $row_att_trans[$return_col];
        }
      }
      if( $output_mapping<>"" and  $output_mapping <> null){
        return  $output_mapping;
      }else{
        return $excel_value;
      }
    }
    function product_name_th(){
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_product_name_th;
      global $row_get_ls;
      global $ws_linesheet;
      global $IMFORM_column_number_special_shade_th;
      global $IMFORM_column_number_color;
      global $IMFORM_column_number_size;
      $online_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories,  $row_get_ls)->getValue();
      $product_name_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_th,  $row_get_ls)->getValue();
      $special_shade_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_th,  $row_get_ls)->getValue();
      $color = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_color,  $row_get_ls)->getValue();
      $size = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size,  $row_get_ls)->getValue();
      $unit_size = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size,  $row_get_ls)->getValue();
      // to review with collection again
      //end
      //select shade
      if($special_shade_th<>""){
        $shade = "สี".$special_shade_th ;
      }else{
        if(look_up_label($color,"option_th","shade") == ""){
          $shade = $color;
        }else{
          $shade = "สี".look_up_label($color,"option_th","shade");
        }
      }
      //translate size and unit and shade
      //$size = translate_size_to_th($size);
      //end translate size and unit and shade
      if(look_up_label($size,"option_th","size")<>""){
        $size = "Size ".look_up_label($size,"option_th","size");
      }else{
        if($size ==  ""){
          $size =  "";
        }
      }
      if($shade=="สี" or $shade=="สี" ){
        $shade ="";
      }
      $new_product_name_th = trim($product_name_th," ")." ".$shade." ".$size;
      return $new_product_name_th;
    }
    function product_name_en(){
      global $IMFORM_column_number_online_categories;
      global $IMFORM_column_number_product_name_en;
      global $row_get_ls;
      global $ws_linesheet;
      global $IMFORM_column_number_special_shade_en;
      global $IMFORM_column_number_color;
      global $IMFORM_column_number_size;
      global $IMFORM_column_number_size;
      $online_categories = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_online_categories,  $row_get_ls)->getValue();
      $product_name_en = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_en,  $row_get_ls)->getValue();
      $special_shade_en = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_special_shade_en,  $row_get_ls)->getValue();
      $color = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_color,  $row_get_ls)->getValue();
      $size = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size,  $row_get_ls)->getValue();
      $unit_size = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_size,  $row_get_ls)->getValue();
      // to review with collection again
      //end
      //select shade
      if($special_shade_en<>""){
        $shade = $special_shade_en ;
      }else{
        if(look_up_label($color,"option_en","shade") == ""){
          $shade = $color;
        }else{
          $shade = look_up_label($color,"option_en","shade");
        }
      }
      //translate size and unit and shade
      //$size = translate_size_to_en($size);
      //end translate size and unit and shade
      if(look_up_label($size,"option_en","size")<>""){
        $size = "Size ".look_up_label($size,"option_en","size");
      }else{
        if($size ==  ""){
          $size =  "";
        }
      }
      $new_product_name_en = trim($product_name_en," ")." ".$shade." ".$size;
      return $new_product_name_en;
    }
    function product_detail_en(){
      $pid = pid();
      global $row_get_ls;
      global $ws_linesheet;
      global $IMFORM_column_number_link_to_size_guide_images;
      global $con;
      global $IMFORM_column_number_product_name_en;
      global $caution_cds_en;
      global $IMFORM_column_number_product_detail_en;
      global $IMFORM_column_number_size_standard;
      global $IMFORM_column_number_size_unit;
      global $IMFORM_column_number_size;
      global $IMFORM_column_number_sleeve_length;
      global $IMFORM_column_number_bust_chest;
      global $IMFORM_column_number_underbust;
      global $IMFORM_column_number_waist;
      global $IMFORM_column_number_hip;
      global $use_markdown_engine;
      global $Parsedown;
      global $con;
      global $id;
      $product_description_en = $ws_linesheet->getCellByColumnAndRow($GLOBALS['IMFORM_column_number_product_detail_en'],  $row_get_ls)->getValue();
      if($use_markdown_engine=="Yes"){
        $product_description_en = $Parsedown->text($product_description_en);
      }
      // add bullet ---
      $pdb = "<ul>";
      $query= "SELECT * FROM pim_attribute_convert_im_form where concate_description > 0 order by concate_description ASC" or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($row= mysqli_fetch_array($result)) {
        $linesheet_code = $row["linesheet_code"];
        $unit_code =  $row["is_unit_linesheet_code"];
        // $col_name =  ${"IMFORM_column_number_$linesheet_code"};
        // $col_name_unit = ${"IMFORM_column_number_$unit_code"};
        $col_name = $GLOBALS['IMFORM_column_number_'.$linesheet_code];
        $col_name_unit = $GLOBALS['IMFORM_column_number_'.$unit_code];
        if($col_name<>"" and $col_name <> null){
          if($row["lookup_value_en"]=='Yes'){
            $attribute_value = $ws_linesheet->getCellByColumnAndRow($col_name ,  $row_get_ls)->getValue();
            $attribute_value = look_up_label($attribute_value,"option_en",$linesheet_code);
          }else{
            $attribute_value = $ws_linesheet->getCellByColumnAndRow($col_name ,  $row_get_ls)->getValue();
          }
        }
        if($col_name_unit<>"" and $col_name_unit<>null){
          $attribute_value_unit = $ws_linesheet->getCellByColumnAndRow( $col_name_unit ,  $row_get_ls)->getValue();
          $attribute_value_unit = look_up_label($attribute_value_unit,"option_en",$unit_code);
        }
        if($linesheet_code =="shade"){
          $shade_display = shade_display("en");
          if($shade_display<>"" and $shade_display<>null){
            $pdb .= "<li>".$row["label_des_en"]." : ".$shade_display."</li>\n";
          }
        }
        if($attribute_value <>"" and $attribute_value<>null){
          $pdb .= "<li>".$row["label_des_en"]." : ".$attribute_value." ".$attribute_value_unit."</li>\n";
        }
        unset($attribute_value);
        unset($attribute_value_unit);
        unset($linesheet_code);
        unset($unit_code);
        unset($col_name);
        unset($col_name_unit);
      }
      $pdb .= "</ul>";
      // end add bullet ---
      //get brand from ticket
      $query_job_cms = "SELECT * FROM job_cms where id = ".$id or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query_job_cms);
      while($row = mysqli_fetch_array($result)) {
        $brand_name = $row["brand"];
      }
      $product_description_en = str_replace($brand_name ,"<strong>".$brand_name ."</strong>",$product_description_en);
      //add product name
      $product_name_en = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_en,  $row_get_ls)->getValue();
      $product_description_en =  "<strong>".$brand_name ." ".$product_name_en."</strong>\n<br>".$product_description_en ;
      $link_to_size_guide_images = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_link_to_size_guide_images,  $row_get_ls)->getValue();
      if($link_to_size_guide_images<>"" and $link_to_size_guide_images <> null){
        $image_size_chart = '<br><img src="https://backend.central.co.th/media/catalog/product/'.strtolower(substr($pid,0,1))."/".strtolower(substr($pid,1,1)).'/'.strtolower($pid).'-999.jpg" alt=" " width="100%" height="100%" />';
      }
      else{
        $image_size_chart = '';
      }
      //add caution_cds_en
      $final_des = $product_description_en.$pdb.$image_size_chart."\n<strong style='color:red'>".$caution_cds_en."</strong>";
      $final_des = str_replace("</li><ul><li>","</li>\n<li>",$final_des);
      return $final_des;
    }
    function product_detail_th(){
      $pid = pid();
      global $IMFORM_column_number_link_to_size_guide_images;
      global $row_get_ls;
      global $ws_linesheet;
      global $IMFORM_column_number_product_detail_th;
      global $con;
      global $caution_cds_th;
      global $id;
      global $IMFORM_column_number_size_standard;
      global $IMFORM_column_number_size_unit;
      global $IMFORM_column_number_size;
      global $IMFORM_column_number_sleeve_length;
      global $IMFORM_column_number_bust_chest;
      global $IMFORM_column_number_underbust;
      global $IMFORM_column_number_waist;
      global $IMFORM_column_number_hip;
      global $IMFORM_column_number_product_name_th;
      global $use_markdown_engine;
      global $Parsedown;
      $product_description_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_detail_th,  $row_get_ls)->getValue();
      if($use_markdown_engine=="Yes"){
        $product_description_th = $Parsedown->text($product_description_th);
      }
      // add bullet ---
      $pdb = "<ul>";
      $query= "SELECT * FROM pim_attribute_convert_im_form where concate_description > 0 order by concate_description ASC" or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($row= mysqli_fetch_array($result)) {
        $linesheet_code = $row["linesheet_code"];
        $unit_code =  $row["is_unit_linesheet_code"];
        //  $col_name = ${"IMFORM_column_number_$linesheet_code"};
        //  $col_name_unit = ${"IMFORM_column_number_$unit_code"};
        $col_name = $GLOBALS['IMFORM_column_number_'.$linesheet_code];
        $col_name_unit = $GLOBALS['IMFORM_column_number_'.$unit_code];
        if($col_name<>"" and $col_name <> null){
          if($row["lookup_value_en"]=='Yes'){
            $attribute_value = $ws_linesheet->getCellByColumnAndRow($col_name ,  $row_get_ls)->getValue();
            $attribute_value = look_up_label($attribute_value,"option_th",$linesheet_code);
          }else{
            $attribute_value = $ws_linesheet->getCellByColumnAndRow($col_name ,  $row_get_ls)->getValue();
          }
        }
        if($col_name_unit<>"" and $col_name_unit<>null){
          $attribute_value_unit = $ws_linesheet->getCellByColumnAndRow( $col_name_unit ,  $row_get_ls)->getValue();
          $attribute_value_unit = look_up_label($attribute_value_unit,"option_th",$unit_code);
        }
        if($linesheet_code =="shade" ){
          $shade_display = shade_display("th");
          if($shade_display<>"" and $shade_display<>null){
            $pdb .= "<li>".$row["label_des_th"]." : ".$shade_display."</li>\n";
          }
        }
        if($attribute_value <>"" and $attribute_value <>null){
          $pdb .= "<li>".$row["label_des_th"]." : ".$attribute_value." ".$attribute_value_unit."</li>\n";
        }
        unset($attribute_value);
        unset($attribute_value_unit);
        unset($linesheet_code);
        unset($unit_code);
        unset($col_name);
        unset($col_name_unit);
      }
      $pdb .= "</ul>";
      // end add bullet ---
      //get brand from ticket
      $query_job_cms = "SELECT * FROM job_cms where id = ".$id or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query_job_cms);
      while($row = mysqli_fetch_array($result)) {
        $brand_name = $row["brand"];
      }
      $product_description_th = str_replace($brand_name ,"<strong>".$brand_name ."</strong>",$product_description_th);
      //add caution_cds_en
      //add product name
      $product_name_th = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_product_name_th,  $row_get_ls)->getValue();
      $product_description_th =  "<strong>".$brand_name ." ".$product_name_th."</strong>\n<br>".$product_description_th ;
      // add image size chart
      $link_to_size_guide_images = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_link_to_size_guide_images,  $row_get_ls)->getValue();
      if($link_to_size_guide_images<>"" and $link_to_size_guide_images <> null){
        $image_size_chart = '<br><img src="https://backend.central.co.th/media/catalog/product/'.strtolower(substr($pid,0,1))."/".strtolower(substr($pid,1,1)).'/'.strtolower($pid).'-999.jpg" alt=" " width="100%" height="100%" />';
      }
      else{
        $image_size_chart='';
      }
      $final_des = $product_description_th.$pdb.$image_size_chart."<br>\n<strong style='color:red'>".$caution_cds_th."</strong>";
      $final_des = str_replace("</li><ul><li>","</li>\n<li>",$final_des);
      return $final_des ;
    }
    function parent(){
      global $IMFORM_column_number_catalogue_number_for_group;
      global $ws_linesheet;
      global $row_get_ls;
      global $parent_no_running;
      global $g_running;
      global $parents;
      $catalog_a = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_catalogue_number_for_group,  $row_get_ls)->getValue();
      $catalog_b = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_catalogue_number_for_group,  $row_get_ls+1)->getValue();
      $catalog_c = $ws_linesheet->getCellByColumnAndRow($IMFORM_column_number_catalogue_number_for_group,  $row_get_ls-1)->getValue();
      if($catalog_a<>$catalog_b and  $catalog_a==$catalog_c and($catalog_a <> "" and $catalog_c <> ""))
      {
        $parent_gen = $parent_no_running.sprintf("%04d", $g_running);
        if($parent_gen<>null and substr( $parent_gen, 0, 1 ) <> "="){
          return $parent_gen;
        }
      }elseif($catalog_a==$catalog_b and  $catalog_a==$catalog_c and($catalog_a <> "" and $catalog_b <> "" and $catalog_c <> "")){
        $parent_gen = $parent_no_running.sprintf("%04d", $g_running);
        return $parent_gen;
      }elseif($catalog_a==$catalog_b and  $catalog_a<>$catalog_c and($catalog_a <> "" and $catalog_b <> "")){
        $g_running++;
        $parent_gen = $parent_no_running.sprintf("%04d", $g_running);
        if(!in_array($parent_gen, $parents)){
          $parents[]=$parent_gen;
        }
        return $parent_gen;
      }
    }
    ?>