<?php
    namespace Datasur_namespace;
    use WHMCS\Database\Capsule;
    
    class Datasur
    {
        // function get_clients()
        // {
        //     $clients =  Capsule::table('tblclients')->get(); 
        //     return $clients; 
        // }
        // function get_total_services($id)
        // {
        //     $total_services= Capsule::table('tblhosting')->where('userid', $id)->where('domainstatus', 'Active')->count();
        //     return $total_services;
        // }
        // function get_file_count($id)
        // {
        //     $total_services= Capsule::table('datasur_clientsfile')->where('userid', $id)->count();
        //     return $total_services;
        // }
        // function get_client_files($id){
        //     $client_files =  Capsule::table('datasur_clientsfile')->where('userid', $id)->get(); 
        //     return $client_files;
        // }
        // function update_description($fileid,$description)
        // {
        //     $current_time=date("Y-m-d h:i:sa");
        //     $client_files =  Capsule::table('datasur_clientsfile')->where('id', $fileid)->update(array('description' => $description,'updated_at'=>$current_time));
        //     return $client_files;
        // }
        // function delete_file($fileid){
        //     $file_name =  Capsule::table('datasur_clientsfile')->where('id', $fileid)->get();
        //     foreach($file_name as $value) {
        //         $fname= $value->file_name;
        //     }
        //     $res=unlink(dirname(__DIR__)."/uploads"."/".$fname."");
        //     $result= Capsule::table('datasur_clientsfile')->where('id', $fileid)->delete();
        //     return $result;
        // }
        function upload_file($userid,$counter,$description)
        {
            $filetype=basename($_FILES["file"]["type"]);
            if($filetype=='pdf')
            {
                $target_dir = "".dirname(__DIR__)."/uploads"."/";
                $uploadOk = 1;
                $fileName=" Invoice_".$userid."_".$counter.".pdf";
                $target_file = $target_dir.$fileName;
                if (!file_exists($target_dir)) 
                {
                    mkdir("".dirname(__DIR__)."/uploads"."/", 0777);  
                }
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
                {
                    $response['result']=true;
                    $current_time=date("Y-m-d h:i:sa");
                    $response['msg']="The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
                    $insert_array = [
                        "userid" => $userid,
                        "file_name" => $fileName,
                        "description"=>$description,
                        "created_at"=>$current_time,
                        "updated_at"=>$current_time,
                    
                    ];
                    $res=Capsule::table('datasur_clientsfile')->insert($insert_array);
                    $response['res']=$res;
                    return $response;
                } 
                else 
                {
                    $response['result']=false;
                    $response['msg']="Sorry, there was an error uploading your file.";
                    return $response;
                }
            }
            else
            {
                $response['result']=false;
                $response['msg']='Please upload .pdf file';
                return $response;
            }
            
        }
        // function total_invoice($userid)
        // {
        //     $total_invoice =  Capsule::table('tblinvoices')->where('userid', $userid)->count();
        //     return $total_invoice;
        // }
        // function total_quotes($userid)
        // {
        //     $total_quotes =  Capsule::table('tblquotes')->where('userid', $userid)->count();
        //     return $total_quotes;
        // }
        public function wgs_fetch_table_record_datasur($tableName,$condtioncolumn,$condtionvalue,$condtioncolumn1,$condtionvalue2,$for,$betweendate){
            if($for == 'allData'){
            $allRecord = Capsule::table($tableName)->get();
            }elseif($for == 'singleRowData'){
            $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->first();
            }elseif($for == 'whereLike'){
                $allRecord = Capsule::table($tableName)->where($condtioncolumn,'like',$condtionvalue)->first();
            }
            elseif($for == 'doubleRowData'){
                $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->where($condtioncolumn1,$condtionvalue2)->first();
            }elseif($for == 'countData'){
                if($betweendate!=null)
                {
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->whereBetween($betweendate['dateColomn'],[$betweendate['dateFrom'], $betweendate['dateTo']])->count();
                }
                else{
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->count();
                }
              
            }elseif($for == 'deleteRow'){
            $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->delete();
            }elseif($for == 'userFileData'){
                $allRecord =  Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->get(); 
            }elseif($for == 'update'){
                $current_time=date("Y-m-d h:i:sa");
                $allRecord =  Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->update(array($condtioncolumn1 => $condtionvalue2,'updated_at'=>$current_time));
            }elseif($for=='countDataDoubleCondition'){
                if($betweendate!=null){
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->where($condtioncolumn1,$condtionvalue2)->whereBetween($betweendate['dateColomn'],[$betweendate['dateFrom'], $betweendate['dateTo']])->count();
                }else{
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn,$condtionvalue)->where($condtioncolumn1,$condtionvalue2)->count();
                }   
            }elseif($for=='allDataUnik'){
                if($betweendate!=null){
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn1,$condtionvalue2)->whereBetween($betweendate['dateColomn'],[$betweendate['dateFrom'], $betweendate['dateTo']])->get()->unique($condtioncolumn);
                }else{
                    $allRecord = Capsule::table($tableName)->where($condtioncolumn1,$condtionvalue2)->get()->unique($condtioncolumn);
                }   
            }elseif ($for=='inserData') {
                $allRecord=Capsule::table($tableName)->insert($condtioncolumn);
            }
            return $allRecord;
        }    
    }
    // class Sales{
    //     function invoice_details()
    //     {
    //         $total_invoice =  Capsule::table('tblinvoices')->get();
    //         return $total_invoice;
    //     }
    //     function total_paid_invoice($userid)
    //     {
    //         $total_paid_invoice =  Capsule::table('tblinvoices')->where('userid', $userid)->where('status','Paid')->count();
    //         return $total_paid_invoice;
    //     }
    //     function total_unpaid_invoice($userid)
    //     {
    //         $total_unpaid_invoice =  Capsule::table('tblinvoices')->where('userid', $userid)->where('status','Unpaid')->count();
    //         return $total_unpaid_invoice;
    //     }
    //     function total_terminated_invoice($userid)
    //     {
    //         $total_terminated_invoice =  Capsule::table('tblinvoices')->where('userid', $userid)->where('status','Cancelled')->count();
    //         return $total_terminated_invoice;
    //     }
    //     function invoice_filter($dateFrom,$dateTo)
    //     {
    //         $total_invoice =  Capsule::table('tblinvoices')->whereBetween('date', [$dateFrom, $dateTo])->get();
    //         return $total_invoice;
    //     }
    // }
?>