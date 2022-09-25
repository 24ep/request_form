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

<nav class="p-3 bg-white shadow-sm border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php echo $ac_firstname." ".$ac_lastname; ?></a>
        <small href="#"><?php echo $ac_department; ?> </small> | <?php echo $ac_role; ?>
        <!-- <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected><?php echo $ac_role; ?></option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select> -->
    </div>
</nav>

<div class="row">
    <div class="col-3 bg-white shadow-sm pe-0 mt-0  ms-0 m-0 border-end">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <ion-icon name="star-outline"></ion-icon> Pedding
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse  collapse show" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">....</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <ion-icon name="star-half-outline"></ion-icon> Inprogress
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse  collapse show" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body p-0">
                            <div id="get_list_panel_inprogress">
                                
                            </div>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed border-bottom bg-light bg-gradient fw-bold rounded-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <ion-icon name="star"></ion-icon> Review
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse  collapse show" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                        the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more
                        exciting happening here in terms of content, but just filling up the space to make it look, at
                        least at first glance, a bit more representative of how this would look in a real-world
                        application.</div>
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