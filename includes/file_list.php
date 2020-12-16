<?php 
    $userid=$_GET['id'];
    // $datasur_obj=new Datasur_clients\Datasur();
    $counter=$datasur_obj->wgs_fetch_table_record_datasur('datasur_clientsfile','userid',$userid,null,null,'countData',null);
    $name=$_GET['name'];
?>
<script>   
    var userid=<?php echo $userid ?>;
    counter=<?php echo $counter?>;
    console.log(counter);
</script>
<div class="wgsContainer listpagecat">
    <div class="row">
        <div class="col-md-12">
			<div class="navbarBase">
				<div class="col-md-12 wgs-nb">
					<div class="col-md-10">
						<div class="n-base">
                            <h4><strong><?php echo ucfirst($name) ?></strong></h4>
						</div>
					</div>
					<div class="col-md-2">
						 <button  class="btn btn-info pull-right" id="upload_file_btn" data-toggle="collapse" data-target="#form_data">Upload File</button>
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
                                <label class="col-md-4" for="discription">Description</label>	
                                <div class="col-md-8">
                                    <textarea class="form-control" id="discription"></textarea>
                                </div>	
                            </div>
                            <div class="form-group" id="atch_div">
                                <label class="col-md-4" for="file">Attachment </label>	
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="file"/>
                                </div>
                                <div id="error_msg" style="text-align: center"></div>	
                            </div>

                            <div class="form-group" style="text-align: center">
                                <label class="control-label">
                                    <input type="submit" class="btn btn-info wgs-btn-cls" id="upload_file" name="submit_role_form" value="Upload">
                                    <input type="submit" class="btn btn-info wgs-btn-cls" id="save_desc"  value="Save" style="display:none">
                                </label>
							</div>

                        </form>
                    </div>    
               </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:13px;">
            <div class="table-responsive">
                <table class="table table-striped most-popular-table dataTable no-footer" id="file_tbl">
                    <thead>
                        <tr>
                            <th class="views-area">#ID</th>
                            <th class="views-area">DESCRIPTION</th>
                            <th class="views-area">DATE</th>
                            <th class="views-area">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // $get_client_files=$datasur_obj->get_client_files($userid); 
                            $get_client_files=$datasur_obj->wgs_fetch_table_record_datasur('datasur_clientsfile','userid',$userid,null,null,'userFileData',null); 
                            foreach($get_client_files as $val) {
                                $description=$val->description;
                                $len=strlen($description);
                                if($len>35)
                                {
                                    $description=substr($description,0,35);
                                    $description=$description.'...';
                                }
                                $desc=wordwrap($description,20,"<br>\n");
                                echo '<tr><td>'.$val->id.'</td><td>'.$desc.' 
                                </td><td>'.$val->created_at.'</td><td ><span class="flat-icon-cls"><a class="edit" desc="'.$val->description.'" data-toggle="collapse" data-target="#form_data"><i class="fa fa-pencil fe" aria-hidden="true"></i></a></span> <span class="flat-icon-cls"><a class="delete"><i class="fa fa-trash fe" aria-hidden="true" style="color=red;"></i></a></span> <span class="flat-icon-cls"><a class="" href="../modules/addons/datasurmanagement/uploads/'.$val->file_name.'" download><i class="fa fa-download fe" aria-hidden="true"></i></a></span> </td></tr>';

                                // <span class="flat-icon-cls"><a class="btn btn-info dwnld" href="../modules/addons/datasurmanagement/uploads/'.$val->file_name.'" download
                                // ><i class="fa fa-download fa-lg" aria-hidden="true"></i></a></span>
                                
                            }
                        ?>  
                    </tbody>
                </table>
            </div>
                  
        </div>    
    </div>
</div>