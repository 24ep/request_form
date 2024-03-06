

<?php

 session_start();

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

function return_input_box($att_name,$site_element,$current_value,$code_element,$enable_edit,$id){

  if($site_element=='datetime-local'){

    $current_value = str_replace(" ","T",$current_value);

  }

  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">

    <div class="col-3 fw-bold">'.$att_name.'</div>

    <div class="col-9">

      <input

        class="form-control form-control-sm"

        id="'.$code_element.'"
all_in_one_project
        name="'.$code_element.'"

        type="'.$site_element.'"

        style="border: 0px"

        value="'.$current_value.'"

        '.$enable_edit.'

        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"

      />

    </div>

  </li>

  ';

  return $element;

}

function return_s_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit,$id){

  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    $query_op = "SELECT * FROM all_in_one_project.attribute_option

    WHERE attribute_id = ".$attr_id." and function = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));

    $result_op = mysqli_query($all_in_one_project

    while($option = mysqli_fetch_array($result_op)) {

    if($option["attribute_option"]==$current_value){

        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";

      }else{

        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";

      }

    }

  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">

    <div class="col-3 fw-bold">'.$att_name.'</div>

    <div class="col-9">

      <select

        class="form-select form-select-sm"

        id="'.$code_element.'"

        name="'.$code_element.'"

        style="border: 0px"

        '.$enable_edit.'

        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"

      >

      '.$option_element.'

      </select>

    </div>

  </li>

  ';


all_in_one_project
  unset($option_element);

  return $element;

}

function return_m_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit,$id){

  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

    $query_op = "SELECT * FROM all_in_one_project.attribute_option

    WHERE attribute_id = ".$attr_id." and function = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));

    $result_op = mysqli_query($con, $query_op);

    while($option = mysqli_fetch_array($result_op)) {

    if(strpos($current_value ,$option["attribute_option"])!==false){

        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";

      }else{

        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";

      }

    }

  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">

    <div class="col-3 fw-bold">'.$att_name.'</div>

    <div class="col-9">

      <select

        multiple="multiple"

        class="form-select"

        id="'.$code_element.'"

        name="'.$code_element.'"

        style="border: 0px"

        '.$enable_edit.'

        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"

      >

      '.$option_element.'

      </select>

    </div>

  </li>

  ';

  unset($option_element);

  return $element;

}

function return_textarea_box($att_name,$site_element,$current_value,$code_element,$enable_edit,$id){

  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">

    <div class="col-3 fw-bold">'.$att_name.'</div>

    <div class="col-9">

      <textarea

        class="form-control"

        id="'.$code_element.'"

        name="'.$code_element.'"

        style="border: 0px"

        rows="4"

        '.$enable_edit.'

        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"

      >'.$current_value.'

      </textarea>

    </div>

  </li>

  ';

  return $element;

}

$query = "SELECT * FROM all_in_one_project.attribute_entity

          WHERE allow_display = 1 and attribute_function = 'add_new'  ORDER BY attribute_id ASC" or die("Error:" . mysqli_error($con));

$result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {

    //--

    if(strpos($_SESSION["department"],"Content")!==false){

        if($row["allow_in_edit"]==1){

          $allow_edit = "";

        }else{

          $allow_edit = "disabled";

        }



    }else{

      if($row["allow_ex_edit"]==1){

        //check assign name

        if($follow_assign_name == "unassign"){

          $allow_edit = "";

        }else{

          $allow_edit = "disabled";

        }

      }else{

        $allow_edit = "disabled";

      }

    }

    //---

    if($row["site_element"]=="number"){

        $element .= return_input_box($row["attribute_label"],"number",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);

    }elseif($row["site_element"]=="text"){

      $element .= return_input_box($row["attribute_label"],"text",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);

    }elseif($row["site_element"]=="datetime"){

      $element .= return_input_box($row["attribute_label"],"datetime-local",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);

    }elseif($row["site_element"]=="date"){

      $element .= return_input_box($row["attribute_label"],"date",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);

    }elseif($row["site_element"]=="textarea"){

      $element .= return_textarea_box($row["attribute_label"],"textarea",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);

    }elseif($row["site_element"]=="single_select"){

      $element .= return_s_select_box($row["attribute_label"],"single_select",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit,$id);

    }elseif($row["site_element"]=="multi_select"){

      $element .= return_m_select_box($row["attribute_label"],"multi_select",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit,$id);

    }

  }

  echo '<div id="call_update_ns_complete"></div>';

  echo '<ul class="list-group shadow ns_detail_list">';

  echo $element;

  echo '</ul>';

?>

<script>

function update_ns_detail(id, id_name) {

    var id_name = id_name;

    var value_change = document.getElementById(id_name).value;

    if (id) {

        $.post("/action/action_update_ns_detail.php", {

                id: id,

                value_change: value_change,

                id_name: id_name

            },

            function(data) {

                $('#call_update_ns_complete').html(data);

            });

    }

}

</script>