<?php
session_start();
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error( $con));
function badge_status($status){
    if($status=="pending"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-pending" style="min-width: 115px;">pending</span>';
    }elseif($status=="checking"  ){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-checking" style="min-width: 115px;">checking</span>';
    }elseif( $status=="on-productions"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-on-productions" style="min-width: 115px;">on-productions</button>';
    }elseif($status=="approved"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-approved" style="min-width: 115px;">approved</button>';
    }elseif($status=="waiting confirm"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-confirm" style="min-width: 115px;">waiting confirm</span>';
    }elseif($status=="waiting image"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-image" style="min-width: 115px;">waiting image</button>';
    }elseif($status=="waiting data"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-data" style="min-width: 115px;">waiting data</button>';
    }elseif($status=="waiting traffic"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-traffic" style="min-width: 115px;">waiting traffic</button>';
    }elseif($status=="cancel"){
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-cancel" style="min-width: 115px;">Cancel</button>';
    }else{
        $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-other" style="min-width: 115px;">'.$status.'</span>';
    }
    return $status;
}
function display_launch_date($launch_date){
    //launch date
    if($launch_date<>""){
        $launch_date = date('d/m/y',strtotime($launch_date));
    }else{
        $launch_date = "<span style='color:#E0E0E0'>No launch date</span>";
    }
    return $launch_date;
}

function alert_badge($create_date,$launch_date,$status,$config_type){
    //priority_badge
    $current_day = date("Y-m-d");
    $p_badge="";
    $create_date = date_create($create_date);
    $create_date = date_format($create_date,"Y-m-d");
    // -1 create date > 5
    $create_date_diff = (strtotime($current_day) - strtotime($create_date))/  ( 60 * 60 * 24 );
    if($create_date_diff>=10){
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-red"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
    }elseif($create_date_diff>=3){
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-purple"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
    }
    //  launch date
    if($launch_date <> null){
        $launch_date_c = date_create($launch_date);
        $launch_date_c = date_format($launch_date_c,"Y-m-d");
        $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
        if($launch_date_diff<=0){
            $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 normal-badge-red" ><ion-icon name="warning-outline" style="margin: 0;"></ion-icon> Over Launch '.($launch_date_diff*(-1)).' days</span>';
        }elseif($launch_date_diff<=5){
            $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-purple" ><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Launch in '.$launch_date_diff.' days</span>';
        }
    }
    // except badge display for status below
    if(strpos($status,"approved")!==false or strpos($status,"Cancel")!==false  or $config_type=='parent' ){
        $p_badge = "";
    }
    return $p_badge;
}
function gen_cancel_style($status){
    $style_cancel = "";
    if($status=="cancel"){
        $style_cancel =  "style_cancel";
    }else{
        $style_cancel = "";
    }
    return $style_cancel;
}
$start_item =  ($_POST['pagenation_input'] -1 )* 30;
$filter = $_POST['outputValues'];

if($filter==''){
    $filter='1=1';
}
//count item

$query = "SELECT count(*) as count_item FROM add_new_job as anj where (".$filter.") ORDER BY anj.id DESC LIMIT 30 OFFSET "
or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $count_item = $row['count_item'];
}
echo '<small>Result found : '.$count_item .'</small>';
$page_count = $count_item / 30;
?>
<script>document.getElementById('total_page_nj').innerHTML = "<?php echo ceil($page_count); ?>" </script>

<?php
//get list

$query = "SELECT * FROM add_new_job as anj where ((".$filter.")
 and anj.parent is null ) or config_type = 'parent' ORDER BY anj.id DESC LIMIT 30 OFFSET ".$start_item
or die("Error:" . mysqli_error($con));
echo $query;
date_default_timezone_set("Asia/Bangkok");
mysqli_query($con, "SET NAMES 'utf8' ");
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {

    //config_type
    if($row["config_type"]=="parent"){
        //set style
        $tr_class = "class='row sub-ticket shadow-sm p-2 mb-0 rounded ".$style_cancel."' style='background: white;align-items: center;text-align-last: center;'";
        $task_status = '';
        $query_sum="SELECT sum(sku) as total from add_new_job where parent = ".$row["id"];
        $result_sum = mysqli_query($con, $query_sum);
        $data_sum=mysqli_fetch_assoc($result_sum);
        //show warning for parent !=sum of sub ticket sku
        if($row["sku"]<>$data_sum['total']){
            $badge_alert_sku = "<a data-bs-toggle='tooltip' data-bs-placement='top' title='number of sku in parent ticket not equls sum of childs ticket sku'><ion-icon name='alert-circle-outline' style='color:red!important'  ></ion-icon></a>";
        }else{
            $badge_alert_sku = "";
        }
        $subtask_sum = $row["sku"]." S(".$data_sum['total'].") ".$badge_alert_sku ;
    }else{
        $tr_class = "class='row shadow-sm p-2 mb-2 rounded ".$style_cancel."' style='background: white;align-items: center;text-align-last: center;'";
        $task_status = badge_status($row["status"]) ;
        $subtask_sum = $row["sku"];
    }

    $p_badge = alert_badge($row['create_date'],$row['launch_date'],$row["status"],$row["config_type"]);
    $style_cancel =  gen_cancel_style($row['status']);

    if(!isset($ticket)){$ticket="";}
    if(!isset($tr_class)){$tr_class="";}
    $ticket .= "<li  ".$tr_class." >";
    $ticket .= "<div scope='row' class='col new_lob_list' ><strong>NS-".$row["id"]."</strong></div>";
    $ticket .= "<div class='col'>".$row["department"]."</div>";
    $ticket .= "<div class='col'>".$row["brand"]."</div>";
    $ticket .= "<div class='col'>".$subtask_sum."</div>";
    $ticket .= "<div class='col'>".$row["production_type"]."</div>";
    $ticket .= "<div class='col'>".display_launch_date($row["launch_date"])."</div>";
    $ticket .= "<div class='col' style='min-width: 160px;'>".$p_badge."</div>";
    $ticket .= "<div class='col' style='min-width: 140px;'>".$task_status."</div>";
    $ticket .= "<div class='col'>";
    $ticket .= "<button type='button' id='ns_ticket_".$row['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3'  onclick='call_edit_add_new_modal(".$row["id"].")' >
    Detail </button></div>";
    $ticket .=  "</li>";
    //get sub ticket
    $query_count="SELECT count(*) as total from add_new_job where parent = ".$row["id"];
    $result_count = mysqli_query($con, $query_count);
    $data_count=mysqli_fetch_assoc($result_count);
    $subtask_count = $data_count['total'];
    if(isset($subtask_count) and $subtask_count <> 0 and $subtask_count <>null){
        $query_child = "SELECT * FROM add_new_job where (".$filter.") and parent = ".$row["id"]." order by id ASC"  or die("Error:" . mysqli_error($con));
        date_default_timezone_set("Asia/Bangkok");
        // $con_get_list= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con_get_list));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $result_child = mysqli_query($con, $query_child);
        $i = 1;
        while($row_child = mysqli_fetch_array($result_child)) {
            $status = badge_status($row_child['status']);
            //important
            if($i<$subtask_count){
                $th_class = "class='col tree_lift p-3'";
                $tr_class = "class='row sub-ticket mb-0'";
            }else{
                $th_class = "class='col tree_lift_end p-3'";
                $tr_class = "class='row mb-2' style='align-items: center;'";
                // unset($tr_class);
            }
            //check status of brand ticket match with filter or not
            if($_POST['outputValues']<>""){
                if(strpos($_POST['outputValues'], "status in ('".$row_child["status"]) !== false){
                    //data row
                    if(isset($sub_ticket)){
                        if(isset($tr_class)){
                            $sub_ticket .= "<li ".$tr_class.">";
                        }else{
                            $sub_ticket .= "<li class='row mb-2'>";
                        }
                    }else{
                        if(isset($tr_class)){
                            $sub_ticket = "<li ".$tr_class.">";
                        }else{
                            $sub_ticket = "<li class='row mb-2' >";
                        }
                    }
                    $sub_ticket .= "<div scope='row' ".$th_class." style='min-width: 380px;' ><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].") ".$row_child["sku"]." SKUs</span></div>";
                    $sub_ticket .= "<div class='col'></div>";
                    $sub_ticket .= "<div class='col'></div>";
                    $sub_ticket .= "<div class='col'></div>";
                    $sub_ticket .= "<div class='col'></div>";
                    $sub_ticket .= "<div class='col'>".$status."</div>";
                    $sub_ticket .= "<div class='col'>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3'  onclick='call_edit_add_new_modal(".$row_child["id"].")' >
                    Detail </button></div >";
                    $i++;
                }
            }else{
                //data row
                if(!isset($sub_ticket)){$sub_ticket ="";}
                if(!isset($tr_class)){$tr_class="";}
                $sub_ticket .= "<li ".$tr_class.">";
                $sub_ticket .= "<div scope='row' ".$th_class." style='min-width: 380px;'><span class='tree_label'>NS-".$row["id"]."-".$i." (".$row_child["id"].") ".$row_child["sku"]." SKUs</span></div>";
                $sub_ticket .= "<div class='col'></div>";
                $sub_ticket .= "<div class='col'></div>";
                $sub_ticket .= "<div class='col'></div>";
                $sub_ticket .= "<div class='col'></div>";
                $sub_ticket .= "<div class='col' >".$status."</div>";
                $sub_ticket .= "<div class='col'>". "<button type='button' id='ns_ticket_".$row_child['id']."' class='badge rounded bg-gradient bg-dark p-2 ps-3 pe-3' onclick='call_edit_add_new_modal(".$row_child["id"].")' >
                Detail </button></div>";
                $i++;
            }
        }
    }

        if($row["config_type"]=="parent"){
            if( isset($sub_ticket)){
                echo $ticket.$sub_ticket;
            }
        }else{
            if(isset($sub_ticket)){
                echo $ticket.$sub_ticket;
            }else{
                if(isset($ticket)){ echo $ticket;}
            }
        }

    unset($ticket);
    unset($sub_ticket);
    unset($status);
}
mysqli_close($con);
?>