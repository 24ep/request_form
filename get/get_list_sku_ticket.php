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
  echo '<!-- Modal -->
  <div class="modal fade" id="ns_insertsku" tabindex="-1" aria-labelledby="ns_insertskuLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content shadow rounded">
        <div class="modal-header">
          <h5 class="modal-title" id="ns_insertskuLabel"><ion-icon name="server-outline"></ion-icon>Check and insert SKU list</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
        <div class="col-6">
          <small>Ticket BU : '.$bu.'</small>
          <textarea style="font-size:12px" oninput="sku_checking()" class="form-control mt-2"
          id="sku_checking" name="sku_accepted"
          placeholder="ตรวจสอบ IBC ตามตัวอย่างด้านล่าง วางตามตัวอย่างด้านล่าง&#10;&#10;3466644&#10;2443356&#10;2487356"
          rows="20" style="height: 300px"></textarea>
        </div>
        <div class="col-6">
        <small>Message log</small>
              <div id="sku_checking_result"></div>
              <div id="sku_checking_result_force"></div>
        </div>
        </div>
    
        <input type="hidden" id="result_checking_sku" name="result_checking_sku"
         value="">
        <div class="modal-footer">
          <button type="button" style="margin-top:10px"
          onclick="force_sync_with_ticket('.$id.',&#34;'.$bu.'&#34;)"
          class="btn btn-danger bg-gradient  shadow-sm">ยืนยัน เชื่อมต่อ sku ด้านบนกับ ticket NS-
          '.$id.'</button>
        </div>
      </div>
    </div>
  </div>';
    echo 
    "<p>
    <a href='#' id='download_link' style='text-decoration: none' class='badge bg-dark bg-gradient shadow-sm mt-2 p-1 pe-3 me-2' onClick='javascript:ExcelReport();''>
    <ion-icon name='download-outline'></ion-icon>Export</a>
    <a href='#' id='download_link'  style='text-decoration: none' class='badge bg-primary bg-gradient shadow-sm mt-2 p-1 pe-3 me-2' data-bs-toggle='modal' data-bs-target='#ns_insertsku'>
    <ion-icon name='push-outline'></ion-icon>Check & Insert SKUs</a>
    </p>";

  
   
    echo "<table class='table table-bordered' id='sku_list_export'>
        <thead>
            <tr>";
    echo "<th scope='row'>sku</th></th>";  
    echo "<th style='display:none;' scope='row'>itm_jda</th></th>";  
    echo "<th style='display:none;' scope='row'>itm_sbc</th></th>";  
    echo "<th style='display:none;'  scope='row'>tm_dept</th></th>";  
    echo "<th style='display:none;'>itm_sdept</th>";
    echo "<th style='display:none;'>itm_name</th>";
    echo "<th style='display:none;'>itm_catalogue</th>";
    echo "<th style='display:none;'>itm_vendor</th>";
    echo "<th style='display:none;'>itm_vendornm</th>";
    echo "<th style='display:none;'>itm_retail</th>";
    echo "<th >create_by</th>";  
    echo "<th>create_date</th>";  
    echo  "</tr>
    </thead>
     <tbody>";
     while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>".$row["sku"]."</th>";
       echo "<td style='background: #ededed;display:none;'>".$row["jda"]."</td>"; 
       echo "<td style='background: #ededed;display:none;'>".$row["sbc"]."</td>"; 
       echo "<td style='background: #ededed;display:none;'>".$row["department"]."</td>"; 
       echo "<td style='background: #ededed;display:none;'>".$row["sub_department"]."</td>"; 
        echo "<td style='background: #ededed;display:none;'>".$row["product_name"]."</td>"; 
       echo "<td style='background: #ededed;display:none;'>".$row["catalogue"]."</td>"; 
        echo "<td style='background: #ededed;display:none;'>".$row["vendor"]."</td>"; 
        echo "<td style='background: #ededed;display:none;'>".$row["vendornm"]."</td>"; 
        echo "<td style='background: #ededed;display:none;'>".$row["retail"]."</td>"; 
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
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"></script>

<script>
function ExcelReport() //function สำหรับสร้าง ไฟล์ excel จากตาราง
{
    var sheet_name = "excel_sheet"; /* กำหหนดชื่อ sheet ให้กับ excel โดยต้องไม่เกิน 31 ตัวอักษร */
    var elt = document.getElementById(
    'sku_list_export'); /*กำหนดสร้างไฟล์ excel จาก table element ที่มี id ชื่อว่า myTable*/

    /*------สร้างไฟล์ excel------*/
    var wb = XLSX.utils.table_to_book(elt, {
        sheet: sheet_name
    });
    XLSX.writeFile(wb, 'export.xlsx'); //Download ไฟล์ excel จากตาราง html โดยใช้ชื่อว่า report.xlsx
}
</script>