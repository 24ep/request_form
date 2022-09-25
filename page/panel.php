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

<nav class="p-3 bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php echo $ac_firstname." ".$ac_lastname; ?></a>
        <small href="#"><?php echo $ac_department; ?></small>
    </div>
</nav>

<div class="row">
    <div class="col-3 bg-white shadow-sm">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Pedding Suggestion
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                        the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Checking
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                        the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine
                        this being filled with some actual content.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        On-productions
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
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
    <div class="col-7">

    </div>

</div>