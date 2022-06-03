<?php
 session_start();
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
  FROM sku_list as sl left join itm_datalake as itm on itm.pid = sl.sku   where sl.csg_id = ".$id." ORDER BY sl.id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
    echo 
    "<p>
    <a href='#' id='download_link' class='btn btn-sm btn-primary' onClick='javascript:ExcelReport();''>Export</a>
    </p>";

  
   
    echo "<table class='table table-bordered' id='sku_list_export'>
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

  <!-- เรียกใช้ javascript สำหรับ export ไฟล์ excel  -->
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"  ></script>
<script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"  ></script>

<script>
function ExcelReport()//function สำหรับสร้าง ไฟล์ excel จากตาราง
{
    var sheet_name="excel_sheet";/* กำหหนดชื่อ sheet ให้กับ excel โดยต้องไม่เกิน 31 ตัวอักษร */
    var elt = document.getElementById('sku_list_export');/*กำหนดสร้างไฟล์ excel จาก table element ที่มี id ชื่อว่า myTable*/

    /*------สร้างไฟล์ excel------*/
    var wb = XLSX.utils.table_to_book(elt, {sheet: sheet_name});
    XLSX.writeFile(wb,'export.xlsx');//Download ไฟล์ excel จากตาราง html โดยใช้ชื่อว่า report.xlsx
}
</script>
