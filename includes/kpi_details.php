<?php
    function date_diff_fun($date1,$date2)
    {
        $date1 = strtotime($date1);  
        $date2 = strtotime($date2);  
        $diff = abs($date2 - $date1);  
        $years = floor($diff / (365*60*60*24));  
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
        $hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24)/ (60*60));  
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);  
        $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
        $date='';
        if($years!=0)
        {
            if($years==1)
            {
                $date=$years. ' Year';
            }
            else
            {
                $date=$years. ' Years';
            }
            
        } 
        if($months!=0)
        {
            if($months==1)
            {
                $date=$date .' '.$months. ' Month';  
            }
            else{
                $date=$date .' '.$months. ' Months'; 
            }
            
        }
        if($days!=0)
        {
            if($days==1)
            {
                $date=$date .' '.$days. ' Day'; 
            }
            else{
                $date=$date .' '.$days. ' Days';
            }
        }
        if($hours!=0)
        {
            if($hours==1)
            {
                $date=$date .' '.$hours. ' Hour'; 
            }
            else{
                $date=$date .' '.$hours. ' Hours'; 
            }
            
        }
        if($minutes!=0)
        {
            if($minutes==1)
            {
                $date=$date .' '.$minutes. ' Minute';
            }
            else{
                $date=$date .' '.$minutes. ' Minutes'; 
            }
            
        }
        if($seconds==1)
        {
            $date=$date .' '.$seconds. ' Second'; 
        }
        else{
            $date=$date .' '.$seconds. ' Seconds'; 
        }
        
        return $date;
        
        // printf("%d years, %d months, %d days, %d hours, ". "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds);
    }
    // date_diff_fun();
?>

<h2 style="margin-left:40px;"><strong>KPI DETAILS</strong></h2>
<div class="row" id="kpi_tbl_div">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped most-popular-table dataTable no-footer" id="kpi_tbl">
                    <thead>
                        <tr>
                            <th class="views-area">#ID</th>
                            <th class="views-area">TICKET ID</th>
                            <th class="views-area">DEPARTMENT NAME </th>
                            <th class="views-area">DATE</th>
                            <th class="views-area">REPAIR TIME</th>
                        </tr>
                    </thead>
                    <tbody id="kpi_tbl_body">
                       <?php
                            $kpi_details=$datasur_obj->wgs_fetch_table_record_datasur('tbltickets',null,null,null,null,'allData',null);
                            foreach($kpi_details as $val)
                            {
                                $repair_time=date_diff_fun($val->date,$val->lastreply);
                                $department_name=$datasur_obj->wgs_fetch_table_record_datasur('tblticketdepartments','id',$val->did,null,null,'singleRowData',null);
                                $date = fromMySQLDate($val->date, $includeTime, $applyClientDateFormat);
                                echo '<tr><td><a href="../admin/supporttickets.php?action=view&id='.$val->id.'">#'.$val->id.'</a></td><td><a href="../admin/supporttickets.php?action=view&id='.$val->id.'">'.$val->tid.'</a></td><td> '.$department_name->name.'</td><td>'.$date.'</td><td>'.$repair_time.'</td></tr>';
                            }
                       ?>
                    </tbody>
                </table>
            </div>
                  
        </div>    
    </div>