<div class="table-responsive">
    <table id="example" class="table table-striped most-popular-table dataTable no-footer">
        <thead>
            <tr>
                <th class="views-area">#ID</th>
                <th class="views-area">USERNAME</th>
                <th class="views-area">EMAIL</th>
                <th class="views-area">TOTAL INVOICES</th>
                <th class="views-area">TOTAL QUOTES</th>
                <th class="views-area">FIND US FROM</th>
                <th class="views-area">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // $datasur_obj=new Datasur_clients\Datasur();
                $clients= $datasur_obj->wgs_fetch_table_record_datasur('tblclients',null,null,null,null,'allData',null);  
                // echo $clients;
                // die();
                foreach($clients as $val) {
                    $total_invoices=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->id,null,null,'countData',null);
                    $total_quotes=$datasur_obj->wgs_fetch_table_record_datasur('tblquotes','userid',$val->id,null,null,'countData',null);
                    // $counter=$datasur_obj->get_file_count($val->id);
                    $fieldid=$datasur_obj->wgs_fetch_table_record_datasur('tblcustomfields','fieldname','%How_did_you_Find_us%',null,null,'whereLike',null);
                    
                    $findUsFrom=$datasur_obj->wgs_fetch_table_record_datasur('tblcustomfieldsvalues','relid',$val->id,'fieldid',$fieldid->id,'doubleRowData',null);
                    $name=$val->firstname;
                    // echo $counter;
                    // echo '<tr><td>'.$val->firstname.' '.$val->lastname.'</td><td>'.$val->email.'</td><td>'.$val->companyname.'</td><td>'.$val->country.'</td><td>'.$val->phonenumber.'</td><td class="text-center">'.$total_orders.'</td><td><button type="button"  class="btn btn-primary mb-2 pdf_uplod_tbl" id="'.$val->id.'" counter="'.$counter.'"><i class="fa fa-upload" aria-hidden="true"></i></button><a  ><i class="fa fa-eye" aria-hidden="true" id="'.$val->id.'" ></i></a></td></tr>';
                    echo '<tr><td><a href="../admin/clientssummary.php?userid='.$val->id.'">#'.$val->id.'</a></td><td>'.$val->firstname.' '.$val->lastname.'</td><td>'.$val->email.'</td><td>'.$total_invoices.'</td><td>'.$total_quotes.'</td><td>'.$findUsFrom->value.'</td><td><a href='.$modulelink.'&action=file_list&id='.$val->id.'&name='.$name.'><button type="button"  class="btn btn-primary mb-2 pdf_uplod_tbl" id="'.$val->id.'" >View</button></a></td></tr>';


                }
            ?>  
        </tbody>        
    </table>
</div>
<!-- model for upload pdf -->
<div class="modal fade" id="myModal_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Upload PDF File</h5>
                
            </div>
            <div class="modal-body">
                <div id="msg_bdy"></div>
                <form>
                    <div class="form-group">
                        <label id="Image_input" for="Image" class="col-form-label">Pdf File:</label>
                        <input type="file" class="form-control" id="upload_cv" name="upload_cv" accept=".pdf">
                    </div>
                    <!-- <div id="error_msg"></div> -->
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="upload_file" type="button" class="btn btn-primary" >Upload</button>
            </div>
        </div>
    </div>
</div>
<!-- end model -->
<!-- model for user info -->
<div class="modal fade" id="myModal_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="client_info_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- <h5 class="modal-title" id="exampleModalLabel">Client Informations</h5> -->   
            </div>
            <div class="modal-body">
                <h4>Files:</h4>
                <ul id="client_file_list">
                   
                </ul>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button id="upload_file" type="button" class="btn btn-primary" >Upload</button> -->
            </div>
        </div>
    </div>
</div>
<!-- end model -->
