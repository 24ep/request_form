<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

//query
$query = "
SELECT tr.* ,image_url.image_url tr FROM taxonomy_raw_demo as tr
left join taxonomy_image_url as image_url
where
(tr.in_80_sale_contribute = 'Y' or in_top_200 = 'Y') and
(check_by is null or check_by =='".$_SESSION['username']."')
order by sale limit 1" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {

    //product information session
    $sku = $row['sku'];
    $name_en = $row['name_en'];
    $image_url = $row['image_url'];

    //new attribute_taxonomy
    $new_attribute="";
    if($row['accessory_watches_style']<>Null){ $new_attribute .=  "<label>accessory_watches_style</label></br><input id='accessory_watches_style' value=".$row['accessory_watches_style'].">"}
    if($row['air_conditioner_type']<>Null){ $new_attribute .=  "<label>air_conditioner_type</label></br><input id='air_conditioner_type' value=".$row['air_conditioner_type'].">"}
    if($row['air_purifier_type']<>Null){ $new_attribute .=  "<label>air_purifier_type</label></br><input id='air_purifier_type' value=".$row['air_purifier_type'].">"}
    if($row['ball_type']<>Null){ $new_attribute .=  "<label>ball_type</label></br><input id='ball_type' value=".$row['ball_type'].">"}
    if($row['beauty_set_type']<>Null){ $new_attribute .=  "<label>beauty_set_type</label></br><input id='beauty_set_type' value=".$row['beauty_set_type'].">"}
    if($row['book_genre']<>Null){ $new_attribute .=  "<label>book_genre</label></br><input id='book_genre' value=".$row['book_genre'].">"}
    if($row['coffee_machine_type']<>Null){ $new_attribute .=  "<label>coffee_machine_type</label></br><input id='coffee_machine_type' value=".$row['coffee_machine_type'].">"}
    if($row['console_type']<>Null){ $new_attribute .=  "<label>console_type</label></br><input id='console_type' value=".$row['console_type'].">"}
    if($row['dress_length']<>Null){ $new_attribute .=  "<label>dress_length</label></br><input id='dress_length' value=".$row['dress_length'].">"}
    if($row['face_mask_type']<>Null){ $new_attribute .=  "<label>face_mask_type</label></br><input id='face_mask_type' value=".$row['face_mask_type'].">"}
    if($row['facial_part']<>Null){ $new_attribute .=  "<label>facial_part</label></br><input id='facial_part' value=".$row['facial_part'].">"}
    if($row['fan_type']<>Null){ $new_attribute .=  "<label>fan_type</label></br><input id='fan_type' value=".$row['fan_type'].">"}
    if($row['fashion_occasion']<>Null){ $new_attribute .=  "<label>fashion_occasion</label></br><input id='fashion_occasion' value=".$row['fashion_occasion'].">"}
    if($row['fryer_type']<>Null){ $new_attribute .=  "<label>fryer_type</label></br><input id='fryer_type' value=".$row['fryer_type'].">"}
    if($row['gender']<>Null){ $new_attribute .=  "<label>gender</label></br><input id='gender' value=".$row['gender'].">"}
    if($row['haircare_type']<>Null){ $new_attribute .=  "<label>haircare_type</label></br><input id='haircare_type' value=".$row['haircare_type'].">"}
    if($row['hat_type']<>Null){ $new_attribute .=  "<label>hat_type</label></br><input id='hat_type' value=".$row['hat_type'].">"}
    if($row['headphone_type']<>Null){ $new_attribute .=  "<label>headphone_type</label></br><input id='headphone_type' value=".$row['headphone_type'].">"}
    if($row['irons_type']<>Null){ $new_attribute .=  "<label>irons_type</label></br><input id='irons_type' value=".$row['irons_type'].">"}
    if($row['life_pen_type']<>Null){ $new_attribute .=  "<label>life_pen_type</label></br><input id='life_pen_type' value=".$row['life_pen_type'].">"}
    if($row['material_clothing']<>Null){ $new_attribute .=  "<label>material_clothing</label></br><input id='material_clothing' value=".$row['material_clothing'].">"}
    if($row['maternity']<>Null){ $new_attribute .=  "<label>maternity</label></br><input id='maternity' value=".$row['maternity'].">"}
    if($row['pencil_type']<>Null){ $new_attribute .=  "<label>pencil_type</label></br><input id='pencil_type' value=".$row['pencil_type'].">"}
    if($row['pet_type']<>Null){ $new_attribute .=  "<label>pet_type</label></br><input id='pet_type' value=".$row['pet_type'].">"}
    if($row['refrigerator_doors']<>Null){ $new_attribute .=  "<label>refrigerator_doors</label></br><input id='refrigerator_doors' value=".$row['refrigerator_doors'].">"}
    if($row['ring_type']<>Null){ $new_attribute .=  "<label>ring_type</label></br><input id='ring_type' value=".$row['ring_type'].">"}
    if($row['screen_resolution']<>Null){ $new_attribute .=  "<label>screen_resolution</label></br><input id='screen_resolution' value=".$row['screen_resolution'].">"}
    if($row['shoes_occasion']<>Null){ $new_attribute .=  "<label>shoes_occasion</label></br><input id='shoes_occasion' value=".$row['shoes_occasion'].">"}
    if($row['skirt_length']<>Null){ $new_attribute .=  "<label>skirt_length</label></br><input id='skirt_length' value=".$row['skirt_length'].">"}
    if($row['speaker_type']<>Null){ $new_attribute .=  "<label>speaker_type</label></br><input id='speaker_type' value=".$row['speaker_type'].">"}
    if($row['sport_type']<>Null){ $new_attribute .=  "<label>sport_type</label></br><input id='sport_type' value=".$row['sport_type'].">"}
    if($row['storage_drive_type']<>Null){ $new_attribute .=  "<label>storage_drive_type</label></br><input id='storage_drive_type' value=".$row['storage_drive_type'].">"}
    if($row['stove_type']<>Null){ $new_attribute .=  "<label>stove_type</label></br><input id='stove_type' value=".$row['stove_type'].">"}
    if($row['swimming_goggle_type']<>Null){ $new_attribute .=  "<label>swimming_goggle_type</label></br><input id='swimming_goggle_type' value=".$row['swimming_goggle_type'].">"}
    if($row['tea_coffee_equipment_type']<>Null){ $new_attribute .=  "<label>tea_coffee_equipment_type</label></br><input id='tea_coffee_equipment_type' value=".$row['tea_coffee_equipment_type'].">"}
    if($row['towels_type']<>Null){ $new_attribute .=  "<label>towels_type</label></br><input id='towels_type' value=".$row['towels_type'].">"}
    if($row['vacuum_cleaner_type']<>Null){ $new_attribute .=  "<label>vacuum_cleaner_type</label></br><input id='vacuum_cleaner_type' value=".$row['vacuum_cleaner_type'].">"}
    if($row['washing_machine_type']<>Null){ $new_attribute .=  "<label>washing_machine_type</label></br><input id='washing_machine_type' value=".$row['washing_machine_type'].">"}
}

echo $new_attribute;

//stamp name
$query = "update all_in_one_project.taxonomy_demo set
check_by = '".$_SESSION['username']."' ,
where sku = ".$sku
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);

?>

<div class="container-md">

<!-- nav bra -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1 fixed-top bg-white "><?php echo $sku;?></span>
  </div>
  <div class="container-fluid">
    <div class="row">
        <div class="col-2">name_en</div>
        <div class="col-10"><?php echo $name_en;?></div>
    </div>
    <div class="row">
        <div class="col-2">name_en</div>
        <div class="col-10"><?php echo $description;?></div>
    </div>
    <div class="row">
        <div class="col-2">Image</div>
        <div class="col-10">
        <img src="<?php echo $image_url ;?>" class="rounded float-start" >
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        <div>
        <div class="col-6">
            <?php echo $new_attribute ;?>
        <div>
    <div>
  </div>
</nav>
<!-- product information -->


</div>
