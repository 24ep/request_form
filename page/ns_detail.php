<?php
  session_start();
  $nickname = $_SESSION["nickname"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT
            anj.id as id,
            anj.brand as brand,
            anj.request_username as request_username,
            anj.create_date as create_date,
            anj.request_date as request_date,
            anj.update_date as update_date,
            anj.production_type as production_type,
            anj.business_type as business_type,
            anj.project_type as project_type,
            anj.stock_source as stock_source,
            anj.contact_buyer as contact_buyer,
            anj.contact_vender as contact_vender,
            anj.launch_date as launch_date,
            anj.link_info as link_info,
            anj.remark as remark,
            anj.department as department,
            anj.sku as sku,
            anj.status as status,
            anj.start_checking_date as start_checking_date,
            anj.accepted_date as accepted_date,
            anj.cancel_resone as cancel_resone,
            anj.need_more_info_date as need_more_info_date,
            anj.follow_up_by as follow_up_by,
            anj.bu as bu,
            anj.tags as tags,
            anj.online_channel as online_channel,
            anj.request_important as request_important,
            anj.follow_assign_name as follow_assign_name,
            anj.follow_assign_date as follow_assign_date,
            anj.sub_department as sub_department,
            anj.parent as parent,
            anj.config_type as config_type,
            anj.trigger_status as trigger_status,
            anj.subject_mail as subject_mail,
            ac.nickname as follow_assign_nickname,
            brand_info.link as brand_info_link,
            brand_editor.body  as brand_editor,
            anj.web_cate as web_cate,
            jc.approved_date as approved_date,
            jc.job_number as job_number
            FROM all_in_one_project.add_new_job as anj
            left join all_in_one_project.account as ac
            on ac.username = anj.follow_assign_name
            left join all_in_one_project.brand_information as brand_info
            on brand_info.brand = anj.brand
            left join u749625779_cdscontent.job_cms as jc
            on anj.id = jc.csg_request_new_id
            left join all_in_one_project.brand_editor as brand_editor
            on brand_editor.brand = anj.brand
            where anj.id = ".$_POST['id']." ORDER BY anj.id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $brand = $row['brand'];
      $request_username = $row['request_username'];
      $create_date = $row['create_date'];
      $request_date= $row['request_date'];
      $update_date = $row['update_date'];
      $production_type = $row['production_type'];
      $business_type = $row['business_type'];
      $project_type = $row['project_type'];
      $stock_source = $row['stock_source'];
      $contact_buyer = $row['contact_buyer'];
      $contact_vender = $row['contact_vender'];
      $launch_date = $row['launch_date'];
      $link_info = $row['link_info'];
      $remark = $row['remark'];
      $department = $row['department'];
      $sku = $row['sku'];
      $status = $row['status'];
      $start_checking_date = $row['start_checking_date'];
      $accepted_date = $row['accepted_date'];
      $cancel_resone = $row['cancel_resone'];
      $need_more_info_date = $row['need_more_info_date'];
      $need_more_info_note = $row['need_more_info_note'];
      $follow_up_by = $row['follow_up_by'];
      $bu = $row['bu'];
      $tags = $row['tags'];
      $online_channel = $row['online_channel'];
      $request_important = $row['request_important'];
      $follow_assign_name = $row['follow_assign_name'];
      $follow_assign_date = $row['follow_assign_date'];
      $sub_department = $row['sub_department'];
      $parent = $row['parent'];
      $config_type = $row['config_type'];
      $subject_mail = $row['subject_mail'];
      $follow_assign_nickname = $row['follow_assign_nickname'];
      $brand_info_link = $row['brand_info_link'];
      $web_cate = $row['web_cate'];
      $brand_editor=$row['brand_editor'];
      $trigger_status=$row['trigger_status'];
      $job_number=$row['job_number'];
      $approved_date=$row['approved_date'];
      
    //stamp color status
    if($row["status"]=="pending"){
    $status_style = 'style="background: #a9a9a94f;color:#8f8f8f"';
    }elseif($row["status"]=="checking"){
        $status_style = 'style="background: #ffff7e;color:#997300"';
    }elseif($row["status"]=="accepted"){
        $status_style = 'style="background: #7befb2;color:#115636"';
    }elseif($row["status"]=="waiting confirm"){
        $status_style = 'style="background: #499CF7;color:#093f8e"';
    }elseif($row["status"]=="waiting image"){
        $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting data"){
        $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting traffic"){
        $status_style = 'style="background: #ea79f7;color:#6a2e71"';
    }
  }
  $query = "SELECT * FROM account where username = '".$follow_up_by."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $follow_up_nickname = $row['nickname'];
    $follow_up_name = $row['firstname']." ".substr($row['lastname'],0,2).". ( ".$follow_up_nickname." ) ";
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
  }
  if($follow_up_name==""){
    $follow_up_name = '-';
    $office_tell = '-';
    $work_email = '-';
  }
  mysqli_close($con);
  if($request_important=="Urgent"){
    $dp_tags .= '<span class="badge bg-danger" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$request_important.'</span>';
}
  $tags_array = explode(", ", $tags);
  foreach ($tags_array as $tag) {
   $dp_tags .= '<span class="badge bg-dark" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$tag.'</span>';
  }
?>
<link rel="stylesheet" href="base/action/notiflix/dist/notiflix-3.2.5.min.css" />
<script src="base/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NS-<?php echo $id." ".$brand." ".$sku." SKUs".$dp_tags;?> </a>
  </div>
</nav>

<div class="container-fluid ">


</div>