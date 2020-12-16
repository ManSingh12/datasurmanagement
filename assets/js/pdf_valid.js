function validate(){
    return validate_file();
}

function validate_file(){ 
    var file_err = 'file_err';
    var upload_cv = $('#upload_cv');
    var file = $('#file')[0].files[0]
    //hide previous error
    $("#"+file_err).html("");
    
    if(file == undefined){
        $('#error_msg').append('<span id='+file_err+'><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please upload(.pdf) File</p></span>');
        return false;
    }else{
          $("#"+file_err).html("");
    }
    // console.log(file.size);
    var fileType    = file.type; // holds the file types
    
    var match       = ["application/pdf"]; // defined the file types
    var fileSize    = file.size; // holds the file size
    var maxSize     = 2*1024*1024; // defined the file max size
    // console.log(match);
     // Checking the Valid Image file types  
    if(!((fileType==match[0]) || (fileType==match[1])))
    {
        upload_cv.val("");
        $('#error_msg').append('<span id='+file_err+'><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please select a valid (.pdf) file.</p></span>');
        return false;
    }else{
          $("#"+file_err).html("");
    }
     // Checking the defined image size
    if(fileSize > maxSize)
    {
        upload_cv.val("");
        $('#error_msg').append('<span id='+file_err+'><p class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Please select a file less than 2mb of size.</p></span>');
        return false;
    }else{
        $("#"+file_err).html("");
    }
}

$("#uploadForm").submit(function(e) 
{

    e.preventDefault(); // avoid to execute t
})

$(document).on('click','#upload_file',function()
{
    //  debugger;
    var result=validate_file();
    var self=this;
    var description=jQuery("#discription").val();
    counter++;
    // console.log(userid);
    // console.log(result);
    if(result!=false)
    {
       
        $(self).prop("disabled", true);
        var self=this;
        $(self).html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...`
          );
        // $(self).val('Uploading..')
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        formData.append('request', 'upload');
        formData.append('id', userid);
        formData.append('counter',counter);
        formData.append('description',description);
        $.ajax({
            url : "",
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType : "json",
            success : function(data) 
            {
                $(self).text('Upload');
                $(self).prop("disabled", false);
                // $(self).text('Upload')
                console.log(data);
                if(data['result']==true)
                {
                    jQuery('#msg_bdy').empty();
                    // swal("Success!", "Your file has been uploaded successfully!", "success");
                    swal("Success!", {
                        title: "Success!",
                        text: "Your file has been uploaded successfully!",
                        icon: "success",
                        className:"reloade_confom",});
                }
                else{
                    jQuery('#msg_bdy').empty();
                    jQuery('#msg_bdy').append('<div class="alert alert-danger"><strong>Error!</strong> '+data['msg']+'</div>');
                }
                // alert(data['msg']);
            }
        });
    }
    // console.log(result);
    
})