jQuery(document).ready(function() {
    jQuery('#example').DataTable({
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [6] },
            { "bSearchable": false, "aTargets": [6] }
        ]
    });
    jQuery('#domain_tbl').DataTable();
    jQuery('#kpi_tbl').DataTable();
    jQuery("#file_tbl").DataTable({
        order: [
            [0, "desc"]
        ]
    });
    jQuery("#full_sales_tbl").DataTable({
        order: [
            [0, "desc"]
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [7] },
            { "bSearchable": false, "aTargets": [7] }
        ]
    });
    jQuery('#contact_tbl').DataTable();
    jQuery('#sales_tbl').DataTable();
    jQuery('#user_most_serv_tbl').DataTable({
        order: [
            [2, "desc"]
        ]
    });
    jQuery('#product_tbl').DataTable({
        order: [
            [2, "desc"]
        ]
    });
    $('#upload_Form_client').submit(function(evt) {
        evt.preventDefault(); // to stop form submitting
    });
    $('#filrt_user_form').submit(function(evt) {
        evt.preventDefault(); // to stop form submitting
    });
    $('#product_form').submit(function(evt) {
        evt.preventDefault(); // to stop form submitting
    });
    $('#service_date').submit(function(evt) {
        evt.preventDefault(); // to stop form submitting
    });
    $('#proposal_form').submit(function(evt) {
        evt.preventDefault(); // to stop form submitting
    });

    var id = 0;
    var counter = 0;
    var file_id = 0;
    var p_rid = 0;
});

function append_client_files(response) {
    var append = '';
    jQuery.each(response, function(i, val) {
        append += '<a href="../modules/addons/datasurmanagement/uploads/' + val.file_name + '" download><li>' + val.file_name + '</li></a>';

    });
    jQuery('#client_file_list').empty();
    jQuery('#client_file_list').append(append);
}

function goBack() {
    window.history.back();
}
jQuery(document).on('click', '.edit', function() {
    // alert('Hello');
    // jQuery('#form_data').show();
    jQuery('#atch_div').hide();
    jQuery('#upload_file').hide();
    jQuery('#save_desc').show();
    var despn = jQuery(this).attr('desc');
    jQuery('#discription').val(despn);
    file_id = jQuery(this).closest("tr").find("td:nth-child(1)").text();
    // console.log(file_id);
})
jQuery(document).on('click', '#save_desc', function() {
    var desc = jQuery('#discription').val();
    var self = this;
    jQuery(self).val('Loading...');
    jQuery.ajax({
        url: "",
        type: 'POST',
        data: { 'request': 'update_descpn', 'desc': desc, 'fileid': file_id },
        dataType: "json",
        success: function(data) {
            if (data == 1) {
                jQuery(self).val('Save');
                swal("Updated!", {
                    title: "Updated!",
                    text: "Your Description has been Updated!",
                    icon: "success",
                    className: "reloade_confom",
                });
            }
        },
        error: function(data) {
            alert('Error Occurred');
        }
    });
})
jQuery(document).on('click', '.reloade_confom .swal-button--confirm', function() {
    location.reload();
})
jQuery(document).on('click', '.delete', function() {
    file_id = jQuery(this).closest("tr").find("td:nth-child(1)").text();
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                jQuery.ajax({
                    url: "",
                    type: 'POST',
                    data: { 'request': 'delete_file', 'fileid': file_id },
                    dataType: "json",
                    success: function(data) {
                        if (data == 1) {
                            swal("Deleted!", {
                                title: "Deleted!",
                                text: "Your file has been deleted!",
                                icon: "success",
                                className: "reloade_confom",
                            });
                        }
                    },
                    error: function(data) {
                        alert(data);
                    }
                });
            } else {
                //   swal("Your file is safe!");
            }
        });
})

function validate_file() {
    var file_err = 'file_err';
    var upload_cv = jQuery('#upload_cv');
    var file = jQuery('#file')[0].files[0]
        //hide previous error
    jQuery("#" + file_err).html("");

    if (file == undefined) {
        jQuery('#error_msg').append('<span id=' + file_err + '><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please upload(.pdf) File</p></span>');
        return false;
    } else {
        jQuery("#" + file_err).html("");
    }
    // console.log(file.size);
    var fileType = file.type; // holds the file types

    var match = ["application/pdf"]; // defined the file types
    var fileSize = file.size; // holds the file size
    var maxSize = 2 * 1024 * 1024; // defined the file max size
    if (!((fileType == match[0]) || (fileType == match[1]))) {
        upload_cv.val("");
        jQuery('#error_msg').append('<span id=' + file_err + '><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please select a valid (.pdf) file.</p></span>');
        return false;
    } else {
        jQuery("#" + file_err).html("");
    }
    if (fileSize > maxSize) {
        upload_cv.val("");
        jQuery('#error_msg').append('<span id=' + file_err + '><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please select a file less than 2mb of size.</p></span>');
        return false;
    } else {
        jQuery("#" + file_err).html("");
    }
}
jQuery(document).on('click', '#upload_file', function() {
    var result = validate_file();
    var self = this;
    var description = jQuery("#discription").val();
    console.log(counter);
    counter++;
    if (result != false) {
        debugger;
        jQuery(self).prop("disabled", true);
        // var self=this;
        jQuery(self).val('Loading...');
        jQuery(self).html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...`
        );
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        formData.append('request', 'upload');
        formData.append('id', userid);
        formData.append('counter', counter);
        formData.append('description', description);
        jQuery.ajax({
            url: "",
            type: 'POST',
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            dataType: "json",
            success: function(data) {
                jQuery(self).text('Upload');
                jQuery(self).prop("disabled", false);
                jQuery(self).val('Upload');
                // $(self).text('Upload')
                console.log(data);
                if (data['result'] == true) {
                    jQuery('#msg_bdy').empty();
                    swal("Success!", {
                        title: "Success!",
                        text: "Your file has been uploaded successfully!",
                        icon: "success",
                        className: "reloade_confom",
                    });
                } else {
                    jQuery('#msg_bdy').empty();
                    swal("Error!", {
                        title: "Error!",
                        text: data['msg'],
                        icon: "error",
                        className: "reloade_confom",
                    });
                    // jQuery('#msg_bdy').append('<div class="alert alert-danger"><strong>Error!</strong> '+data['msg']+'</div>');
                }

            },
            error: function() {
                alert('Error Occurred');
            }
        });
    }
})
jQuery(document).on('click', '#upload_file_btn', function() {
    // jQuery('#form_data').show();
    jQuery('#atch_div').show();
    jQuery('#upload_file').show();
    jQuery('#save_desc').hide();
    jQuery('#discription').val('');
})
jQuery(document).on('click', '#filter_invoice_date', function() {

    var dateFrom = jQuery('#date_from').val();
    var dateTo = jQuery('#date_to').val();

    if (dateFrom == '') {
        jQuery('#date_from_error').show();
        jQuery('#date_from').css('outline', 'none !important');
        jQuery('#date_from').css('box-shadow', '0px 0px 1px 1px red')


    } else {
        // debugger;
        jQuery('#date_from_error').hide();
        jQuery('#date_from').css('outline', '');
        jQuery('#date_from').css('box-shadow', '')
        $('#sales_tbl').dataTable().fnClearTable();
        $('#sales_tbl').dataTable().fnDraw();
        $('#sales_tbl').dataTable().fnDestroy();
        jQuery('#sales_tbl_body').html();
        jQuery('#sales_tbl_body').append('<div class="loading"></div>');
        jQuery.ajax({
            url: "",
            type: 'POST',
            data: { 'request': 'filter_sales', 'dateFrom': dateFrom, 'dateTo': dateTo },
            dataType: "json",
            success: function(data) {
                jQuery('#sales_tbl_body').empty();
                jQuery('#sales_tbl_body').append(data);
                jQuery('#sales_tbl').DataTable();

            },
            error: function(data) {
                alert(data);
            }
        });
    }
    // console.log(dateFrom);
    // console.log(dateTo);
})
jQuery(document).on('click', '#filter_services_date', function() {
    var dateFrom = jQuery('#date_from').val();
    var dateTo = jQuery('#date_to').val();

    if (dateFrom == '') {
        jQuery('#date_from_error').show();
        jQuery('#date_from').css('outline', 'none !important');
        jQuery('#date_from').css('box-shadow', '0px 0px 1px 1px red')
    } else {
        // debugger;
        jQuery('#date_from_error').hide();
        jQuery('#date_from').css('outline', '');
        jQuery('#date_from').css('box-shadow', '')
        $('#sales_tbl').dataTable().fnClearTable();
        $('#sales_tbl').dataTable().fnDraw();
        $('#sales_tbl').dataTable().fnDestroy();
        jQuery('#services_tbl_body').html();
        jQuery('#services_tbl_body').append('<div class="loading"></div>');
        jQuery.ajax({
            url: "",
            type: 'POST',
            data: { 'request': 'filter_services', 'dateFrom': dateFrom, 'dateTo': dateTo },
            dataType: "json",
            success: function(data) {
                jQuery('#services_tbl_body').empty();
                jQuery('#domain_tbl_body').empty();
                jQuery('#services_tbl_body').append(data['append']);
                jQuery('#domain_tbl_body').append(data['append2']);
                jQuery('#sales_tbl').DataTable();

            },
            error: function(data) {
                alert(data);
            }
        });
    }
    // console.log(dateFrom);
    // console.log(dateTo);
})
jQuery(document).on('click', '.sevices_header_cls', function() {
    jQuery('.sevices_header_cls').css("color", "");
    jQuery(this).css("color", "#4d8ac7");
    var val = jQuery(this).attr('value');
    if (val == 'services_report_most') {
        jQuery('#service_rept').hide();
        jQuery('#client_mst_serv').show();
        jQuery('#top_sold_div').hide();
    } else if (val == 'services_report') {
        jQuery('#client_mst_serv').hide();
        jQuery('#service_rept').show();
        jQuery('#top_sold_div').hide();
    } else if (val == 'top_sold_services') {
        jQuery('#service_rept').hide();
        jQuery('#client_mst_serv').hide();
        jQuery('#top_sold_div').show();
    }
})
jQuery(document).on('click', '.user_name', function() {
    var user_id = jQuery(this).attr('userid');
    // console.log(user_id);
    jQuery.ajax({
        url: "",
        type: 'POST',
        data: { 'request': 'user_service_status', 'userid': user_id },
        dataType: "json",
        success: function(data) {
            jQuery('#users_most_service_div').hide();
            jQuery('#user_service_name_tbl_body').empty();
            jQuery('#user_service_name_tbl_body').append(data);
            jQuery('#user_serv_tbl').DataTable();
            jQuery('#user_service_div').show();


        },
        error: function(data) {
            alert(data);
        }
    });
})
jQuery(document).on('click', '#filter__users', function(e) {

    jQuery('#user_service_div').hide();
    jQuery('#users_most_service_div').show();
})
jQuery(document).on('click', '.product_name', function() {
    var gid = jQuery(this).attr('gid');
    var name = jQuery(this).attr('name');
    jQuery('#prd_grp_btn').text();
    jQuery('#prd_grp_btn').text(name);
    jQuery('#prd_grp_btn').append('<span class="caret"></span>');
    // console.log(gid);
    // gid = 2;
    $('#product_tbl').dataTable().fnClearTable();
    $('#product_tbl').dataTable().fnDraw();
    $('#product_tbl').dataTable().fnDestroy();
    jQuery('#product_tbl_body').append('<div class="loading"></div>');
    jQuery.ajax({
        url: "",
        type: 'POST',
        data: { 'request': 'product_status', 'gid': gid },
        dataType: "json",
        success: function(data) {
            // debugger;
            // jQuery('#users_most_service_div').hide();
            // jQuery('#product_tbl_body').empty();

            jQuery('#product_tbl_body').append(data);
            jQuery('#product_tbl').DataTable({
                order: [
                    [2, "desc"]
                ]
            });
            // jQuery('#user_service_div').show();


        },
        error: function(data) {
            alert(data);
        }
    });
})
jQuery(document).on('click', '#filter_makt_invoice_date', function() {
    var dateFrom = jQuery('#date_from').val();
    var dateTo = jQuery('#date_to').val();

    if (dateFrom == '') {
        jQuery('#date_from_error').show();
        jQuery('#date_from').css('outline', 'none !important');
        jQuery('#date_from').css('box-shadow', '0px 0px 1px 1px red')
    } else {
        // debugger;
        jQuery('#date_from_error').hide();
        jQuery('#date_from').css('outline', '');
        jQuery('#date_from').css('box-shadow', '')
        $('#sales_tbl').dataTable().fnClearTable();
        $('#sales_tbl').dataTable().fnDraw();
        $('#sales_tbl').dataTable().fnDestroy();
        jQuery('#services_tbl_body').html();
        jQuery('#invo_div').hide();
        // jQuery('#load').append('<div class="loading"></div>');
        jQuery.ajax({
            url: "",
            type: 'POST',
            data: { 'request': 'filter_mrktng_invo', 'dateFrom': dateFrom, 'dateTo': dateTo },
            dataType: "json",
            beforeSend: function() {
                jQuery("#fullpage-overlay").removeClass("hidden");

            },
            success: function(data) {
                // console.log(data);
                jQuery('#invo_div').show();
                jQuery('#paid_inv').empty();
                jQuery('#paid_inv').append(data['paid_invo']);
                jQuery('#pend_inv').empty();
                jQuery('#pend_inv').append(data['pending_invo']);
                jQuery('#ref_inv').empty();
                jQuery('#ref_inv').append(data['refund_invo']);
                jQuery('#can_inv').empty();
                jQuery('#can_inv').append(data['cancle_invo']);
                // jQuery('#services_tbl_body').empty();
                // jQuery('#domain_tbl_body').empty();
                // jQuery('#services_tbl_body').append(data['append']);
                // jQuery('#domain_tbl_body').append(data['append2']);
                // jQuery('#sales_tbl').DataTable();

            },
            complete: function(response) {
                jQuery("#fullpage-overlay").addClass("hidden");
                jQuery("#changePassword").prop("disabled", false);
            },
            error: function(data) {
                alert(data);
            }
        });
    }
})
jQuery(document).on('click', '#leads_data', function() {
    var leads = jQuery('#leads').val();
    var description = jQuery('#led_discription').val();
    var date = jQuery('#date').val();
    var comment = jQuery('#comment').val();
    console.log(leads);
    console.log(description);
    console.log(date);
    console.log(comment);
    var leads = jQuery('#leads').val();
    if (leads == '') {
        jQuery('#error_msg_lead').show();
        jQuery('#leads').css('outline', 'none !important');
        jQuery('#leads').css('box-shadow', '0px 0px 1px 1px red');
    } else {
        jQuery('#error_msg_lead').hide();
        jQuery('#leads').css('outline', '');
        jQuery('#leads').css('box-shadow', '');
        jQuery.ajax({
            url: "",
            type: 'POST',
            data: { 'request': 'insert_leads_data', 'leads': leads, 'description': description, 'date': date, 'comment': comment },
            dataType: "json",
            success: function(data) {
                swal("Success!", {
                    title: "Success!",
                    text: "Your data has been submitted successfully!",
                    icon: "success",
                    className: "reloade_confom",
                });


            },
            error: function(data) {
                alert(data);
            }
        });
    }
});
// jQuery(document).on('change', '.prepare', function() {
//     var self = this;
//     var tbl_column_name = 'proposal_prepare';
//     var id_name = 'prepare_';
//     p_chk_unchk(self, id_name, tbl_column_name);

// })
// jQuery(document).on('click', '.p_sent', function() {
//     var self = this;
//     var tbl_column_name = 'proposal_sent';
//     var id_name = 'sent_';
//     p_chk_unchk(self, id_name, tbl_column_name);
// });
// jQuery(document).on('click', '.p_feedbk', function() {
//     var self = this;
//     var tbl_column_name = 'feedback';
//     var id_name = 'feedbk_';
//     p_chk_unchk(self, id_name, tbl_column_name);
// });
// jQuery(document).on('click', '.p_ops', function() {
//     var self = this;
//     var tbl_column_name = 'ops';
//     var id_name = 'ops_';
//     p_chk_unchk(self, id_name, tbl_column_name);
// });


function p_chk_unchk(self, id_name, tbl_column_name) {
    var chk_val = 0;
    // var self = this;
    var r_id = jQuery(self).attr('r_id');
    if ($(self).prop("checked") == true) {
        chk_val = 1;
    } else if ($(self).prop("checked") == false) {
        chk_val = 0;
    }
    $(self).prop('disabled', true);
    jQuery.ajax({
        url: "",
        type: 'POST',
        data: { 'request': 'chk_unchk_req', 'chk_val': chk_val, 'r_id': r_id, 'tbl_column_name': tbl_column_name },
        dataType: "json",
        success: function(data) {
            // debugger;
            if (data == 1) {
                $(self).prop('disabled', false);
                if (chk_val == 1) {
                    jQuery('#' + id_name + r_id).removeClass();
                    jQuery('#' + id_name + r_id).addClass('glyphicon glyphicon-ok');
                } else {
                    jQuery('#' + id_name + r_id).removeClass();
                    jQuery('#' + id_name + r_id).addClass('glyphicon glyphicon-remove');
                }
            } else {
                // alert('hh');
                // jQuery(self).click();

            }

        },
        error: function(data) {
            alert(data);
        }
    });
}
jQuery(document).on('click', '.markAs', function() {
    p_rid = jQuery(this).attr('r_id');
    comment = jQuery(this).attr('comment');
    console.log(comment);
    jQuery('#prop_comment').val(comment);
    r_id = p_rid;
    var prepare_class = jQuery(this).closest('tr').find("td:nth-child(4)");
    var label = jQuery(this).closest('tr').find("td:nth-child(2)").text();
    // console.log(r_id);
    // console.log(prepare_class);
    var pre_class_name = jQuery('#prepare_' + r_id).attr('class');
    var sent_class_name = jQuery('#sent_' + r_id).attr('class');
    var feedbk_class_name = jQuery('#feedbk_' + r_id).attr('class');
    var ops_class_name = jQuery('#ops_' + r_id).attr('class');
    jQuery('#full_s_m_h h4').empty();
    jQuery('#full_s_m_h h4').append(label);
    // console.log(pre_class_name);
    var pre_checked = '';
    if (pre_class_name == 'glyphicon glyphicon-ok') {
        pre_checked = 'checked';
    }
    var append_pre = '<label class="switch"><input type="checkbox" ' + pre_checked + ' class="prepare" id="pre"><span class="slider round"></span></label>';
    jQuery('#prepare_div').empty();
    jQuery('#prepare_div').append(append_pre);
    var sent_chk = '';
    if (sent_class_name == 'glyphicon glyphicon-ok') {
        sent_chk = 'checked';
    }
    var append_pre = '<label class="switch sent"><input type="checkbox" ' + sent_chk + ' class="p_sent" id="p_snt"><span class="slider round"></span></label>';
    jQuery('#sent_div').empty();
    jQuery('#sent_div').append(append_pre);
    var feedbk_chk = '';
    if (feedbk_class_name == 'glyphicon glyphicon-ok') {
        feedbk_chk = 'checked';
    }
    var append_pre = '<label class="switch feedback"><input type="checkbox" ' + feedbk_chk + ' class="p_feedbk" id="p_fdk"><span class="slider round"></span></label>';
    jQuery('#feedbk_div').empty();
    jQuery('#feedbk_div').append(append_pre);
    var ops_chk = '';
    if (ops_class_name == 'glyphicon glyphicon-ok') {
        ops_chk = 'checked';
    }
    var append_pre = '<label class="switch ops"><input type="checkbox" ' + ops_chk + ' class="p_ops" id="p_op"><span class="slider round"></span></label>';
    jQuery('#ops_div').empty();
    jQuery('#ops_div').append(append_pre);

    // jQuery('#' + id_name + r_id).removeClass();
    // jQuery('#' + id_name + r_id).addClass('glyphicon glyphicon-ok');
    jQuery('#P_Modal').modal('show');
})
jQuery(document).on('click', '#propasal_submit', function() {
    // console.log(p_rid);
    var self = this;
    var pre_val = 0;
    if ($('#pre').prop("checked") == true) {
        pre_val = 1;
    }
    var sent_val = 0;
    if ($('#p_snt').prop("checked") == true) {
        sent_val = 1;
    }
    var p_fdk = 0;
    if ($('#p_fdk').prop("checked") == true) {
        p_fdk = 1;
    }
    var p_op = 0;
    if ($('#p_op').prop("checked") == true) {
        p_op = 1;
    }
    jQuery(self).val('Loading...');
    jQuery.ajax({
        url: "",
        type: 'POST',
        data: { 'request': 'chk_unchk_req', 'pre_val': pre_val, 'r_id': p_rid, 'sent_val': sent_val, 'p_fdk': p_fdk, 'p_op': p_op },
        dataType: "json",
        success: function(data) {
            jQuery(self).val('Submit');
            jQuery('#P_Modal').modal('hide');
            swal("Success!", {
                title: "Success!",
                text: "Your data has been submitted successfully!",
                icon: "success",
                className: "reloade_confom",
            });
        },
        error: function(data) {
            alert(data);
        }
    });
})