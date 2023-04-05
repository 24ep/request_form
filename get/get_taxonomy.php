<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$new_attribute="";

//query
$query = "
SELECT tr.* ,image_url.image_url tr FROM taxonomy_raw_demo as tr
left join taxonomy_image_url as image_url
where
(tr.in_80_sale_contribute = 'Y' or tr.in_top_200 = 'Y' or  tr.in_top_200 = 'Top 200') and
(tr.check_by is null or tr.check_by =='".$_SESSION['username']."')
order by tr.sale DESC limit 1" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {

    //product information session
    $sku = $row['sku'];
    $name_en = $row['name_en'];
    $image_url = $row['image_url'];

    $query_att = "SELECT DISTINCT  attribute_code FROM taxonomy.attribute_option;";
    $result_att = mysqli_query($con, $query_att);
    while($row_att = mysqli_fetch_array($result_att)) {
        if($row[$row_att['attribute_code']]<>Null){
            $new_attribute .= "<label>".$row_att['attribute_code']."</label>";
            $new_attribute .= "
            <select class='form-select form-select-sm id='".$row_att['attribute_code']."' >";
            $query_att_option = "SELECT DISTINCT  attribute_option FROM taxonomy.attribute_option where attribute_code='".$row_att['attribute_code']."';"
            $result_att_option = mysqli_query($con, $query_att);
            while($row_att_option = mysqli_fetch_array($result_att_option)) {
                if($row[$row_att['attribute_code']]==$row_att_option['attribute_option']){
                    $new_attribute .= "<option selected value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_option']."</option>";
                }else{
                    $new_attribute .= "<option value='".$row_att_option['attribute_option']."'>".$row_att_option['attribute_option']."</option>";
                }

            }
            $new_attribute .= "</select>";
        }
    }

}

echo $new_attribute;

//stamp name
$query = "update all_in_one_project.taxonomy_demo set
check_by = '".$_SESSION['username']."' ,
where sku = ".$sku
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);

?>

<div class="container-md">

<!-- nav bra -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1 fixed-top bg-white "><?php echo $sku;?></span>
  </div>

</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-2">Name (english)</div>
        <div class="col-10"><?php echo $name_en;?></div>
    </div>
    <div class="row">
        <div class="col-2">Description</div>
        <div class="col-10"><?php echo $description;?></div>
    </div>
    <div class="row">
        <div class="col-2">Image</div>
        <div class="col-10">
        <img src="<?php echo $image_url;?>" class="rounded float-start" >
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        <div>
        <div class="col-6">
            <?php echo $new_attribute ;?>
        <div>
    <div>
  </div>
<input type="button" value="Submit" onclick="updateSheetData(<?php echo $sku;?>, 'PASS_TEST');">
<!-- product information -->


</div>
