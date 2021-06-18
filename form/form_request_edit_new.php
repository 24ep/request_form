<?php
function return_input_box($att_name,$site_element,$current_value,$code_element){
  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-6 fw-bold">'.$att_name.'</div>
    <div class="col-6">
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
function return_select_box($att_name,$site_element,$current_value,$code_element){
  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-6 fw-bold">'.$att_name.'</div>
    <div class="col-6">
      <select
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        type="'.$site_element.'"
        style="border: 0px"
      >
      </select>
    </div>
  </li>
  
  ';
  return $element;
}
function return_textarea_box($att_name,$site_element,$current_value,$code_element){
  $element = '

  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-6 fw-bold">'.$att_name.'</div>
    <div class="col-6">
      <textarea
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
      >
      </textarea>
    </div>
  </li>
  ';
  return $element;
}



if($_SESSION["username"]<>"poojaroonwit"){

?>
<table class="table caption-top" >
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
$con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
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
      $element .= return_input_box($row["attribute_label"],"text",$current_value,"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="datetime"){
      $element .= return_input_box($row["attribute_label"],"datetime-local",$current_value,"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="date"){
      $element .= return_input_box($row["attribute_label"],"date",$current_value,"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="textarea"){
      $element .= return_textarea_box($row["attribute_label"],"textarea",$current_value,"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="single_select"){
      $element .= return_select_box($row["attribute_label"],"",$current_value,"ns_edit_".$row["attribute_code"]);
    }elseif($row["site_element"]=="multi_select"){
      $element .= return_select_box($row["attribute_label"],"",$current_value,"ns_edit_".$row["attribute_code"]);
    }
  }
  echo '<ul class="list-group">';
  echo $element;
  echo '</ul>';

}?>