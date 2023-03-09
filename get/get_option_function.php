<?php
 session_start();

 //use for pull data from record table like brand ,username
 function get_option_return_filter_disting($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT DISTINCT ".$col." FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $option_set .= '<option value=""></option>';
    while($row = mysqli_fetch_array($result)) {
        if($select_option==$row[$col]){
            $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
        }else{
            $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
        }

    }
    mysqli_close($con);
    return $option_set;

    }

function get_origin_of_ticket($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT  origin,description FROM $table ORDER BY id asc" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $option_set .= '<option value=""></option>';
    while($row = mysqli_fetch_array($result)) {
        if($select_option==$row[$col]){
            $option_set .= '<option value="'.$row['origin'].'" selected
            data-html="<div class=&#39;origin_block_in&#39;><strong>'.$row['origin'].'</strong><br>'.$row['description'].'<br><a onclick="table_detail_page('.$row['id'].',&#39;'.$row['system_related'].'&#39;,&#39;origin_of_ticket&#39;,&#39;update&#39;)">SEE MORE</a></div>">'.$row[$col].'</option>';
        }else{
            $option_set .= '<option value="'.$row['origin'].'"
            data-html="<div class=&#39;origin_block_in&#39;><strong>'.$row['origin'].'</strong><br>'.$row['description'].'<br><a onclick="table_detail_page('.$row['id'].',&#39;'.$row['system_related'].'&#39;,&#39;origin_of_ticket&#39;,&#39;update&#39;)">SEE MORE</a></div>">'.$row[$col].'</option>';
        }
 
    }
    mysqli_close($con);
    return $option_set;

    }

    function get_username($select_option) {
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT DISTINCT * FROM account ORDER BY id asc" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        $option_set .= '<option value=""></option>';
        while($row = mysqli_fetch_array($result)) {
            if($select_option==$row['username']){
                $option_set .= '<option value="'.$row['username'].'" selected>'.$row['nickname'].' - '.$row['firstname'].' '. substr($row['lastname'],0,2).'. </option>';
            }else{
                $option_set .= '<option value="'.$row['username'].'" >'.$row['nickname'].' - '.$row['firstname'].' '. substr($row['lastname'],0,2).'. </option>';
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
    function get_option_attribute_entity_with_filter($attr_code,$current_value,$table,$key){
        session_start();
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
          $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
          WHERE attribute_code = '".$attr_code."' and attribute_table = '".$table."' and attribute_option_code like '%".$key."%' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
          $result_op = mysqli_query($con, $query_op);
          if($current_value==""){
            $option_element = "<option selected value=''></option>";
          }
          while($option = mysqli_fetch_array($result_op)) {
            if($option["attribute_option_code"]==$current_value){
                $option_element .= "<option selected value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
              }else{
                $option_element .= "<option value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
              }
          }
        return $option_element;
      }
?>