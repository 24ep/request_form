<?php
 session_start();

 function getoption_return_filter_disting($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT DISTINCT ".$col." FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
// split array store
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
 function getoption_return_filter($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
// split array store
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

    function get_option_return_filter($attribute_code,$default_option,$select_type,$function){
        $option_set="";
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","content_service_gate") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT
        attribute_option.option_id as option_id,
        attribute_option.attribute_id as attribute_id,
        attribute_option.attribute_option as attribute_option,
        attribute_option.function as function,
        attribute_entity.attribute_code as attribute_code
        FROM content_service_gate.attribute_option as attribute_option
        left join content_service_gate.attribute_entity as attribute_entity
        on attribute_option.attribute_id = attribute_entity.attribute_id
        where attribute_entity.attribute_code =  '".$attribute_code."' and attribute_option.function='".$function."'
        ORDER BY option_id asc" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
            if($select_type=="multi"){
                while($row = mysqli_fetch_array($result)) {
                $array_default = explode(', ', $default_option);
                foreach($array_default as $option)
                  {
                    if($option==$row["attribute_option"]){
                        $option_set .= '<option selected value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                    }
                  }
                }
            }else{
                $option_set .= '<option value=""></option>';
                while($row = mysqli_fetch_array($result)) {
                    if($default_option==$row["attribute_option"]){
                        $option_set .= '<option selected value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                    }
                }
            }
            mysqli_close($con);
            return $option_set;

    }
    function get_option($attribute_code,$default_option,$select_type){
        $option_set="";
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","content_service_gate") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT * FROM u749625779_cdscontent.job_attribute_option where attribute_code =  '".$attribute_code."'" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
            if($select_type=="multi"){
                while($row = mysqli_fetch_array($result)) {
                $array_default = explode(', ', $default_option);
                foreach($array_default as $option)
                  {
                    if($option==$row["attribute_option_code"]){
                        $option_set .= '<option selected value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }
                  }
                }
            }else{
                $option_set .= '<option value=""></option>';
                while($row = mysqli_fetch_array($result)) {
                    if($default_option==$row["attribute_option_code"]){
                        $option_set .= '<option selected value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }
                }
            }
            mysqli_close($con);
            return $option_set;

    }
      function get_option($attribute_code,$default_option,$select_type){
        $option_set="";
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","content_service_gate") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT * FROM u749625779_cdscontent.job_attribute_option where attribute_code =  '".$attribute_code."'" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
            if($select_type=="multi"){
                while($row = mysqli_fetch_array($result)) {
                $array_default = explode(', ', $default_option);
                foreach($array_default as $option)
                  {
                    if($option==$row["attribute_option_code"]){
                        $option_set .= '<option selected value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }
                  }
                }
            }else{
                $option_set .= '<option value=""></option>';
                while($row = mysqli_fetch_array($result)) {
                    if($default_option==$row["attribute_option_code"]){
                        $option_set .= '<option selected value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
                    }else{
                        $option_set .= '<option value="'.$row["attribute_option_code"].'">'.$row["attribute_option_label"].'</option>';
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