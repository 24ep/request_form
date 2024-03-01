
    <?php
        session_start();
        $id = $_POST["id"];
        $bu = $_POST["bu"];
        $sku_change = $_POST['sku_change'];
        $sku_change =trim($sku_change," ");
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
        
        $sku_change_array = explode("\n", $sku_change);
        $sku_list_array = array();
        $sku_just_array = array();
        foreach ( $sku_change_array as $sku ) {
            if($sku <> '' and $sku <> null){
                array_push($sku_list_array,"('".trim($bu.$sku," ")."','".$_SESSION['username'] ."',".$id.")");
                array_push($sku_just_array,"'".trim($bu.$sku," ")."'");
            }
            
        }
        print_r($sku_list_array);
        $sku_list_text = implode(',',$sku_list_array);
        if($_POST["be_status_on_change"]=="cancel"){
            // cancel old ticket
            $sku_just =  implode(',',$sku_just_array);
            $query_dulp_sku = "SELECT * FROM sku_list where sku in (".$sku_just.") ORDER BY id DESC " or die("Error:" . mysqli_error($con));
            $result_dulp_sku = mysqli_query($con, $query_dulp_sku);
            $sku_csg_ticket_id_nc = array();
            while($row_dulp_sku = mysqli_fetch_array($result_dulp_sku)) {
                array_push($sku_csg_ticket_id_nc,$row_dulp_sku["csg_id"]);
            }
            $sku_csg_ticket_id_nc = array_unique($sku_csg_ticket_id_nc);
            $sku_csg_ticket_id_nc_text =  implode(',',$sku_csg_ticket_id_nc);
            $sql_cancel_old  = "UPDATE add_new_job SET cancel_resone = '".$_SESSION["username"]." had been cancel sine of move sku to ticket NS-".$id." ".date("Y-m-d H:i:s")."' , status = 'cancel',cancel_date = CURRENT_TIMESTAMP  WHERE id in (".$sku_csg_ticket_id_nc_text .")";
                // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
            $query_cancel_old = mysqli_query($con,$sql_cancel_old);
            // end cancel old ticket
        }
       
        $sql_sku = "INSERT INTO sku_list (
            sku,create_by,csg_id )
             VALUES 
            ".$sku_list_text."
            ON DUPLICATE KEY UPDATE
            csg_id = VALUES(csg_id),
            create_by = VALUES(create_by)
            ;";
    
        
        $query_sku = mysqli_query($con,$sql_sku);
        if($query_sku){
            echo "<script>
            Notiflix.Report.success(
            'Success',
            'These sku have been sync to this ticket',
            'Okay',
            )</script>;
        ";
        }else{
            echo "<script>
            Notiflix.Report.failure(
                'Failure',
                'Error: " . $sql . "<br/><br/>" . $con->error.",
                'Okay',
                )</script>;
            ";
        }
        unset($sku_list_array);
        unset($sku_just_array);
    ?>