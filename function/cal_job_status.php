<?php

function cal_status($job_status_filter ,$approved_editing_status,$transfer_type,$content_complete_date,$approved_by,$production_type,$retouch_complete_date,$upload_image_date,$shoots_complete_date){
if($job_status_filter == 'Continue' and $approved_editing_status == 'content_editing' ){ $status =  'Content'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'studio_editing' ){ $status =  'Upload Image' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'content_studio_editing' ){ $status =  'Content & Upload Image' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'edited' ){ $status =  'WaitApprover'; }

elseif($approved_editing_status == 'approved' ){ $status =  'Approved'; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data only' and $content_complete_date == null ){ $status =  'Content' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data only' and $content_complete_date <> null and $approved_by == null ){ $status =  'WaitApprover' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data only' and $content_complete_date <> null and $approved_by <> null ){ $status =  'Approved' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type == 'Resize' and $retouch_complete_date == null ){ $status =  'Retouch' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type == 'Resize' and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Upload Image' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type == 'Resize' and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by == null ){ $status =  'WaitApprover' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type == 'Resize' and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by <> null ){ $status =  'Approved' ; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type <> 'Resize' and $shoots_complete_date == null ){ $status =  'Shoots' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type <> 'Resize' and $shoots_complete_date <> null and $retouch_complete_date == null ){ $status =  'Retouch' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type <> 'Resize' and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Upload Image' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type <> 'Resize' and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by == null ){ $status =  'WaitApprover' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Photo only' and $production_type <> 'Resize' and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by <> null ){ $status =  'Approved'; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date <> null and $retouch_complete_date == null ){ $status =  'Retouch' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date <> null and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Upload Image' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date <> null and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by == null ){ $status =  'WaitApprover' ; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date <> null and $shoots_complete_date == null ){ $status =  'Shoots' ; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date <> null and $shoots_complete_date <> null and $retouch_complete_date == null ){ $status =  'Retouch'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date <> null and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Upload Image'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date <> null and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date <> null and $approved_by == null ){ $status =  'WaitApprover'; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $upload_image_date <> null and $content_complete_date <> null and $approved_by == null ){ $status =  'WaitApprover'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date == null and $retouch_complete_date == null ){ $status =  'Content & Retouch'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date == null and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Content & Upload Image'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type == 'Resize' and $content_complete_date == null and $retouch_complete_date <> null and $upload_image_date_<> null ){ $status =  'Content'; }


elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date == null and $shoots_complete_date == null ){ $status =  'Content & Shoots'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date == null and $shoots_complete_date <> null and $retouch_complete_date == null ){ $status =  'Content & Retouch'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date == null and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date == null ){ $status =  'Content & Upload Image'; }

elseif($job_status_filter == 'Continue' and $approved_editing_status == 'correct' and $transfer_type == 'Data and Photo' and $production_type <> 'Resize' and $content_complete_date == null and $shoots_complete_date <> null and $retouch_complete_date <> null and $upload_image_date <> null ){ $status =  'Content'; }

else { $status = $job_status_filter;}
return $status;
}
?>