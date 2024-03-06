<?php

 session_start();

 include('action_send_line_api.php');

 include('action_add_participant.php');

//include("connect.php");

    foreach($_POST["stock_source"] as $store)

        {

            if($sum_store <> ""){

                $sum_store .= ", ".$store;

            }else{

                $sum_store .= $store;

            }

        };

    foreach($_POST["itemmize_type"] as $itemmize_type)

      {

            if($sum_itemmize_type <> ""){

                $sum_itemmize_type .= ", ".$itemmize_type;

            }else{

                $sum_itemmize_type .= $itemmize_type;

            }

      };

    foreach($_POST["online_channel"] as $prodall_in_one_project

        {

            if($sum_product_website <> ""){

                $sum_product_website .= ", ".$product_website;

            }else{

                $sum_product_website .= $product_website;

            }

        };

    foreach($_POST["tags"] as $tags)

        {

            if($sum_tags <> ""){

                $sum_tags .= ", ".$tags;

            }else{

                $sum_tags .= $tags;

            }

        };

    //calculate job number

    //get department

        date_default_timezone_set("Asia/Bangkok");

        $con_map_sub_dept = mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

        mysqli_query($con_map_sub_dept, "SET NAMES 'utf8' ");

        $query_map_sub_dept = "SELECT * FROM all_in_one_project.mapping_dept_subdept where sub_department = '".$_POST["sub_department"]."'";

        $result_map_sub_dept =  mysqli_query($con_map_sub_dept, $query_map_sub_dept);

        while($row_map_sub_dept = mysqli_fetch_array($result_map_sub_dept)) {

            $department_cal = $row_map_sub_dept["department"];

        }



        if($_POST["brand"]<>""){ $insert_head .= "brand";$insert_value .= "'".str_replace("'","''",$_POST["brand"])."'";}

       // if($department_cal<>""){ $insert_head .= ",department";$insert_value .= ",'".$department_cal."'";}

        if($_POST["sub_department"]<>""){ $insert_head .= ",sub_department";$insert_value .= ",'".$_POST["sub_department"]."'";}

        if($_POST["web_cate"]<>""){ $insert_head .= ",web_cate";$insert_value .= ",'".$_POST["web_cate"]."'";}

        if($department_cal<>""){ $insert_head .= ",department";$insert_value .= ",'".$department_cal."'";}

        if($_POST["sku"]<>""){ $insert_head .= ",sku";$insert_value .= ",'".$_POST["sku"]."'";}

        if($_POST["production_type"]<>""){ $insert_head .= ",production_type";$insert_value .= ",'".$_POST["production_type"]."'";}

        if($_POST["business_type"]<>""){ $insert_head .= ",business_type";$insert_value .= ",'".$_POST["business_type"]."'";}

        if($_POST["project_type"]<>""){ $insert_head .= ",project_type";$insert_value .= ",'".$_POST["project_type"]."'";}

        if($_POST["launch_date"]<>""){ $insert_head .= ",launch_date";$insert_value .= ",'".$_POST["launch_date"]."'";}

        if($sum_store<>""){ $insert_head .= ",stock_source";$insert_value .= ",'".$sum_store."'";}

        if($_POST["bu"]<>""){ $insert_head .= ",bu";$insert_value .= ",'".$_POST["bu"]."'";}

        if($sum_product_website<>""){ $insert_head .= ",online_channel";$insert_value .= ",'".$sum_product_website."'";}

        if($_POST["contact_buyer"]<>""){ $insert_head .= ",contact_buyer";$insert_value .= ",'".str_replace("'","''",$_POST["contact_buyer"])."'";}

        if($_POST["contact_vender"]<>""){ $insert_head .= ",contact_vender";$insert_value .= ",'".str_replace("'","''",$_POST["contact_vender"])."'";}

        if($_POST["link_info"]<>""){ $insert_head .= ",link_info";$insert_value .= ",'".$_POST["link_info"]."'";}

        if($_POST["remark"]<>""){ $insert_head .= ",remark";$insert_value .= ",'".$_POST["remark"]."'";}

        if($_SESSION["username"]<>""){ $insert_head .= ",request_username";$insert_value .= ",'".$_SESSION["username"]."'";}

        if($_POST["request_important"]<>""){ $insert_head .= ",request_important";$insert_value .= ",'".$_POST["request_important"]."'";}

        if($sum_tags<>""){ $insert_head .= ",tags";$insert_value .= ",'".$sum_tags."'";}

        date_default_timezone_set("Asia/Bangkok");

        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

        mysqli_query($con, "SET NAMES 'utf8' ");

	$sql = "INSERT INTO add_new_job (

	".$insert_head."

    )

	VALUES (

    ".$insert_value."

    )";

	$query = mysqli_query($con,$sql);

	if($query) {

        $last_id = $con->insert_id;

        add_participant($last_id,"add_new_job");

        //get key

        date_default_timezone_set("Asia/Bangkok");

        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

        mysqli_query($con, "SET NAMES 'utf8' ");

        $query = "SELECT  * FROM add_new_job as job

        left join account as account

        ON job.request_username = account.username WHERE job.id = ".$last_id

        or die("Error:" . mysqli_error($con));

        $result =  mysqli_query($con, $query);

            while($row = mysqli_fetch_array($result)) {

                $key = $row["token_line"];

                $brand = $row["brand"];

                $sku = $row["sku"];

                $stock_source = $row["stock_source"];

                //echo '<script>alert("'.$key.'");</script>';

            }

            if($key<>"" and $key<>null){

                sent_line_noti("\n• คุณได้ทำกาส่ง request ขอเปิด job\n• Ticket ID : NS-".$last_id." [ ".$brand." ".$sku." SKUs ]\n• Store : ".$stock_source,$key);

            }

            echo $last_id;

	}else{

        echo 'Error: ' . $sql . '<hr>' . $con->error;

    }

    mysqli_close($con);



?>

