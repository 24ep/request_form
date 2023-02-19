<?php
session_start();
function datepick($attribute_code,$attribute_label){
    $input = '
    <div class="col-md-3">
    <label for="floatingInputValue">'.$attribute_label.'</label>
        <input  class="form-control form-control-sm" attribute_type="date" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onfocusout="getFilterInputValues()">
    </div>
    <script>
        const picker = new easepick.create({
            element: "#filter_'.$attribute_code.'",
            css: [
                "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css"
            ],
            zIndex: 10,
            plugins: [
                "AmpPlugin",
                "RangePlugin"
            ],
            AmpPlugin: {
                dropdown: {
                    months: true,
                    years: true,
                    maxYear: 2500
                },
                resetButton: true,
                darkMode: false
            },
            RangePlugin: {
                delimiter: " AND ",
                  locale: {
                    one: "day",
                    other: "days",
                  },
            },
        })
    </script>
    ';

    return $input;
}
function text($attribute_code,$attribute_label){
    $input = '
    <div class="col-md-3">
    <label for="floatingInputValue">'.$attribute_label.'</label>
        <input type="text" class="form-control form-control-sm" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">

    </div>
    ';

    return $input;
}
function number($attribute_code,$attribute_label){
    $input = '
    <div class="col-md-3">
        <label for="floatingInputValue">'.$attribute_label.'</label>
        <input type="number" class="form-control form-control-sm" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">
    </div>
    ';

    return $input;
}

function simple_select($attribute_code,$attribute_label,$type){
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
    <div class="col-md-3">
    <label for="floatingInputValue">'.$attribute_label.'</label>
        <select '.$type.' attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">
        '.$option_element.'
        </select>

    </div>
    <script>
    new SlimSelect({
      select: "#filter_'.$attribute_code.'",
      settings: {
        placeholderText: ""
      }
    })
    </script>
    ';

    return $input;
}


$dynamic_filter = $_POST['dynamic_filter'];
$filter = explode(',', $dynamic_filter);
// $filter = array("brand","id","status","launch_date","production_type","dept","subdept","request_username","follow_up_by");
$filter_string = implode("','",$filter);
$filter_where =  "'".$filter_string."'";
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
$query = "SELECT * FROM u749625779_cdscontent.job_attribute where table_name = 'add_new_job' and attribute_code in (".$filter_where.")" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    if($row['attribute_type']=='single_select'){
       echo  simple_select($row['attribute_code'],$row['attribute_label'],'multiple');
    }elseif($row['attribute_type']=='multiselect'){
        echo simple_select($row['attribute_code'],$row['attribute_label'],'multiple');
    }elseif($row['attribute_type']=='number'){
       echo  number($row['attribute_code'],$row['attribute_label']);
    }elseif($row['attribute_type']=='datetime'){
        echo datepick($row['attribute_code'],$row['attribute_label']);
    }elseif($row['attribute_type']=='date'){
        echo datepick($row['attribute_code'],$row['attribute_label']);
    }else{
        echo text($row['attribute_code'],$row['attribute_label']);
    }

}


?>