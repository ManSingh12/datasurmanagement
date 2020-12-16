<?php
    // use Datasur_clients;
    $request=$_POST['request'];
    // $datasur_obj=new Datasur_clients\Datasur();
    // if($request =='upload')
    // {
    //     $userid=$_POST['id'];
    //     $counter=$_POST['counter'];
    //     $description=$_POST['description'];
    //     $result=$datasur_obj->upload_file($userid,$counter,$description);
    //     echo json_encode($result);
    //     exit;
    // }
    // elseif($request=='client_files')
    // {
    //     $userid=$_POST['userid'];
    //     // echo json_encode("hello");
    //     $get_client_files=$datasur_obj->get_client_files($userid);
    //     echo json_encode($get_client_files);
    //     exit;
    
    // }
    // elseif($request=='update_descpn')
    // {
    //     $fileid=$_POST['fileid'];
    //     $description=$_POST['desc'];
    //     $result=$datasur_obj->update_description($fileid,$description);
    //     echo json_encode($result);
    //     exit;
    // }
    // elseif($request=="delete_file")
    // {
    //     $fileid=$_POST['fileid'];
    //     $result=$datasur_obj->delete_file($fileid);
    //     echo json_encode($result);
    //     exit;
    // }


    switch ($request) {
        case "upload":
            $userid=$_POST['id'];
            $counter=$_POST['counter'];
            $description=$_POST['description'];
            $result=$datasur_obj->upload_file($userid,$counter,$description);
            echo json_encode($result);
            exit;
        case "update_descpn":
            $fileid=$_POST['fileid'];
            $description=$_POST['desc'];
            $result=$datasur_obj->wgs_fetch_table_record_datasur('datasur_clientsfile','id',$fileid,'description',$description,'update',null);
            echo json_encode($result);
            exit;
        case "delete_file":
            $fileid=$_POST['fileid'];
            $file_name=$datasur_obj->wgs_fetch_table_record_datasur('datasur_clientsfile','id',$fileid,null,null,'singleRowData',null);
            $res=unlink(dirname(__DIR__)."/uploads"."/".$file_name->file_name."");
            $result=$datasur_obj->wgs_fetch_table_record_datasur('datasur_clientsfile','id',$fileid,null,null,'deleteRow',null);
            echo json_encode($result);
            exit;
        case "filter_sales":
            $dateFrom=$_POST['dateFrom'];
            $dateTo=$_POST['dateTo'];
            if($dateTo=='')
            {
                $dateTo=date("Y-m-d");
            }
            $betweendate=['dateColomn'=>'date','dateFrom'=>$dateFrom,'dateTo'=>$dateTo];
            $invoice_details= $datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',null,null,null,'allDataUnik',$betweendate);
            $append='';
            foreach($invoice_details as $val) {
                $total_paid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Paid','countDataDoubleCondition',$betweendate);
                $total_unpaid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Unpaid','countDataDoubleCondition',$betweendate);
                $total_terminated_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Cancelled','countDataDoubleCondition',$betweendate); 
                $append.= '<tr><td>'.$val->userid.'</td><td>'.$total_paid_invoice.'</td><td>'.$total_unpaid_invoice.' 
                </td><td>'.$total_terminated_invoice.'</td></tr>';
            }
            echo json_encode($append);
            exit; 
            case "filter_services":
                $dateFrom=$_POST['dateFrom'];
                $dateTo=$_POST['dateTo'];
                if($dateTo=='')
                {
                    $dateTo=date("Y-m-d");
                }
                $betweendate=['dateColomn'=>'regdate','dateFrom'=>$dateFrom,'dateTo'=>$dateTo];
                $service_details= $datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',null,null,null,'allDataUnik',$betweendate);
                $append='';
                foreach($service_details as $val) {
                    $total_services=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',$val->userid,'domainstatus','Active','countDataDoubleCondition',$betweendate);
                    // $total_unpaid_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Unpaid','countDataDoubleCondition',$betweendate);
                    // $total_terminated_invoice=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','userid',$val->userid,'status','Cancelled','countDataDoubleCondition',$betweendate); 
                    $lead_time=0;
                    $append.= '<tr><td>'.$val->userid.'</td><td>'.$total_services.'</td><td>'.$val->regdate.' 
                    </td><td>'.$lead_time.'</td></tr>';
                }
                $betweendate=['dateColomn'=>'registrationdate','dateFrom'=>$dateFrom,'dateTo'=>$dateTo];
                $domain_details= $datasur_obj->wgs_fetch_table_record_datasur('tbldomains','userid',null,null,null,'allDataUnik',$betweendate);
                $append2='';
                foreach($domain_details as $val)
                {
                    $append2.= '<tr><td>'.$val->userid.'</td><td>'.$val->id.'</td><td>'.$val->domain.' 
                    </td><td>'.$val->registrationdate.'</td><td>'.$lead_time.'</td></tr>';
                }
                $response['append']=$append;
                $response['append2']=$append2;
                echo json_encode($response);
                exit; 
                case "user_service_status":
                    $userid=$_POST['userid'];
                    $user=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','userid',$userid,null,null,'userFileData',null);
                    $append='';
                    foreach($user as $val) {
                        $services=$datasur_obj->wgs_fetch_table_record_datasur('tblproducts','id',$val->packageid,null,null,'singleRowData',null);
                        
                        $append.='<tr><td>'.$val->userid.'</td><td>'.$services->name.'</td><td>'.$val->regdate.'</td><td>'.$val->domainstatus.'</td></tr>';
                    }
                    echo json_encode($append);
                    exit;
                case "product_status":
                    $gid=$_POST['gid'];
                    $products=$datasur_obj->wgs_fetch_table_record_datasur('tblproducts','gid',$gid,null,null,'userFileData',null);
                    $append='';
                    foreach($products as $val) 
                    {
                        $product_count=$datasur_obj->wgs_fetch_table_record_datasur('tblhosting','packageid',$val->id,null,null,'countData',null);
                        $append.= '<tr><td>'.$val->id.'</td><td>'.$val->name.'</td><td>'.$product_count.'</td></tr>';
                    }
                    echo json_encode($append);
                    exit;
                case "filter_mrktng_invo":
                    $dateFrom=$_POST['dateFrom'];
                    $dateTo=$_POST['dateTo'];
                    if($dateTo=='')
                    {
                        $dateTo=date("Y-m-d");
                    }
                    $betweendate=['dateColomn'=>'date','dateFrom'=>$dateFrom,'dateTo'=>$dateTo];

                    $paid_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Paid',null,null,'countData',$betweendate);
                    $pending_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Unpaid',null,null,'countData',$betweendate);
                    $refund_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Refunded',null,null,'countData',$betweendate);
                    $cancle_invo=$datasur_obj->wgs_fetch_table_record_datasur('tblinvoices','status','Cancelled',null,null,'countData',$betweendate);
                    $response['paid_invo']=$paid_invo;
                    $response['pending_invo']=$pending_invo;
                    $response['refund_invo']=$refund_invo;
                    $response['cancle_invo']=$cancle_invo;
                    echo json_encode($response);
                    exit;
                case "insert_leads_data":
                    $leads=$_POST['leads'];
                    $desc=$_POST['description'];
                    $date=$_POST['date'];
                    if($date=='')
                    {
                        $date=date("Y-m-d");
                    }
                    $comment=$_POST['comment'];
                    $insert_array = [
                        "label" => $leads,
                        "description" => $desc,
                        "comment"=>$comment,
                        "created_at"=>$date,
                    ];
                    $response=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads',$insert_array,null,null,null,'inserData',null);
                    echo json_encode($response);
                    exit;
                case "chk_unchk_req":
                    $r_id=$_POST['r_id'];
                    $pre_val=$_POST['pre_val'];
                    $sent_val=$_POST['sent_val'];
                    $p_fdk=$_POST['p_fdk'];
                    $p_op=$_POST['p_op'];

                    // $chk_val=$_POST['chk_val'];
                    // $r_id=$_POST['r_id'];
                    // $tbl_column_name=$_POST['tbl_column_name'];
                    $response=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads','id',$r_id,'proposal_prepare',$pre_val,'update',null);
                    $response=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads','id',$r_id,'proposal_sent',$sent_val,'update',null);
                    $response=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads','id',$r_id,'feedback',$p_fdk,'update',null);
                    $response=$datasur_obj->wgs_fetch_table_record_datasur('datasur_tblleads','id',$r_id,'ops',$p_op,'update',null);
                    echo json_encode($response);
                    exit;
            // $result=$datasur_obj->filter_
        default:
         
      }

?>






