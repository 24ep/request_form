<?php
  $sku_list= $_POST['sku_list'];
  trim($sku_list," ");
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $sku_list_ex = explode("\n", $sku_list);
  $sku_list_array = array();
    foreach ( $sku_list_ex as $sku ) {
        if($sku <> '' and $sku <> null){
            array_push($sku_list_array,"'".trim($sku," ")."'");
        }        
    }
        $sku_list = implode(',',$sku_list_array);
    
        $query = "SELECT 
        sl.sku as sku,
        sl.csg_id as csg_id, 
        case when itm.id is not null then 'in itm list'
        else '' end as check_itm_list,
        count_sku.count_sku as sku_tied_with_ticket,
        anj.status as status
        FROM all_in_one_project.sku_list as sl 
        left join all_in_one_project.itm_datalake itm
        on sl.sku = itm.pid 
        left join all_in_one_project.add_new_job anj 
        on sl.csg_id = anj.id 
        left join (select csg_id,count(sku) as count_sku from all_in_one_project.sku_list group by csg_id) as count_sku
        on sl.csg_id = count_sku.csg_id  
        where sl.sku in (".$sku_list .") ORDER BY sl.id DESC " or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        $sku_item_check = " ";
        $i=0;
        while($row = mysqli_fetch_array($result)) {
     
            $sku_item_check .= "<tr>
            <td>".$row["sku"]."</td>
            <td>".$row["csg_id"]."</td>
            <td>".$row["status"]."</td>
            <td>".$row["sku_tied_with_ticket"]."</td>
            <td>".$row["check_itm_list"]."</td>
            </tr>";
            $i++;

        }

        if($sku_item_check == " "){
            
            echo '<div class="alert alert-success" role="alert">
                        ตรวจไม่พบ sku ที่ซ้ำบนระบบ service-gate
                  </div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">
            ตรวจจพบ sku ด้านล่าง ซ้ำในฐานข้องมูลของ <strong>SERVICE-GATE จำนวน '.$i.' sku <br>
            เมื่อยืนยัน accept ระบบจะเปลี่ยน ให้ sku เหล่านั้นเป็น sku ของ ticket ที่กด accept</strong>\n
            <table class="table">
            <thead>
                <tr>
                <th scope="col">sku</th>
                <th scope="col">csg_id</th>
                <th scope="col">status</th>
                <th scope="col">sku tied with ticket</th>
                <th scope="col">check itemize list</th>
                </tr>
            </thead>
            <tbody>';
            echo $sku_item_check;
            echo ' </tbody>
            </table>
            </div>';
        }
        echo '<strong>ปล.การตรวจสอบกับฐานข้อมูล MDC ยังทำไม่เสร็จ</strong>';
        echo '<hr>';

        // $get_atena_checking = escapeshellcmd("action_sku_checking_mdc_atena.py $sku_list ");
        // $resultAsString = shell_exec($command);
        // echo $resultAsString;

?>