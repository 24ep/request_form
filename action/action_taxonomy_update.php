<?php
 session_start();
$sku = $_POST['sku'];
$status = $_POST['status'];
$value_new_accessory_watches_style = $_POST['value_new_accessory_watches_style'];
$value_new_air_conditioner_type = $_POST['value_new_air_conditioner_type'];
$value_new_air_purifier_type = $_POST['value_new_air_purifier_type'];
$value_new_ball_type = $_POST['value_new_ball_type'];
$value_new_beauty_set_type = $_POST['value_new_beauty_set_type'];
$value_new_book_genre = $_POST['value_new_book_genre'];
$value_new_coffee_machine_type = $_POST['value_new_coffee_machine_type'];
$value_new_console_type = $_POST['value_new_console_type'];
$value_new_dress_length = $_POST['value_new_dress_length'];
$value_new_face_mask_type = $_POST['value_new_face_mask_type'];
$value_new_facial_part = $_POST['value_new_facial_part'];
$value_new_fan_type = $_POST['value_new_fan_type'];
$value_new_fashion_occasion = $_POST['value_new_fashion_occasion'];
$value_new_fryer_type = $_POST['value_new_fryer_type'];
$value_new_gender = $_POST['value_new_gender'];
$value_new_haircare_type = $_POST['value_new_haircare_type'];
$value_new_hat_type = $_POST['value_new_hat_type'];
$value_new_headphone_type = $_POST['value_new_headphone_type'];
$value_new_irons_type = $_POST['value_new_irons_type'];
$value_new_life_pen_type = $_POST['value_new_life_pen_type'];
$value_new_material_clothing = $_POST['value_new_material_clothing'];
$value_new_maternity = $_POST['value_new_maternity'];
$value_new_pencil_type = $_POST['value_new_pencil_type'];
$value_new_pet_type = $_POST['value_new_pet_type'];
$value_new_refrigerator_doors = $_POST['value_new_refrigerator_doors'];
$value_new_ring_type = $_POST['value_new_ring_type'];
$value_new_screen_resolution = $_POST['value_new_screen_resolution'];
$value_new_shoes_occasion = $_POST['value_new_shoes_occasion'];
$value_new_skirt_length = $_POST['value_new_skirt_length'];
$value_new_speaker_type = $_POST['value_new_speaker_type'];
$value_new_sport_type = $_POST['value_new_sport_type'];
$value_new_storage_drive_type = $_POST['value_new_storage_drive_type'];
$value_new_stove_type = $_POST['value_new_stove_type'];
$value_new_swimming_goggle_type = $_POST['value_new_swimming_goggle_type'];
$value_new_tea_coffee_equipment_type = $_POST['value_new_tea_coffee_equipment_type'];
$value_new_towels_type = $_POST['value_new_towels_type'];
$value_new_vacuum_cleaner_type = $_POST['value_new_vacuum_cleaner_type'];
$value_new_washing_machine_type = $_POST['value_new_washing_machine_type'];
$new_cate = $_POST['new_cate'];


        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");

        //update_existing_status
        $sql = "update taxonomy.taxonomy_raw_f2 set
        check_by = '".$_SESSION['username']."',
        check_date = CURRENT_TIMESTAMP,
        status = '".$status."'
        where sku = '".$sku."'"
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);

        //insert to complete data
        $sql = "INSERT INTO taxonomy.taxonomy_completed_f2
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
        washing_machine_type,
        new_cate)
        values
        (
        '".$sku."',
        '".$value_new_accessory_watches_style."',
        '".$value_new_air_conditioner_type."',
        '".$value_new_air_purifier_type."',
        '".$value_new_ball_type."',
        '".$value_new_beauty_set_type."',
        '".$value_new_book_genre."',
        '".$value_new_coffee_machine_type."',
        '".$value_new_console_type."',
        '".$value_new_dress_length."',
        '".$value_new_face_mask_type."',
        '".$value_new_facial_part."',
        '".$value_new_fan_type."',
        '".$value_new_fashion_occasion."',
        '".$value_new_fryer_type."',
        '".$value_new_gender."',
        '".$value_new_haircare_type."',
        '".$value_new_hat_type."',
        '".$value_new_headphone_type."',
        '".$value_new_irons_type."',
        '".$value_new_life_pen_type."',
        '".$value_new_material_clothing."',
        '".$value_new_maternity."',
        '".$value_new_pencil_type."',
        '".$value_new_pet_type."',
        '".$value_new_refrigerator_doors."',
        '".$value_new_ring_type."',
        '".$value_new_screen_resolution."',
        '".$value_new_shoes_occasion."',
        '".$value_new_skirt_length."',
        '".$value_new_speaker_type."',
        '".$value_new_sport_type."',
        '".$value_new_storage_drive_type."',
        '".$value_new_stove_type."',
        '".$value_new_swimming_goggle_type."',
        '".$value_new_tea_coffee_equipment_type."',
        '".$value_new_towels_type."',
        '".$value_new_vacuum_cleaner_type."',
        '".$value_new_washing_machine_type."',
        '".$new_cate."')"
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);
        if($query){
                echo "update completed";
        }else{
                echo "error: can't update ,".$con->error.", please contact jaroonwit - sku  ".$sku;
        }


?>