<!--  -->
<?php
  session_start();
$database = 'all_in_one_project';
            $table = 'account';
            $primary_key_id = 'username';
            $id=$_SESSION['username'];
            $prefix_table = 'ac';
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));

                $query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."'" or die("Error:" . mysqli_error($con));
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)) {
                    $query_column = "SELECT `COLUMN_NAME` 
                    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='".$database."' 
                        AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
                    $result_column = mysqli_query($con, $query_column);
                    while($row_column = mysqli_fetch_array($result_column)) {
                        ${$prefix_table."_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
                    }
                }
            ?>


<div class="row">
    <div class="col-3 bg-white shadow-sm pe-0 mt-0  ms-0 m-0 border-end">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0"  type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <ion-icon name="star-outline"></ion-icon> Pedding<span class="badge bg-danger rounded-pill bg-gradient">Suggestion</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse  collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">....</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0"  type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                        <ion-icon name="star-half-outline"></ion-icon> Inprogress
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse  collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body p-0">
                        <div id="get_list_panel_inprogress">
                         </div>
                    </div>
                </div>
             
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0"  type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                        <ion-icon name="star"></ion-icon> Waiting for more information
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body p-0">
                      ....
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9 p-0">
        <div id="panel_detail">

        </div>
    </div>

</div>

<script>
    // get_detail_more
function get_list_panel(ac_role,status,ac_username,ac_nickname) {
    $.post("base/get/get_list_panel.php", {
            ac_role: ac_role,
            ac_username: ac_username,
            ac_nickname :ac_nickname,
            status:status
        },
        function(data) {
            $('#get_list_panel_'+status).html(data);
        });
    
}
get_list_panel('<?php echo $ac_role; ?>','inprogress','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>')
get_list_panel('<?php echo $ac_role; ?>','waiting','<?php echo $ac_username; ?>','<?php echo $ac_nickname; ?>')

function call_edit_add_new_panel(id, brand) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("../base/page/ns_detail.php", {
            id: id
        }, function(data) {
            $('#panel_detail').html(data);
            Notiflix.Loading.remove();
        });
    }
}
</script>