<?php
 session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sku = $_POST['sku'];
$element_name = $_POST['element_name'];
$new_value = $_POST['new_value'];
//select taxonomy
$query = "SELECT ".$element_name." from taxonomy.taxonomy_raw where sku='".$sku."'"
or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $old_value=$row[$element_name];
}

        //insert to complete data
        $sql = "INSERT INTO taxonomy.taxonomy_revised_record
        (sku,
        attribute_code,
        old_value,
        new_value)
        values
        (
        '".$sku."',
        '".$element_name."',
        '".$old_value."',
        '".$new_value."')"
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);
        if($query){
                echo "update completed";
        }else{
                echo "error: can't update revised record Error->".$con->error.", please contact jaroonwit - sku  ".$sku;
        }


?>