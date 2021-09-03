
    <?php
        session_start();
        $id = $_POST["id"];
        $sku_change = $_POST['sku_change'];
        trim($sku_change," ");
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        $sku_change_array = explode("\n", $sku_change);
        $sku_list_array = array();
        foreach ( $sku_change_array as $sku ) {
            if($sku <> '' and $sku <> null){
                array_push($sku_list_array,"('".trim($sku," ")."','".$_SESSION['username'] ."',".$id.")");
            }
            
        }
        print_r ($sku_list_array);

        $sku_list = implode(',',$sku_list_array);
        $sql_sku = "INSERT INTO sku_list (
            sku,create_by,csg_id )
             VALUES 
            ".$sku_list."
            ON DUPLICATE KEY UPDATE
            csg_id = VALUES(csg_id),
            create_by = VALUES(create_by)
            ;";
    
        
        $query_sku = mysqli_query($con,$sql_sku);
        if($query_sku){
            echo 'success !';
        }

    ?>