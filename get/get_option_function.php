<?php
 session_start();

 //use for pull data from record table like brand ,username
 function get_option_return_filter_disting($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT DISTINCT ".$col." FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        if($sorm=="multi"){
            if($col=="store" or $col=="itemmize_type" or $col=="product_website"){
            $array_store = explode(', ', $select_option);
            $duplicate_op = false;
            $loop_in_null = false;
            foreach($array_store as $store)
            {
                if($row[$col] <> '' ) {
                if($store==$row[$col]){
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                    $duplicate_op = true;
                }
                }
            }
            if($row[$col] <> ''){
                if($duplicate_op == false){
                $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                }
            }
            }
        }else{
            if($loop_in_null==false){
            $option_set .= '<option value=""></option>';
            $loop_in_null=true;
            }
            if($row[$col] <> '' )
            {
                if($select_option==$row[$col]){
                    if($col=="username"){
                        $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";
                    }else{
                        $op_label = $row[$col];
                    }
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$op_label.'</option>';
                }else{
                    if($col=="username"){
                        $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";
                    }else{
                        $op_label = $row[$col];
                    }
                    $option_set .= '<option value="'.$row[$col].'">'.$op_label.'</option>';
                }
            }
    }
    }
    mysqli_close($con);
    return $option_set;

    }


    function get_option_attribute_entity($att_code,$table,$current_value){
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
        $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
        WHERE attribute_code = '".$att_code."' and attribute_table = '".$table."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
        $result_op = mysqli_query($con, $query_op);
        $i=0;
        while($option = mysqli_fetch_array($result_op)) {
          if($option["attribute_option_code"]==$current_value){
              $selectd = 'selected';
          }else{
              $selectd = '';
          }
          if($option["attribute_option_code"]<>"" and $i==0){
              $i++;
              $option_element .= "<option ".$selectd ." value=''></option>";
          }
          $option_element .= "<option ".$selectd ." value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";

          }
          mysqli_close($con);
          return $option_element;
    }
?>