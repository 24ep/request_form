<div class="modal-dialog">
    <div class="modal-content shadow rounded  ">
        <div class="modal-header">
            <h5 class="modal-title" id="create_new_ns_modalLabel"><strong>
                    <ion-icon name="rocket-outline"></ion-icon> Add new ticket
                </strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <small class="mb-2">
                <ion-icon name="information-circle-outline"></ion-icon> สามาถแก้ไขข้อมูลบางส่วนด้วยตนเองได้ที่ Request
                detail จนกว่า ทาง Content จะทำการ assign ticket
                นี้ให้กับทางผู้เกี่ยวข้อง
            </small>
            <!-- brand -->
            <div class="form-floating mb-3">
                <input list="brandoptions" type="text" required class="form-control form-control-sm" id="brand"
                    placeholder="ชื่อแบรนด์ต้องตรงกับที่จะขายหน้าเว็บ">
                <datalist id="brandoptions">
                <?php echo $brand_op; ?>
                </datalist>
                <label for="brand"><strong style="color:red">* </strong>Brand</label>
            </div>

            <!-- sub_department -->
            <div class="form-floating mb-3">
                <select class="form-select form-select-sm" required id="sub_department"
                    aria-label="Floating label select example">
                    <?php echo $sub_department_op; ?>
                </select>
                <label for="sub_department"><strong style="color:red">* </strong>Sub department</label>
            </div>
            <!-- sku -->
            <div class="form-floating mb-3">
                <input type="number" class="form-control form-control-sm"  required id="sku" placeholder="">
                <label for="sku"><strong style="color:red">* </strong>Total SKUs</label>
            </div>
            <!-- production_type -->
            <div class="form-floating mb-3">
                <select class="form-select form-select-sm" required id="production_type"
                    aria-label="Floating label select example">
                    <?php echo $production_type_op; ?>
                </select>
                <label for="production_type"><strong style="color:red">* </strong>Production type</label>
            </div>
            <!-- Project type -->
            <div class="form-floating mb-3">
                <select class="form-select form-select-sm" required id="project_type"
                    aria-label="Floating label select example">
                    <?php echo $project_type_op; ?>
                </select>
                <label for="project_type"><strong style="color:red">* </strong>Project type</label>
            </div>
            <!-- launch date -->
            <?php
            //Calculate min date
            //---set holiday
                $holiday = array(
                    // '2017-12-16\T00:00' => 'Victory Day of Bangladesh',
                    // '2017-12-25\T00:00' => 'Christmas'
                );
                $i = 0;
                $work_day = date("Y-m-d\Th:i"); //---get current day
                while($i != 1) //---loop 7 day for set min date
                {
                     //$work_day = date('Y-m-d\Th:i', strtotime('+1 day', strtotime($work_day)));
                        $work_day = date('Y-m-d', strtotime('+1 day', strtotime($work_day)));
                        $day_name = date('l', strtotime($work_day));
                        if($day_name != 'Saturday' && $day_name != 'Sunday' && !isset($holiday[$work_day]))
                        {
                            $min_launch_date = $work_day;
                            $i++;
                        }
                }
        ?>
            <div class="form-floating mb-3">
                <input type="date" class="form-control form-control-sm" min="<?php echo $min_launch_date; ?>" id="launch_date" placeholder="">
                <label for="launch_date">Launch date (Optional)</label>
            </div>
            <!-- Tag
            <div class="form-floating mb-3">
                <select class="form-select form-select-sm" size="3" multiple id="tags[]"
                    aria-label="Floating label select example">
                    <?php// echo $tags_op; ?>
                </select>
                <label for="project_type"><strong style="color:red">* </strong>Tags</label>
            </div> -->
            <!-- Bu -->
            <div class="form-floating mb-3">
                <select class="form-select form-select-sm" id="bu" required aria-label="Floating label select example">
                    <?php echo $bu_op; ?>
                </select>
                <label for="bu"><strong style="color:red">* </strong>Business unit (BU)</label>
            </div>
            <!-- Contact buyer / Contact vender -->
            <hr>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-floating mb-3">
                        <textarea class="form-control form-control-sm" required id="init_contact_buyer" name="contact_buyer"
                         rows="4" style="height: 100px"><?php echo $get_contact_buyer; ?>
                    </textarea>
                        <label for="contact_buyer"><strong style="color:red">* </strong>Contact buyer</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <textarea class="form-control form-control-sm" required id="init_contact_vender"
                            name="contact_vender"
                            rows="4" style="height: 100px"><?php echo $get_contact_buyer; ?>

                    </textarea>
                        <label for="contact_vender"><strong style="color:red">* </strong>Contact vender</label>
                    </div>
                </div>
            </div>
            <!-- Link for information -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control form-control-sm" required id="link_info" placeholder="">
                <label for="link_info"><strong style="color:red">* </strong>Link for information</label>
            </div>
            <!-- Remark -->
            <div class="form-floating mb-3">
                <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="remark"
                    style="height: 100px"></textarea>
                <label for="remark">Remark (Optional)</label>
            </div>
            <!-- end -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-light bg-gradient shadow-sm"
                data-bs-dismiss="modal">CANCEL</button>
            <button type="button" data-bs-dismiss="modal" onclick="action_submit_add_new_job()" class="btn btn-sm btn-success bg-gradient shadow-sm">SUBMIT</button>
        </div>
    </div>