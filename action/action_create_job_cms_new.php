<?php
 session_start();
 include('action_insert_log.php');
function max_job_by_bu($bu_job) {
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query_text = "SELECT MAX(substring(job_number,9,4)) AS max_job FROM `u749625779_cdscontent`.`job_cms` WHERE  substring(job_number,1,3) ='".$bu_job."' and substring(job_number,4,2) = substring(YEAR(current_timestamp),3,2)";
    $query = mysqli_query($con,$query_text);
    $row = mysqli_fetch_assoc($query);
    $largestNumber = $row["max_job"];
    return $largestNumber;
}
    if($_POST["bu"]=="MSL" or $_POST["bu"]=="MJT" ){$bu_job =  "CDS";}else{$bu_job=$_POST["bu"];} //change BU for job number
        $na = max_job_by_bu($bu_job);
        $na++;
        $job_number_laset = $bu_job.date("y").date("m")."-".str_pad( $na, 4, "0", STR_PAD_LEFT );

$con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO job_cms (
                        job_type,
                        csg_request_new_id,
                        job_number,
                        bu,
                        transfer_type,
                        production_type,
                        department,
                        sub_department,
                        luanch_date,
                        sku,
                        product_sell_type,
                        product_sorting,
                        job_status_filter,
                        brand,
                        product_website,
                        recive_ticket_date,
                        project_type
    )
	VALUES (
                        'New',
                        '".$_POST["id"]."',
                        '".$job_number_laset."',
                        '".$_POST["bu"]."',
                        '".$_POST["transfer_type"]."',
                        '".$_POST["production_type"]."',
                        '".$_POST["department"]."',
                        '".$_POST["sub_department"]."',
                        '".$_POST["launch_date"]."',
                        '".$_POST["sku"]."',
                        '".$_POST["product_sell_type"]."',
                        '".$_POST["product_sorting"]."',
                        '".$_POST["job_status_filter"]."',
                        '".$_POST["brand"]."',
                        '".$_POST["product_website"]."',
                        '".$_POST["recive_ticket_date"]."',
                        '".$_POST["project_type"]."'

    )";
	$query = mysqli_query($con,$sql);
	if($query) {
        insert_log("Create new job_cms ".$job_number_laset,"job_cms",$_POST["id"]);
        echo $job_number_laset." have been created ";
    }else{
        echo 'Error :'.$con->error;
    }
?>