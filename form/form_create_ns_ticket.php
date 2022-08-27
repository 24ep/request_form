<div class="modal-header">
        <h5 class="modal-title" id="create_new_ns_modalLabel"><strong><ion-icon name="rocket-outline"></ion-icon> Add new ticket</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <small>สามาถแก้ไขข้อมูลบางส่วนด้วยตนเองได้ที่ Request detail จนกว่า ทาง Content จะทำการ assign ticket นี้ให้กับทางผู้เกี่ยวข้อง</small>
      </div>
      <div class="modal-body">
            <!-- brand -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="ชื่อแบรนด์ต้องตรงกับที่จะขายหน้าเว็บ">
                <label for="floatingInput"><strong style="color:red">* </strong>Brand</label>
            </div>
     
            <!-- sub_department -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><strong style="color:red">* </strong>Sub department</label>
            </div>
            <!-- sku -->
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><strong style="color:red">* </strong>SKU</label>
            </div>
            <!-- production_type -->
            <div class="form-floating">
                <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                    
                </select>
                <label for="floatingSelect"><strong style="color:red">* </strong>Production type</label>
            </div>
            <!-- Project type -->
            <div class="form-floating">
                <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                    
                </select>
                <label for="floatingSelect"><strong style="color:red">* </strong>Project type</label>
            </div>
            <!-- luanch date -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><strong style="color:red">* </strong>Launch date</label>
            </div>
            <!-- Tag -->
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><strong style="color:red">* </strong>Tags</label>
            </div>
            <!-- Bu -->
            <div class="form-floating mb-3">
                <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                    
                </select>
                <label for="floatingSelect"><strong style="color:red">* </strong>Bussiness unit (BU)</label>
            </div>
            <!-- Contact buyer / Contact vender -->
            <hr>
            <div class="row">
                <div class="col-md-6">

                <div class="form-floating mb-3">
                <textarea class="form-control form-control-sm" required id="contact_buyer" name="contact_buyer" 
                    placeholder ="
                    ช่องทางการติดต่อแบรนด์
                    ซื่อ - นามสกุล
                    อีเมล
                    เบอร์โทรติดต่อ
                    "
                    rows="4"><?php echo $get_contact_buyer; ?>
                
                    </textarea>
                <label for="floatingInput"><strong style="color:red">* </strong>Contact buyer</label>
                 </div>

                   
                 
                </div>
                <div class="col-md-6">
                <div class="form-floating mb-3">
                <textarea class="form-control form-control-sm" required id="contact_vender" name="contact_vender" 
                    placeholder ="
                    ช่องทางการติดต่อแบรนด์
                    ซื่อ - นามสกุล
                    อีเมล
                    เบอร์โทรติดต่อ
                    "
                    rows="4"><?php echo $get_contact_buyer; ?>
                
                    </textarea>
                <label for="floatingInput"><strong style="color:red">* </strong>Contact vender</label>
                 </div>
                </div>
            </div>
            <!-- Link for information -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><strong style="color:red">* </strong>Link for information</label>
            </div>
            <!-- Remark -->
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Remark</label>
            </div>
            <!-- end -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-light bg-gradient shadow-sm" data-bs-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-sm btn-success bg-gradient shadow-sm">SUBMIT</button>
      </div>