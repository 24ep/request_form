<?php
session_start();
$_SESSION['taxonomy_model_selected'] = $_POST['model_selected'];
$selected_categories = $_POST['selected_categories'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));

$model_selected =  $_POST['model_selected'];



if($model_selected=="retail"){
    $model_selected = "('retail')";
    $query_condition ="((tr.status <> 'QC_PASSED' and tr.status <> 'REVISED') or tr.status is null) and
    (tr.in_80_sale_contribute = 'Y' or tr.in_top_200 = 'Y') and
    (tr.check_by is null or tr.check_by ='".$_SESSION['username']."')) and tr.auto_enrichment = 'Y' and tr.model = 'retail'";
}
if($model_selected=="mkp"){
    $model_selected = "('mkp')";
    $query_condition ="((tr.status = 'PENDING' ) and
    (tr.check_by is null or tr.check_by ='".$_SESSION['username']."') and tr.model = 'retail'";
}
if($model_selected=="non_selected"){
    $model_selected = "('retail','mkp')";
    $query_condition =" ((tr.status <> 'QC_PASSED' and tr.status <> 'REVISED') or tr.status is null) and
    (tr.in_80_sale_contribute = 'Y' or tr.in_top_200 = 'Y') and
    (tr.check_by is null or tr.check_by ='".$_SESSION['username']."')) and tr.auto_enrichment = 'Y' and tr.model = 'retail'";
}
mysqli_query($con, "SET NAMES 'utf8' ");
$new_attribute="";
//query
$query = "
SELECT tr.* ,image_url.image_url as image_url ,des.clean_text_th as description FROM taxonomy.taxonomy_raw as tr
left join taxonomy.taxonomy_image_url as image_url
on image_url.sku = tr.sku
left join taxonomy.taxonomy_description  as des
on des.sku = tr.sku
where ( ".$query_condition." and
(new_accessory_watches_style is not null or
new_air_conditioner_type is not null or
new_air_purifier_type is not null or
new_ball_type is not null or
new_beauty_set_type is not null or
new_book_genre is not null or
new_coffee_machine_type is not null or
new_console_type is not null or
new_dress_length is not null or
new_face_mask_type is not null or
new_facial_part is not null or
new_fan_type is not null or
new_fashion_occasion is not null or
new_fryer_type is not null or
new_gender is not null or
new_haircare_type is not null or
new_hat_type is not null or
new_headphone_type is not null or
new_irons_type is not null or
new_life_pen_type is not null or
new_material_clothing is not null or
new_maternity is not null or
new_pencil_type is not null or
new_pet_type is not null or
new_refrigerator_doors is not null or
new_ring_type is not null or
new_screen_resolution is not null or
new_shoes_occasion is not null or
new_skirt_length is not null or
new_speaker_type is not null or
new_sport_type is not null or
new_storage_drive_type is not null or
new_stove_type is not null or
new_swimming_goggle_type is not null or
new_tea_coffee_equipment_type is not null or
new_towels_type is not null or
new_vacuum_cleaner_type is not null or
new_washing_machine_type is not null)
order by tr.brand_name , tr.new_cate , tr.sale DESC limit 1" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    //product information session
    $sku = $row['sku'];
    $brand = $row['brand'];
    $product_url = $row['product_url'];
    $name_en = $row['name_EN'];
    $name_th = $row['name_TH'];
    $description = $row['description'];
    $image_url = $row['image_url'];
    $query_att = "SELECT DISTINCT attribute_code,pim_attribute_code FROM taxonomy.attribute_option;";
    $result_att = mysqli_query($con, $query_att);
    while($row_att = mysqli_fetch_array($result_att)) {

        if((($row["new_".$row_att['pim_attribute_code']]<>"" and $row["new_".$row_att['pim_attribute_code']]<>Null ) or $row_att['attribute_code']=='new_cate')){
            $display = "block";
        }else{
            $display = "none";
        }

        if($row_att['attribute_code']=='new_cate'){
            $class="";
            $multiple ="multiple";
            $select_style = "";
            $onchangecate = 'change_attribute_cate();';
        }else{
            $class="form-select form-select-sm";
            $multiple ="";
            $select_style = "style='display:".$display."'";
            $onchangecate = '';
        }
        //old attribute
        $old_attribute .= "<label class='mb-1' id='label_old_".$row_att['pim_attribute_code']."' style='display:".$display."'>old_".$row_att['pim_attribute_code']."</label>";
        if($row_att['pim_attribute_code']=='cate'){
            $old_attribute .= '<textarea  style="display:'.$display.'" id="old_'.$row_att['pim_attribute_code'].'"  class="form-control form-control-sm" readonly>'.$row["old_".$row_att['pim_attribute_code']].'</textarea>';
        }else{
            $old_attribute .= '<input type="text"  value="'.$row["old_".$row_att['pim_attribute_code']].'" style="display:'.$display.'" id="old_'.$row_att['pim_attribute_code'].'"  class="form-control form-control-sm" readonly>';
        }

        //new attribute
        $new_attribute .="<div class='row'>";
        $new_attribute .="<div class='col-10'>";
        $new_attribute .= "<label id='label_new_".$row_att['pim_attribute_code']."' style='display:".$display."' class='mb-1'>".$row_att['attribute_code']."</label>";


        $new_attribute .= "
        <select  onchange='auto_select_no(&#39;".$row_att['attribute_code']."&#39;);".$onchangecate."' ".$multiple." ".$select_style." class='".$class."' id='".$row_att['attribute_code']."' >";
        $query_att_option = "SELECT DISTINCT attribute_option,attribute_label FROM taxonomy.attribute_option where attribute_code='".$row_att['attribute_code']."';";
        $result_att_option = mysqli_query($con, $query_att_option);
        $new_attribute .= "<option value=''></option>";
        while($row_att_option = mysqli_fetch_array($result_att_option)) {
            if($multiple =="multiple"){
                $attribute_option_selected = explode(",",$row[$row_att['attribute_code']]);
                if(in_array($row_att_option['attribute_option'],$attribute_option_selected )){
                    $new_attribute .= "<option selected value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_label']."</option>";
                }else{
                    $new_attribute .= "<option value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_label']."</option>";
                }

            }else{
                if($row[$row_att['attribute_code']]==$row_att_option['attribute_option']){
                    $new_attribute .= "<option selected value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_label']."</option>";
                }else{
                    $new_attribute .= "<option value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_label']."</option>";
                }
            }
        }

        $new_attribute .= "</select>";
        $new_attribute .= "<small id='original_".$row_att["attribute_code"]."' style='font-size:10px;display:none;color: #c3c3c3;'>Original value : ".$row[$row_att['attribute_code']]."</small>";
        $new_attribute .="</div>";
        $new_attribute .="<div class='col-2 mt-4 ps-0 pe-0' id='yesno_".$row_att["attribute_code"]."' style='display:".$display."'>";
        $new_attribute .='<input  value="'.$row_att["attribute_code"].'" onclick="ShowSmallOriginalValue(&#39;'.$row_att["attribute_code"].'&#39;)" type="radio"  style="display:'.$display.'" class="btn-check" name="options-outlined-'.$row_att["attribute_code"].'"
        id="no_'.$row_att["attribute_code"].'" autocomplete="off" >
        <label class="btn btn-outline-danger btn-sm"
        style=" border-radius: 0%;" for="no_'.$row_att["attribute_code"].'">No</label>
        <input   value="'.$row_att["attribute_code"].'" onclick="ShowSmallOriginalValue(&#39;'.$row_att["attribute_code"].'&#39;)" style="display:'.$display.'" type="radio" class="btn-check" name="options-outlined-'.$row_att["attribute_code"].'"
        id="yes_'.$row_att["attribute_code"].'" autocomplete="off">
        <label class="btn btn-outline-success btn-sm"
        style=" border-radius: 0%;" for="yes_'.$row_att["attribute_code"].'">Yes</label>';
        $new_attribute .="</div>";
        $new_attribute .="</div>";

    }
}
// echo $new_attribute;

//stamp name
$sql = "update taxonomy.taxonomy_raw set
check_by = '".$_SESSION['username']."'
where brand = '".$brand."'"
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);

//stamp name
$sql = "update taxonomy.taxonomy_raw set
check_by = '".$_SESSION['username']."',
feed_time = CURRENT_TIMESTAMP
where sku = '".$sku."'"
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);

?>
<div class="vstack gap-2 col-md-9 mx-auto">
    <!-- nav bra -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 ms-0 h4 "><?php echo $sku;?></span>
            <input type="hidden" id="sku" value="<?php echo $sku;?>">
            <a href="<?php echo $product_url;?>" target="_blank">
                <ion-icon name="open-outline"></ion-icon>
            </a>
        </div>
    </nav>
    <div class="container-fluid border-bottom pb-3">
        <div class="row mt-1">
            <div class="col-3"><strong>Name (english)</strong></div>
            <div class="col-9"><?php echo $name_en;?></div>
        </div>
        <div class="row mt-1">
            <div class="col-3"><strong>Name (Thai)</strong></div>
            <div class="col-9"><?php echo $name_th;?></div>
        </div>
        <div class="row mt-1">
            <div class="col-3"><strong>Description</strong></div>
            <div class="col-9"><?php echo $description;?></div>
        </div>
        <div class="row mt-1">
            <div class="col-3"><strong>Image</strong></div>
            <div class="col-9">
                <img src="<?php echo $image_url;?>" class="rounded float-start" width="120px" height="120px">
            </div>
        </div>
    </div>
    <!-- categories -->
    <!-- <div class="row row mt-4">
<div class="col-4 border-left">
<h3 style="font-weight: bolder;">OLD</h3>
<?php //echo $old_attribute ;?>
</div>
<div class="col-8">
<h3 style="font-weight: bolder;">NEW</h3>
<?php //echo $new_attribute ;?>
<div class="row">
<div class="col-6">
</div>
<div class="col-6">
<div class="mt-3">
<input type="button" class=" btn btn-sm btn-danger rounded-fill" value="Submit"
onclick="summit_taxonomy('<?php //echo $sku;?>')">
</div>
</div>
</div>
</div>
</div> -->
    <!-- attribute -->
    <div class="row row mt-4">
        <div class="col-4 border-left">
            <h3 style="font-weight: bolder;">OLD</h3>
            <?php echo $old_attribute ;?>
        </div>
        <div class="col-8">
            <h3 style="font-weight: bolder;">NEW</h3>
            <?php echo $new_attribute ;?>
            <div class="row">
                <div class="col-10">
                </div>
                <div class="col-2 p-0">
                    <div class="mt-3">
                        <input type="button" class=" btn btn-sm btn-danger rounded-fill w-75" value="Submit"
                            onclick="summit_taxonomy('<?php echo $sku;?>')">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product information -->
</div>

<script>
new SlimSelect({
    select: '#new_cate',
    settings: {
        showSearch: true,
        searchHighlight: true
    }
})
</script>