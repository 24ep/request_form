<?php

?>

<div class="modal-dialog">
    <div class="modal-content shadow rounded  ">
        <div class="modal-header">
            <h5 class="modal-title" id="create_new_ns_modal_newLabel"><strong>
                    <ion-icon name="rocket-outline"></ion-icon> ADD NEW TICKET
                </strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-10">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" required id="title" placeholder="">
                        <label for="link_info"><strong style="color:red">* </strong>Title</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm" id="ticket_type" required aria-label="Floating label select example">
                            <?php echo $bu_op; ?>
                        </select>
                        <label for="bu"><strong style="color:red">* </strong>Ticket Type</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm" id="total_sku" required aria-label="Floating label select example">
                            <?php echo $bu_op; ?>
                        </select>
                        <label for="bu"><strong style="color:red">* </strong>Total SKU</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm" id="bucket" required aria-label="Floating label select example">
                            <?php echo $bu_op; ?>
                        </select>
                        <label for="bu"><strong style="color:red">* </strong>Bucket</label>
                    </div>
                </div>
                <hr>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm" id="priority" required aria-label="Floating label select example">
                            <?php echo $bu_op; ?>
                        </select>
                        <label for="bu"><strong style="color:red">* </strong>Priority</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm" id="effective_date" required aria-label="Floating label select example">
                            <?php echo $bu_op; ?>
                        </select>
                        <label for="bu"><strong style="color:red">* </strong>Effective Date</label>
                    </div>
                </div>
            </div>
        <hr>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-light bg-gradient shadow-sm"
                data-bs-dismiss="modal">CANCEL</button>
            <button type="button"  class="btn btn-sm btn-success bg-gradient shadow-sm">SUBMIT</button>
        </div>
    </div>