
<h2 style="margin-left:40px;"><strong>SALES REPORT</strong></h2>
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
                            <input type="submit" class="btn btn-info wgs-btn-cls" id="filter_invoice_date" name="submit_role_form" value="Filter">
                        </label>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped most-popular-table dataTable no-footer" id="sales_tbl">
                    <thead>
                        <tr>
                            <th class="views-area">#USERID</th>
                            <th class="views-area">TOTAL PAID INVOICES</th>
                            <th class="views-area">TOTAL UNPAID INVOICES</th>
                            <th class="views-area">TERMINATED SERVICE</th>
                        </tr>
                    </thead>
                    <tbody id="sales_tbl_body">
                        <?php
                            // $get_invoice_details=$sales_obj->invoice_details();
                            $invoice_details= $datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',null,null,null,'allDataUnik',null);    
                            foreach($invoice_details as $val) {
                                $total_paid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Paid','countDataDoubleCondition',null);
                                $total_unpaid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Unpaid','countDataDoubleCondition',null);
                                $total_terminated_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Cancelled','countDataDoubleCondition',null); 
                                echo '<tr><td><a href="../admin/clientssummary.php?userid='.$val->userid.'">#'.$val->userid.'</td><td>'.$total_paid_invoice.'</td><td>'.$total_unpaid_invoice.' 
                                </td><td>'.$total_terminated_invoice.'</td></tr>';
                            }
                        ?>  
                    </tbody>
                </table>
            </div>
                  
        </div>    
    </div>