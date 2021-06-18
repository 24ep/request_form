<?php
$con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
function return_input_box($att_name,$site_element,$current_value,$code_element){
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-5 fw-bold">'.$att_name.'</div>
    <div class="col-7">
      <input
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        type="'.$site_element.'"
        style="border: 0px"
        value="'.$current_value.'"
      />
    </div>
  </li>
  ';
  return $element;
}
function return_select_box($att_name,$site_element,$current_value,$code_element,$attr_id){
  
  if($code_element=="multi_select"){

  }elseif($code_element=="single_select"){
    $query_op = "SELECT * FROM content_service_gate.attribute_option
    WHERE attribute_id = ".$attr_id." ORDER BY option_id ASC" or die("Error:" . mysqli_error());
    $result_op = mysqli_query($con, $query_op);
    while($option = mysqli_fetch_array($result_op)) {
    if($option["attribute_option"]==$current_value){
        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }else{
        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }
    }
  }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-5 fw-bold">'.$att_name.'</div>
    <div class="col-7">
      <select
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        type="'.$site_element.'"
        style="border: 0px"
      >
      '.$option_element.'
      </select>
    </div>
  </li>
  ';
  return $element;
}
function return_textarea_box($att_name,$site_element,$current_value,$code_element){
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-5 fw-bold">'.$att_name.'</div>
    <div class="col-7">
      <textarea
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
      >'.$current_value.'
      </textarea>
    </div>
  </li>
  ';
  return $element;
}
if($_SESSION["username"]<>"poojaroonwit"){
?>
<table class="table caption-top">
    <thead>
        <tr>
            <th scope="col">Topic</th>
            <th scope="col">Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Department</th>
            <td><?php echo $department;?></td>
        </tr>
        <tr>
            <th scope="row">Brand</th>
            <td><?php echo $brand;?></td>
        </tr>
        <tr>
            <th scope="row">SKU</th>
            <td><?php echo $sku;?></td>
        </tr>
        <tr>
            <th scope="row">Production type</th>
            <td><?php echo $production_type;?></td>
        </tr>
        <tr>
            <th scope="row">Business type</th>
            <td><?php echo $business_type;?></td>
        </tr>
        <tr>
            <th scope="row">Project type</th>
            <td><?php echo $project_type;?></td>
        </tr>
        <tr>
            <th scope="row">Launch date</th>
            <td><?php echo $launch_date;?></td>
        </tr>
        <tr>
            <th scope="row">Store</th>
            <td><?php echo $stock_source;?></td>
        </tr>
        <tr>
            <th scope="row">Business unit</th>
            <td><?php echo $bu;?></td>
        </tr>
        <tr>
            <th scope="row">Online chanel </th>
            <td><?php echo $online_channel;?></td>
        </tr>
        <tr>
            <th scope="row">Contact Buyer </th>
            <td><?php echo $contact_buyer;?></td>
        </tr>
        <tr>
            <th scope="row">Contact Vender</th>
            <td><?php echo htmlspecialchars($contact_vender, ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <th scope="row">Link for information</th>
            <td><?php echo $link_info;?></td>
        </tr>
        <tr>
            <th scope="row">Remark</th>
            <td><?php echo $remark;?></td>
        </tr>
    </tbody>
</table>
<?php }else{

$query = "SELECT * FROM content_service_gate.attribute_entity
          WHERE allow_display = 1 and attribute_function = 'add_new'  ORDER BY attribute_id ASC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //--
    // if($row["attribute_code"]=="brand"){$current_value==$brand;}
    // elseif($row["attribute_code"]=="department"){$current_value==$department;}
    // elseif($row["attribute_code"]=="sku"){$current_value==$sku;}
    // elseif($row["attribute_code"]=="product"){$current_value==$department;}
    //---
    if($row["site_element"]=="number"){
        $element .= return_input_box($row["attribute_label"],"number",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="text"){
      $element .= return_input_box($row["attribute_label"],"text",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="datetime"){
      $element .= return_input_box($row["attribute_label"],"datetime-local",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="date"){
      $element .= return_input_box($row["attribute_label"],"date",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="textarea"){
      $element .= return_textarea_box($row["attribute_label"],"textarea",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="single_select"){
      $element .= return_select_box($row["attribute_label"],"",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"]);
    }elseif($row["site_element"]=="multi_select"){
      $element .= return_select_box($row["attribute_label"],"",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"]);
    }
  }
  echo '<ul class="list-group">';
  echo $element;
  echo '</ul>';
}?>