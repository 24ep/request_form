<?php
 session_start();
    function badge_due_date($date){
        if($date <> null){
          $current_day = date("Y-m-d");
          $date_wiht_formate = date_create($date);
          $date_wiht_formate = date_format($date_wiht_formate,"Y-m-d");
          $date_wiht_formate_diff = (strtotime($date_wiht_formate)-strtotime($current_day))/  ( 60 * 60 * 24 );
          if($date_wiht_formate_diff==0){
            $ef_badge = '<span class="badge rounded-pill bg-danger " style="margin-left:5px">'.$date_wiht_formate.'</span>';
          }elseif($date_wiht_formate_diff==1){
            $ef_badge = '<span class="badge rounded-pill bg-warning text-dark" style="margin-left:5px">'.$date_wiht_formate.'</span>';
          }elseif($date_wiht_formate_diff<0){
            $ef_badge = '<span class="badge rounded-pill bg-danger" style="margin-left:5px">'.$date_wiht_formate.'</span>';
          }else{
            $ef_badge  = '<span class="badge rounded-pill bg-secondary" style="margin-left:5px">'.$date_wiht_formate.'</span>';
          }
        }
        return $ef_badge;
      }
      function badge_status_cr($status){
      switch ($status) {
        case "Pending": $status = '<button type="button" class="btn btn-sm shadow-sm badge-status-npd-pd" >pending</button>'; break;
        case "Inprogress": $status = '<button type="button" class="btn btn-sm shadow-sm badge-status-npd-ip">Inprogress</button>'; break;
        case "Close": $status = '<button type="button" class="btn btn-sm shadow-sm badge-status-npd-c" >'.$status.'</button>'; break;
        case "Waiting CTO": $status = '<button type="button" class="btn btn-sm shadow-sm bage-status-npd-wc">Waiting CTO</button>'; break;
        case "Waiting Execution":  $status = '<button type="button" class="btn btn-sm shadow-sm bage-status-npd-we">Waiting Execution</button>'; break;
        case "Waiting Buyer": $status = '<button type="button" class="btn btn-sm shadow-sm">waiting buyer</button>'; break;
        default: $status = '<button type="button" class="btn btn-sm shadow-sm badge-status-npd-df">'.$status.'</button>';
      }
      return $status;
      }


?>