<?php 
    include ("".__DIR__."/services_header.php");
?>
<div id="service_rept">
    <h2 style="margin-left:40px;"><strong>SERVICES REPORT</strong></h2>
    <div class="col-md-12" id="form_data">
        <div class="main-form-area-content">
            <div class="col-md-9">
                <div class="wgs-col-9 bg-9">
                    <div id="msg_bdy"></div>
                    <form class="form-horizontal" id="service_date"  method="post">
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
                                <input type="submit" class="btn btn-info wgs-btn-cls" id="filter_services_date" name="submit_role_form" value="Filter">
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
                                <th class="views-area">SERVICES</th>
                                <th class="views-area">REG. DATE</th>
                                <th class="views-area">LEAD TIME (DAYS)</th>
                            </tr>
                        </thead>
                        <tbody id="services_tbl_body">
                            <?php
                                // $get_invoice_details=$sales_obj->invoice_details();
                                $service_details= $datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',null,null,null,'allDataUnik',null);    
                                foreach($service_details as $val) {
                                    $total_services=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',$val->userid,'domainstatus','Active','countDataDoubleCondition',null);
                                    $lead_time=0;
                                    // $total_unpaid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Unpaid','countDataDoubleCondition',null);
                                    // $total_terminated_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Cancelled','countDataDoubleCondition',null); 
                                    echo '<tr><td><a href="../admin/clientssummary.php?userid='.$val->userid.'">#'.$val->userid.'</td><td>'.$total_services.'</td><td>'.$val->regdate.' 
                                    </td><td>'.$lead_time.'</td></tr>';
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                    
            </div>    
        </div>
        <h2 ><strong>DOMAIN DETAILS</strong></h2>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped most-popular-table dataTable no-footer" id="domain_tbl">
                        <thead>
                            <tr>
                                <th class="views-area">#USERID</th>
                                <th class="views-area">DOMAIN ID</th>
                                <th class="views-area">DOMAIN NAME</th>
                                <th class="views-area">REG. DATE</th>
                                <th class="views-area">LEAD TIME (DAYS)</th>
                            </tr>
                        </thead>
                        <tbody id="domain_tbl_body">
                            <?php
                                // $get_invoice_details=$sales_obj->invoice_details();
                                $domain_details= $datasur_obj->wgs_fetch_table_record_datasur('tbldomains','userid',null,'status','Active','allDataUnik',null);    
                                foreach($domain_details as $val) {
                                    // $total_services=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',$val->userid,'domainstatus','Active','countDataDoubleCondition',null);
                                    $lead_time=0;
                                    // $total_unpaid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Unpaid','countDataDoubleCondition',null);
                                    // $total_terminated_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Cancelled','countDataDoubleCondition',null); 
                                    echo '<tr><td><a href="../admin/clientssummary.php?userid='.$val->userid.'">#'.$val->userid.'</td><td>'.$val->id.'</td><td>'.$val->domain.' 
                                    </td><td>'.$val->registrationdate.'</td><td>'.$lead_time.'</td></tr>';
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                    
            </div>    
        </div>
    </div>
<!-- </div> -->
<div id="client_mst_serv" style="display:none">
    <h2 style="margin-left:40px;"><strong>CLIENT WITH MOST SERVICES</strong></h2>
        <div class="col-md-12" id="form_data">
            <div class="main-form-area-content">
                <div class="col-md-9">
                    <div class="wgs-col-9 bg-9">
                        <div id="msg_bdy"></div>
                        <form class="form-horizontal" id="filrt_user_form"  method="post">
                            <div class="form-group">
                                <label class="col-md-4" for="user_dropdown">Select</label>	
                                <div class="col-md-8">
                                    <div>
                                        <div class="dropdown" id="user_dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select User<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <?php 
                                                    $clients=$datasur_obj->wgs_fetch_table_record_datasur('tblclients',null,null,null,null,'allData',null);
                                                    foreach($clients as $val) 
                                                    {
                                                        echo '<li><a class="user_name" userid="'.$val->id.'">'.$val->firstname.' '.$val->lastname.'</a></li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <button class="btn btn-info" id="filter__users">Clear Filter</button>
                                    </div>  
                                </div> 
                            </div>
                        </form>
                    </div>    
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="row" id="users_most_service_div">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped most-popular-table dataTable no-footer" id="user_most_serv_tbl">
                        <thead>
                            <tr>
                                <th class="views-area">#USERID</th>
                                <th class="views-area">USER NAME</th>
                                <th class="views-area">TOTAL SERVICES</th>
                            </tr>
                        </thead>
                        <tbody id="user_service_tbl_body">
                            <?php
                                
                                foreach($clients as $val) {
                                    $total_services=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',$val->id,null,null,'countData',null);
                                   
                                    echo '<tr><td><a href="../admin/clientssummary.php?userid='.$val->id.'">#'.$val->id.'</td><td>'.$val->firstname.' '.$val->lastname.'</td><td>'.$total_services.'</td></tr>';
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                    
            </div>    
        </div>
        <div class="row" id="user_service_div" style="display:none">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped most-popular-table dataTable no-footer" id="user_serv_tbl">
                        <thead>
                            <tr>
                                <th class="views-area">#USERID</th>
                                <th class="views-area">SERVICE NAME</th>
                                <th class="views-area">REG. DATE</th>
                                <th class="views-area">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="user_service_name_tbl_body">
                           
                        </tbody>
                    </table>
                </div>
                    
            </div>    
        </div>
</div>
<!-- top sold services -->
<div id="top_sold_div" style="display:none">
    <h2 style="margin-left:40px;"><strong>TOP SERVICES SOLD</strong></h2>
    <div class="col-md-12" id="form_data">
        <div class="main-form-area-content">
            <div class="col-md-9">
                <div class="wgs-col-9 bg-9">
                    <div id="msg_bdy"></div>
                    <form class="form-horizontal" id="product_form"  method="post">
                        <div class="form-group">
                            <label class="col-md-4" for="date_from">Product Services Group</label>	
                            <div class="col-md-8">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" id="prd_grp_btn">Product Group<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <?php 
                                        $product_group=$datasur_obj->wgs_fetch_table_record_datasur('tblproductgroups',null,null,null,null,'allData',null);
                                        foreach($product_group as $val) 
                                        {
                                            echo '<li><a class="product_name" gid="'.$val->id.'" name="'.$val->name.'">'.$val->name.'</a></li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <!-- <button class="btn btn-info" id="filter__product">Clear Filter</button> -->
                               
                            </div>	
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
    <div class="row" id="user_service_div">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped most-popular-table dataTable no-footer" id="product_tbl">
                        <thead>
                            <tr>
                                <th class="views-area">PRODUCT ID</th>
                                <th class="views-area">PRODUCT NAME</th>
                                <th class="views-area">COUNTER</th>
                               
                            </tr>
                        </thead>
                        <tbody id="product_tbl_body">
                           <?php 
                                $gid=1;
                                $products=$datasur_obj->wgs_fetch_table_record_datasur('tblproducts','gid',$gid,null,null,'userFileData',null);
                                foreach($products as $val) 
                                {
                                    $product_count=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','packageid',$val->id,null,null,'countData',null);
                                    echo '<tr><td>'.$val->id.'</td><td>'.$val->name.'</td><td>'.$product_count.'</td></tr>';
                                }
                           ?>
                        </tbody>
                    </table>
                </div>
                    
            </div>    
        </div>
</div>