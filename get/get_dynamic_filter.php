<?php

session_start();

function datepick($attribute_code,$attribute_label,$table_name){

    $input = '

    <div class="col-md">



        <input  placeholder="'.$attribute_label.'" class="form-control form-control-sm" attribute_type="date" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onfocusout="getFilterInputValues()">

    </div>

    <script>

        var picker = new easepick.create({

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

function text($attribute_code,$attribute_label,$table_name){

    $input = '

    <div class="col-md">



        <input placeholder="'.$attribute_label.'" type="text" class="form-control form-control-sm" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">



    </div>

    ';



    return $input;

}

function number($attribute_code,$attribute_label,$table_name){

    $input = '

    <div class="col-md">



        <input placeholder="'.$attribute_label.'" type="number" class="form-control form-control-sm" attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">

    </div>

    ';



    return $input;

}



function simple_select($attribute_code,$attribute_label,$type,$table_name){

    $current_value = "";

    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    $query_op = "SELECT * FROM all_in_one_project.job_attribute_option

    WHERE attribute_code = '".$attribute_code."' and attribute_table = '".$table_name."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));

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

    <div class="col-md">



        <select placeholder="'.$attribute_label.'" '.$type.' attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">

        '.$option_element.'

        </select>



    </div>

    <script>

    new SlimSelect({

      select: "#filter_'.$attribute_code.'",

      settings: {

        placeholderText: "'.$attribute_label.'",

        maxValuesShown: 1,

        maxValuesMessage: "{number} selected",

        allowDeselect: true,

        closeOnSelect: false

      }

    })

    </script>

    ';



    return $input;

}

function username($attribute_code,$attribute_label,$type,$table_name){

    $current_value = "";

    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    $query_op = "SELECT * FROM all_in_one_project.account ORDER BY id ASC" or die("Error:" . mysqli_error($con));

    $result_op = mysqli_query($con, $query_op);

    $i=0;

    $option_element .= "<option value=''></option>";

    $option_element .= "<option value='unassign'>Unassign</option>";

    while($option = mysqli_fetch_array($result_op)) {

        $option_element .= "<option value='".$option["username"]."'>".$option["username"]."</option>";

    }

    $input = '

    <div class="col-md">



        <select placeholder="'.$attribute_label.'" '.$type.' attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">

        '.$option_element.'

        </select>



    </div>

    <script>

    new SlimSelect({

      select: "#filter_'.$attribute_code.'",

      settings: {

        placeholderText: "'.$attribute_label.'",

        maxValuesShown: 1,

        maxValuesMessage: "{number} selected",

        allowDeselect: true

      }

    })

    </script>

    ';



    return $input;

}

function nickname($attribute_code,$attribute_label,$type,$table_name){

    $current_value = "";

    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    $query_op = "SELECT * FROM all_in_one_project.account ORDER BY id ASC" or die("Error:" . mysqli_error($con));

    $result_op = mysqli_query($con, $query_op);

    $i=0;

    $option_element .= "<option value=''></option>";

    while($option = mysqli_fetch_array($result_op)) {

        $option_element .= "<option value='".$option["nickname"]."'>".$option["nickname"]."</option>";

    }

    $input = '

    <div class="col-md">



        <select placeholder="'.$attribute_label.'" '.$type.' attribute_code="'.$attribute_code.'" id="filter_'.$attribute_code.'" onchange="getFilterInputValues()">

        '.$option_element.'

        </select>



    </div>

    <script>

    new SlimSelect({

      select: "#filter_'.$attribute_code.'",

      settings: {

        placeholderText: "'.$attribute_label.'",

        maxValuesShown: 1,

        maxValuesMessage: "{number} selected",

        allowDeselect: true

      }

    })

    </script>

    ';



    return $input;

}







$dynamic_filter = $_POST['dynamic_filter'];

$table_name = $_POST['table_name'];

$filter_where =  $dynamic_filter;

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

$query = "SELECT * FROM all_in_one_project.job_attribute where table_name = '".$table_name ."' and attribute_code in (".$filter_where.")" or die("Error:" . mysqli_error($con));

$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {

    if($row['attribute_type']=='single_select'){

       echo  simple_select($row['attribute_code'],$row['attribute_label'],'multiple',$table_name);

    }elseif($row['attribute_type']=='multiselect'){

        echo simple_select($row['attribute_code'],$row['attribute_label'],'multiple',$table_name);

    }elseif($row['attribute_type']=='number'){

       echo  number($row['attribute_code'],$row['attribute_label'],$table_name);

    }elseif($row['attribute_type']=='datetime'){

        echo datepick($row['attribute_code'],$row['attribute_label'],$table_name);

    }elseif($row['attribute_type']=='date'){

        echo datepick($row['attribute_code'],$row['attribute_label'],$table_name);

    }elseif($row['attribute_type']=='username'){

        echo username($row['attribute_code'],$row['attribute_label'],'multiple',$table_name);

    }elseif($row['attribute_type']=='nickname'){

        echo nickname($row['attribute_code'],$row['attribute_label'],'multiple',$table_name);

    }else{

        echo text($row['attribute_code'],$row['attribute_label'],$table_name);

    }



}

echo '

<div class="col-md">

<button type="button" class="btn btn-dark btn-sm" style="width: max-content;" onclick="getFilterInputValues()">Apply Filter</button>

</div>';





?>