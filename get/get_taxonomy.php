<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$new_attribute="";
//query
$query = "
SELECT tr.* ,image_url.image_url as image_url FROM taxonomy.taxonomy_demo as tr
left join taxonomy.taxonomy_image_url as image_url
on image_url.sku = tr.sku
where(
(tr.in_80_sale_contribute = 'Y' or tr.in_top_200 = 'Y' or  tr.in_top_200 = 'Top 200') and
(tr.check_by is null or tr.check_by ='".$_SESSION['username']."')) and `Auto enrichment` = 'Y' and
(accessory_watches_style is not null or
air_conditioner_type is not null or
air_purifier_type is not null or
ball_type is not null or
beauty_set_type is not null or
book_genre is not null or
coffee_machine_type is not null or
console_type is not null or
dress_length is not null or
face_mask_type is not null or
facial_part is not null or
fan_type is not null or
fashion_occasion is not null or
fryer_type is not null or
gender is not null or
haircare_type is not null or
hat_type is not null or
headphone_type is not null or
irons_type is not null or
life_pen_type is not null or
material_clothing is not null or
maternity is not null or
pencil_type is not null or
pet_type is not null or
refrigerator_doors is not null or
ring_type is not null or
screen_resolution is not null or
shoes_occasion is not null or
skirt_length is not null or
speaker_type is not null or
sport_type is not null or
storage_drive_type is not null or
stove_type is not null or
swimming_goggle_type is not null or
tea_coffee_equipment_type is not null or
towels_type is not null or
vacuum_cleaner_type is not null or
washing_machine_type is not null)
order by tr.sale DESC limit 1" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    //product information session
    $sku = $row['sku'];
    $product_url = $row['product_url'];
    $name_en = $row['name_EN'];
    $name_th = $row['name_TH'];
    $image_url = $row['image_url'];
    $query_att = "SELECT DISTINCT attribute_code FROM taxonomy.attribute_option;";
    $result_att = mysqli_query($con, $query_att);
    while($row_att = mysqli_fetch_array($result_att)) {
        if($row[$row_att['attribute_code']]<>"" and $row[$row_att['attribute_code']]<>Null){
                $display = "block";
        }else{
                $display = "none";
        }
// old attribute
            $old_attribute .= "<label class='mb-1' style='display:".$display."'>".$row_att['attribute_code']."</label>";
            $old_attribute .= '<input type="text" style="display:'.$display.'" id="old_'.$row_att['attribute_code'].'"  class="form-control form-control-sm" disabled>';
//new attribute
            $new_attribute .="<div class='row'>";
            $new_attribute .="<div class='col-6'>";
            $new_attribute .= "<label style='display:".$display."' class='mb-1'>".$row_att['attribute_code']."</label>";
            $new_attribute .= "
            <select  style='display:".$display."' class='form-select form-select-sm' id='".$row_att['attribute_code']."' >";
            $query_att_option = "SELECT DISTINCT attribute_option FROM taxonomy.attribute_option where attribute_code='".$row_att['attribute_code']."';";
            $result_att_option = mysqli_query($con, $query_att_option);
            $new_attribute .= "<option value=''></option>";
            while($row_att_option = mysqli_fetch_array($result_att_option)) {
                if($row[$row_att['attribute_code']]==$row_att_option['attribute_option']){
                    $new_attribute .= "<option selected value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_option']."</option>";
                }else{
                    $new_attribute .= "<option value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_option']."</option>";
                }
            }

            $new_attribute .= "</select>";
            $new_attribute .="</div>";
            $new_attribute .="<div class='col-6 mt-4' style='display:".$display."'>";
            $new_attribute .='<input type="radio" style="display:'.$display.'" class="btn-check" name="options-outlined-'.$row_att["attribute_code"].'"
                                id="no_'.$row_att["attribute_code"].'" autocomplete="off" >
                                <label class="btn btn-outline-danger btn-sm"
                                style=" border-radius: 0%;" for="no_'.$row_att["attribute_code"].'">No</label>
                                <input style="display:'.$display.'" type="radio" class="btn-check" name="options-outlined-'.$row_att["attribute_code"].'"
                                    id="yes_'.$row_att["attribute_code"].'" autocomplete="off">
                                <label class="btn btn-outline-success btn-sm"
                                style=" border-radius: 0%;" for="yes_'.$row_att["attribute_code"].'">Yes</label>';
            $new_attribute .="</div>";
            $new_attribute .="</div>";

    }
}
// echo $new_attribute;
//stamp name
$sql = "update taxonomy.taxonomy_demo set
check_by = '".$_SESSION['username']."'
where sku = '".$sku."'"
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);


?>
<div class="container-md">
    <!-- nav bra -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 ms-0 h4 "><?php echo $sku;?></span>
<input type="hidden" id="sku" value="<?php echo $sku;?>">
            <a href="<?php echo $product_url;?>" target="_blank"><ion-icon name="open-outline"></ion-icon></a>
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
    <div class="row row mt-4">
        <div class="col-4 border-left">
        <h3 style="font-weight: bolder;">OLD</h3>
            <?php echo $old_attribute ;?>
        </div>
        <div class="col-8">
        <h3 style="font-weight: bolder;">NEW</h3>
            <?php echo $new_attribute ;?>
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <!-- <button class="btn btn-primary me-md-2" type="button">Button</button>
        <button class="btn btn-primary" type="button">Button</button> -->
        <input type="button" class=" btn btn-sm btn-danger rounded-fill" value="Submit" onclick="summit_taxonomy('<?php echo $sku;?>')">
    </div>

    <!-- product information -->
</div>