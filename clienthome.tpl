
{* {if $loggedin}
    {include file="$template/includes/sidebar.tpl"}
{/if} *}

{* {$template} *}
{* {include file="$template/includes/test.tpl"} *}
<div class="table-container clearfix">
    <div class="row" id="user_details_div">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-list dataTable no-footer dtr-inliner" id="client_details_tbl">
                    <thead>
                        <tr>
                            <th class="views-area">S.NO </th>
                            <th class="views-area">NAME </th>
                            <th class="views-area">DATE</th>
                            <th class="views-area">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="kpi_tbl_body">
                    
                        {foreach $details as $key => $val}
                            <tr>
                                <td class="text-center"> 
                                    {$key+1}
                                </td>
                                <td class="text-center">
                                    {$val->description}
                                </td>
                                <td class="text-center">
                                    {$val->updated_at|date_format:"%d/%m/%Y"}
                                    
                                </td>
                                <td class="text-center">
                                    <a class="" href="../whmcs/modules/addons/datasurmanagement/uploads/{$val->file_name}" download><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        {/foreach }
                        
                    </tbody>
                </table>
            </div>
                    
        </div>    
    </div>
</div>

<script>
    jQuery('#client_details_tbl').DataTable({
        "dom": '<"top"fi>rt<"bottom"pl><"clear">',
        language: { search: "" },
    });
</script>
