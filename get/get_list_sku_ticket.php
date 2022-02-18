<?php
if(isset($_GET['act'])){
	if($_GET['act']== 'excel'){
		// header("Content-Type: application/xls");
		// header("Content-Disposition: attachment; filename=export.xlsx");
		// header("Pragma: no-cache");
		// header("Expires: 0");
    $file = "export_NS_".$_GET['id']."xlsx";
    header('Content-disposition: attachment; filename='.$file);
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($file));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
	}
}
if($_GET['id']<>""){
$id = $_GET['id'];
}
if($_POST['id']<>""){
  $id = $_POST['id'];
  }

  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT sl.sku,sl.create_by,sl.create_date,itm.jda,itm.sbc,itm.department,itm.sub_department,itm.product_name,itm.catalogue,itm.vendor,itm.vendornm,itm.retail 
  FROM sku_list as sl left join itm_datalake as itm on itm.pid = sl.sku   where sl.csg_id = ".$id." ORDER BY sl.id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  if($_SESSION["username"]="poojaroonwit"){
    echo 
    '<p>
						<a href="base/get/get_list_sku_ticket.php?act=excel&id='.$id.'" class="btn btn-primary"> Export->Excel </a>
		</p>';
  }
   
    echo "<table class='table table-bordered'>
        <thead>
            <tr>";
    echo "<th scope='row'>sku</th></th>";  
    echo "<th scope='row'>itm_jda</th></th>";  
    echo "<th scope='row'>itm_sbc</th></th>";  
    echo "<th scope='row'>tm_dept</th></th>";  
    echo "<th>itm_sdept</th>";
    echo "<th>itm_name</th>";
    echo "<th>itm_catalogue</th>";
    echo "<th>itm_vendor</th>";
    echo "<th>itm_vendornm</th>";
    echo "<th>itm_retail</th>";
    echo "<th>create_by</th>";  
    echo "<th>create_date</th>";  
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["sku"]."</th>";
       echo "<td style='background: #ededed;'>".$row["jda"]."</td>"; 
       echo "<td style='background: #ededed;'>".$row["sbc"]."</td>"; 
       echo "<td style='background: #ededed;'>".$row["department"]."</td>"; 
       echo "<td style='background: #ededed;'>".$row["sub_department"]."</td>"; 
        echo "<td style='background: #ededed;'>".$row["product_name"]."</td>"; 
       echo "<td style='background: #ededed;'>".$row["catalogue"]."</td>"; 
        echo "<td style='background: #ededed;'>".$row["vendor"]."</td>"; 
        echo "<td style='background: #ededed;'>".$row["vendornm"]."</td>"; 
        echo "<td style='background: #ededed;'>".$row["retail"]."</td>"; 
        echo "<td style='background: #ededed;'>".$row["create_by"]."</td>";  
        echo "<td style='background: #ededed;'>".$row["create_date"]."</td>";
        echo "</tr>";
        $pass = true;
    } 
    if($pass==false){
        echo "<tr>";
        echo "<td colspan='7' style='text-align: center;'>ไม่พบ sku สำหรับ ticket ดังกล่าวในฐานข้อมูล</td>";
        echo  "</tr>";
      }
  echo "</tbody>
  </table>";
  mysqli_close($con);
  ?>
