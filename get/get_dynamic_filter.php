<?php
function text($attribute_code,$attribute_label){
    $input = '
    <div class="form-floating col-md-4">
        <input type="text" class="form-control" id="filter_'.$attribute_code.'">
        <label for="floatingInputValue">'.$attribute_label.'</label>
    </div>
    ';

    return $input;
}


$filter = array("brand","id","status","accepted_date","producti");
$filter_string = implode("','",$filter);
$filter_where =  "'".$filter_string."'";
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
$query = "SELECT * FROM u749625779_cdscontent.job_attribute where table_name = 'add_new_job' and attribute_code in (".$filter_where.")" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo text($row['attribute_code'],$row['attribute_label']);
}


?>