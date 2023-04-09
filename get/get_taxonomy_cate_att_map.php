<?php
session_start();
$selected_categories = $_POST['cate_value'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$select_attribute =array();


$query = "SELECT backend_cate_code , require_attribute
          FROM taxonomy.categories_attribute_rule_mapping";
          $result = mysqli_query($con, $query);
          $new_cate_array = explode(",",  $selected_categories);
          while($row = mysqli_fetch_array($result)) {
            if(in_array($row["backend_cate_code"],$new_cate_array)){
                array_push($select_attribute,$row["require_attribute"]);
            }
        }
 $selected_attribute_string =  implode(",",array_filter(array_unique($select_attribute)));
 echo $selected_attribute_string;

?>