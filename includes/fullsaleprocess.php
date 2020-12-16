<h2 style="margin-left:40px;"><strong>PROSPECTS/LEADS</strong></h2>
<div class="col-md-12">
    <div class="navbarBase">
        <div class="col-md-12 wgs-nb">
            <div class="col-md-10">
                <div class="n-base">
                    
                </div>
            </div>
            <div class="col-md-2">
                    <button  class="btn btn-info pull-right" id="upload_file_btn" data-toggle="collapse" data-target="#form_data">Add Leads</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 collapse" id="form_data">
    <div class="main-form-area-content">
        <div class="col-md-9">
            <div class="wgs-col-9 bg-9">
                <div id="msg_bdy"></div>
                <form class="form-horizontal" id="upload_Form_client"  method="post">
                    <div class="form-group">
                        <label class="col-md-4" for="leads">Leads Label</label>	
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="leads">
                            <div id="error_msg_lead"style="color:red; display:none">*Please fill out this fields</div>
                        </div>
                        	
                    </div>
                    <div class="form-group" id="atch_div">
                        <label class="col-md-4" for="led_discription">Description</label>	
                        <div class="col-md-8">
                        <textarea class="form-control" id="led_discription"></textarea>
                        </div>
                        	
                    </div>
                    <div class="form-group" id="atch_div">
                        <label class="col-md-4" for="date">Date</label>	
                        <div class="col-md-8">
                        <input type="date" class="form-control" id="date">
                        </div>
                        <div id="error_msg" style="text-align: center"></div>	
                    </div>
                    <div class="form-group" id="atch_div">
                        <label class="col-md-4" for="comment">Comment</label>	
                        <div class="col-md-8">
                        <input type="text" class="form-control" id="comment">
                        </div>
                        <div id="error_msg" style="text-align: center"></div>	
                    </div>

                    <div class="form-group" style="text-align: center">
                        <label class="control-label">
                            <input type="submit" class="btn btn-info wgs-btn-cls" id="leads_data" name="submit_role_form" value="submit">
                        </label>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-top:15px;">
        <div class="table-responsive">
            <table class="table table-striped most-popular-table dataTable no-footer" id="full_sales_tbl">
                <thead>
                    <tr>
                        <th class="views-area">#ID</th>
                        <th class="views-area">LABEL</th>
                        <th class="views-area">DATE</th>
                        <th class="views-area">PROPOSAL PREPARE</th>
                        <th class="views-area">PROPOSAL SENT</th>
                        <th class="views-area">FEEDBACK</th>
                        <th class="views-area">OPS</th>
                        <th class="views-area">Action</th>
                    </tr>
                </thead>
                <tbody id="services_tbl_body">
                <?php 
                    $leads_data=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads',null,null,null,null,'allData',null);
                    foreach($leads_data as $val) 
                    {
                        // $product_count=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','packageid',$val->id,null,null,'countData',null);
                        $checked='';
                        $prepare_chk_class='remove';
                        if($val->proposal_prepare==1)
                        {
                            $checked='checked';
                            $prepare_chk_class='ok';
                        }
                        // $proposal_prepare='<label class="switch"><input type="checkbox" '.$checked.' class="prepare" r_id="'.$val->id.'"><span class="slider round"></span></label>';
                        $proposal_prepare='';
                        $checked='';
                        $sent_chk_class='remove';
                        if($val->proposal_sent==1)
                        {
                            $checked='checked';
                            $sent_chk_class='ok';
                        }
                        $proposal_sent='<label class="switch sent"><input type="checkbox" '.$checked.' class="p_sent" r_id="'.$val->id.'"><span class="slider round"></span></label>';
                        $checked='';
                        $feedback_chk_class='remove';
                        if($val->feedback==1)
                        {
                            $checked='checked';
                            $feedback_chk_class='ok';
                        }
                        $proposal_feedback='<label class="switch feedback"><input type="checkbox" '.$checked.' class="p_feedbk" r_id="'.$val->id.'"><span class="slider round"></span></label>';
                        $checked='';
                        $ops_chk_class='remove';
                        if($val->ops==1)
                        {
                            $checked='checked';
                            $ops_chk_class='ok';
                        }
                        $date = fromMySQLDate($val->created_at, $includeTime, $applyClientDateFormat);
                        $ops='<label class="switch ops"><input type="checkbox" '.$checked.' class="p_ops" r_id="'.$val->id.'"><span class="slider round"></span></label>';
                        echo '<tr><td>'.$val->id.'</td><td>'.$val->label.'</td><td>'.$date.'</td><td ><span id="prepare_'.$val->id.'" class="glyphicon glyphicon-'.$prepare_chk_class.'"></span></td><td><span id="sent_'.$val->id.'" class="glyphicon glyphicon-'.$sent_chk_class.'"></span>  </td><td><span id="feedbk_'.$val->id.'" class="glyphicon glyphicon-'.$feedback_chk_class.'"></span>  </td><td><span   id="ops_'.$val->id.'" class="glyphicon glyphicon-'.$ops_chk_class.'"></span> </td><td><button class="btn btn-info markAs" r_id="'.$val->id.'" comment="'.$val->comment.'"><span class="glyphicon glyphicon-cog"></span></button></td></tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>     
    </div>    
</div>

<!-- Modal -->
<div id="P_Modal" class="modal fade full_sale_model" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="full_s_m_h">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="form-group " style="margin-left: 30px;">
                <label class="control-label col-sm-2" for="pwd">Comment:</label>
                <div class="col-sm-6" id="">          
                    <input type="text" name="" id="prop_comment" class="form-control" disabled>
                </div>
                </div>
              <!-- <div class="col-md-6"><input type="text" class="form-control"></div> -->
          </div>          
        <form class="form-horizontal"  id="proposal_form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label col-sm-7" for="email">Propasal Prepare:</label>
                        <div class="col-sm-4" id="prepare_div">
                          
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-7" for="pwd">Propasal Sent:</label>
                    <div class="col-sm-4" id="sent_div">          
                    
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">        
                        <label class="control-label col-sm-7" for="pwd">Feedback:</label>
                        <div class="col-sm-4" id="feedbk_div">          
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">        
                        <label class="control-label col-sm-7" for="pwd">Ops:</label>
                        <div class="col-sm-4" id="ops_div">          
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-sm-4" for="email">Propasal Prepare:</label>
                <div class="col-sm-6" id="prepare_div">
                   
                </div>
                
            </div> -->
            <!-- <div class="form-group">
            <label class="control-label col-sm-4" for="pwd">Propasal Sent:</label>
            <div class="col-sm-6" id="sent_div">          
               
            </div>
            </div> -->
           
            
            <!-- <div class="form-group">        
            <div class="col-sm-offset-4 col-sm-6">
                <button type="submit" class="btn btn-info" id="propasal_submit">Submit</button>
            </div>
            </div> -->
        </form>
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" id="propasal_submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>