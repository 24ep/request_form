<?php
function text($attribute_code,$attribute_label){
    $input = '
    <div class="form-floating col-md-4">
        <input type="text" class="form-control" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">
        <label for="floatingInputValue">'.$attribute_label.'</label>
    </div>
    ';

    return $input;
}
function number($attribute_code,$attribute_label){
    $input = '
    <div class="form-floating col-md-4">
        <input type="number" class="form-control" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">
        <label for="floatingInputValue">'.$attribute_label.'</label>
    </div>
    ';

    return $input;
}

function simple_select($attribute_code,$attribute_label){
    $current_value = "";
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
    WHERE attribute_code = '".$attribute_code."' and attribute_table = 'add_new_job' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
    $result_op = mysqli_query($con, $query_op);
    $i=0;
    while($option = mysqli_fetch_array($result_op)) {
        if($option["attribute_option_code"]==$current_value){
        $selected = 'selected';
        }else{
        $selected = '';
        }
        if($option["attribute_option_code"]<>"" and $i==0){
        $i++;
        $option_element .= "<option ".$selected ." value=''></option>";
        }
        $option_element .= "<option ".$selected ." value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
    }
    $input = '
    <div class="form-floating col-md-4">
        <select class="form-select" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">
        '.$option_element.'
        </select>
        <label for="floatingInputValue">'.$attribute_label.'</label>
    </div>
    ';

    return $input;
}


$filter = array("brand","id","status","accepted_date","production_type");
$filter_string = implode("','",$filter);
$filter_where =  "'".$filter_string."'";
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
$query = "SELECT * FROM u749625779_cdscontent.job_attribute where table_name = 'add_new_job' and attribute_code in (".$filter_where.")" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    if($row['attribute_type']=='single_select'){
       echo  simple_select($row['attribute_code'],$row['attribute_label']);
    }elseif($row['attribute_type']=='number'){
       echo  number($row['attribute_code'],$row['attribute_label']);
    }else{
        echo text($row['attribute_code'],$row['attribute_label']);
    }

}


?>