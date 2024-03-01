<div class="offcanvas-header">
                <h5 class="offcanvas-title m-3" id="offcanvasRightLabel">
                    <ion-icon name="notifications-outline"></ion-icon> <strong>Activity</strong>
                </h5>
                <button type="button" class="btn-close p-4" onclick="show_sub_menu('close');" ></button>
            </div>
            <div class="offcanvas-body p-3" style="list-style: none;">
                <div id="get_list_job_update">
                    <?php include($_SERVER['DOCUMENT_ROOT'].'get_list_job_update.php'); ?>
                </div>
            </div>