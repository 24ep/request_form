<?php
 session_start();
 $sku = $_POST['sku'];
 $status = $_POST['status'];
 $value_accessory_watches_style = $_POST['value_accessory_watches_style'];
$value_air_conditioner_type = $_POST['value_air_conditioner_type'];
$value_air_purifier_type = $_POST['value_air_purifier_type'];
$value_ball_type = $_POST['value_ball_type'];
$value_beauty_set_type = $_POST['value_beauty_set_type'];
$value_book_genre = $_POST['value_book_genre'];
$value_coffee_machine_type = $_POST['value_coffee_machine_type'];
$value_console_type = $_POST['value_console_type'];
$value_dress_length = $_POST['value_dress_length'];
$value_face_mask_type = $_POST['value_face_mask_type'];
$value_facial_part = $_POST['value_facial_part'];
$value_fan_type = $_POST['value_fan_type'];
$value_fashion_occasion = $_POST['value_fashion_occasion'];
$value_fryer_type = $_POST['value_fryer_type'];
$value_gender = $_POST['value_gender'];
$value_haircare_type = $_POST['value_haircare_type'];
$value_hat_type = $_POST['value_hat_type'];
$value_headphone_type = $_POST['value_headphone_type'];
$value_irons_type = $_POST['value_irons_type'];
$value_life_pen_type = $_POST['value_life_pen_type'];
$value_material_clothing = $_POST['value_material_clothing'];
$value_maternity = $_POST['value_maternity'];
$value_pencil_type = $_POST['value_pencil_type'];
$value_pet_type = $_POST['value_pet_type'];
$value_refrigerator_doors = $_POST['value_refrigerator_doors'];
$value_ring_type = $_POST['value_ring_type'];
$value_screen_resolution = $_POST['value_screen_resolution'];
$value_shoes_occasion = $_POST['value_shoes_occasion'];
$value_skirt_length = $_POST['value_skirt_length'];
$value_speaker_type = $_POST['value_speaker_type'];
$value_sport_type = $_POST['value_sport_type'];
$value_storage_drive_type = $_POST['value_storage_drive_type'];
$value_stove_type = $_POST['value_stove_type'];
$value_swimming_goggle_type = $_POST['value_swimming_goggle_type'];
$value_tea_coffee_equipment_type = $_POST['value_tea_coffee_equipment_type'];
$value_towels_type = $_POST['value_towels_type'];
$value_vacuum_cleaner_type = $_POST['value_vacuum_cleaner_type'];
$value_washing_machine_type = $_POST['value_washing_machine_type'];
$value_new_cate = $_POST['value_new_cate'];
function update_taxonomy_qc(
        $sku,
        $status,
        $value_accessory_watches_style,
        $value_air_conditioner_type,
        $value_air_purifier_type,
        $value_ball_type,
        $value_beauty_set_type,
        $value_book_genre,
        $value_coffee_machine_type,
        $value_console_type,
        $value_dress_length,
        $value_face_mask_type,
        $value_facial_part,
        $value_fan_type,
        $value_fashion_occasion,
        $value_fryer_type,
        $value_gender,
        $value_haircare_type,
        $value_hat_type,
        $value_headphone_type,
        $value_irons_type,
        $value_life_pen_type,
        $value_material_clothing,
        $value_maternity,
        $value_pencil_type,
        $value_pet_type,
        $value_refrigerator_doors,
        $value_ring_type,
        $value_screen_resolution,
        $value_shoes_occasion,
        $value_skirt_length,
        $value_speaker_type,
        $value_sport_type,
        $value_storage_drive_type,
        $value_stove_type,
        $value_swimming_goggle_type,
        $value_tea_coffee_equipment_type,
        $value_towels_type,
        $value_vacuum_cleaner_type,
        $value_washing_machine_type,
        $new_cate
        ){

        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");

        //update_exsiting_status
        $sql = "update taxonomy.taxonomy_demo set
        check_by = ".$_SESSION['username'].",
        check_date = CURRENT_TIMESTAMP,
        status = ".$status.",
        where sku = ".$sku
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);

        //insert to complete data
        $query = "INSERT INTO taxonomy.taxonomy_complete_demo
        (sku,
        accessory_watches_style,
        air_conditioner_type,
        air_purifier_type,
        ball_type,
        beauty_set_type,
        book_genre,
        coffee_machine_type,
        console_type,
        dress_length,
        face_mask_type,
        facial_part,
        fan_type,
        fashion_occasion,
        fryer_type,
        gender,
        haircare_type,
        hat_type,
        headphone_type,
        irons_type,
        life_pen_type,
        material_clothing,
        maternity,
        pencil_type,
        pet_type,
        refrigerator_doors,
        ring_type,
        screen_resolution,
        shoes_occasion,
        skirt_length,
        speaker_type,
        sport_type,
        storage_drive_type,
        stove_type,
        swimming_goggle_type,
        tea_coffee_equipment_type,
        towels_type,
        vacuum_cleaner_type,
        washing_machine_type)
        values
        (
        '".$value_sku."',
        '".$value_accessory_watches_style."',
        '".$value_air_conditioner_type."',
        '".$value_air_purifier_type."',
        '".$value_ball_type."',
        '".$value_beauty_set_type."',
        '".$value_book_genre."',
        '".$value_coffee_machine_type."',
        '".$value_console_type."',
        '".$value_dress_length."',
        '".$value_face_mask_type."',
        '".$value_facial_part."',
        '".$value_fan_type."',
        '".$value_fashion_occasion."',
        '".$value_fryer_type."',
        '".$value_gender."',
        '".$value_haircare_type."',
        '".$value_hat_type."',
        '".$value_headphone_type."',
        '".$value_irons_type."',
        '".$value_life_pen_type."',
        '".$value_material_clothing."',
        '".$value_maternity."',
        '".$value_pencil_type."',
        '".$value_pet_type."',
        '".$value_refrigerator_doors."',
        '".$value_ring_type."',
        '".$value_screen_resolution."',
        '".$value_shoes_occasion."',
        '".$value_skirt_length."',
        '".$value_speaker_type."',
        '".$value_sport_type."',
        '".$value_storage_drive_type."',
        '".$value_stove_type."',
        '".$value_swimming_goggle_type."',
        '".$value_tea_coffee_equipment_type."',
        '".$value_towels_type."',
        '".$value_vacuum_cleaner_type."',
        '".$value_washing_machine_type."')"
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);

}
?>