<h2 style="margin-left:40px;"><strong>MARKETING</strong></h2>
<div id="marketing_contant">
    <div class="col-md-12" id="form_data">
        <div class="main-form-area-content">
            <div class="col-md-9">
                <div class="wgs-col-9 bg-9">
                    <div id="msg_bdy"></div>
                    <form class="form-horizontal" id="upload_Form_client"  method="post">
                        <div class="form-group">
                            <label class="col-md-4" for="date_from">Date From</label>	
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="date_from">
                                <div id="date_from_error" style="color:red; display:none;">*Please select date</div>
                                <!-- <textarea class="form-control" id="discription"></textarea> -->
                            </div>	
                        </div>
                        <div class="form-group" id="atch_div">
                            <label class="col-md-4" for="date_to">Date To</label>	
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="date_to"/>
                            </div>
                            <div id="error_msg" style="text-align: center"></div>	
                        </div>

                        <div class="form-group" style="text-align: center">
                            <label class="control-label">
                                <input type="submit" class="btn btn-info wgs-btn-cls" id="filter_makt_invoice_date" name="submit_role_form" value="Filter">
                            </label>
                        </div>

                    </form>
                </div>    
            </div>
        </div>
    </div>
    <?php 
        $paid_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Paid',null,null,'countData',null);
        $pending_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Unpaid',null,null,'countData',null);
        $refund_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Refunded',null,null,'countData',null);
        $cancle_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Cancelled',null,null,'countData',null);
    ?>
    <!-- <div class="row" id='load'></div> -->
    
    <div id="fullpage-overlay" class="hidden">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <img src="/whmcs/assets/img/overlay-spinner.svg">
                <br>
                <span class="msg"></span>
            </div>
        </div>
    </div>
    <div id="invo_div">
        <div id="" class="row ">
            <div id="" class="col-md-4 invo font-weight-bold"><strong>TOTAL PAID INVOICES</strong><span class="cir"><div class="cnt_div" ><strong id='paid_inv'><?php echo $paid_invo?></strong></div></span></div>
            <div id="" class="col-md-4 invo font-weight-bold right_invo"><strong>TOTAL PENDING INVOICES</strong><span class="cir"><div class="cnt_div"><strong id="pend_inv"><?php echo $pending_invo?></strong></div></span> </div>
        </div>
        
        <div id="invoice_div" class="row">
            <div id="" class="col-md-4 invo"><strong>REFUND</strong><span class="cir"><div class="cnt_div"><strong id="ref_inv"><?php echo $refund_invo?></strong></div></span> </div>
            <div id="" class="col-md-4 invo right_invo"><strong>CANCEL</strong><span class="cir"><div class="cnt_div"><strong id="can_inv"> <?php echo $cancle_invo?></strong></div></span> </div>
        </div>
    </div>
   
</div>