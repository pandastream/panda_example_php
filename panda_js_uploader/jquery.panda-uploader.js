(function(){

function PandaUploader() {}

PandaUploader.uploader = null;

jQuery.fn.pandaUploader = function(signed_params) {
    var placeholder = this[0];
    $(placeholder).after('<input type="hidden" name="video_id" id="hidden-reference" />');
    PandaUploader.uploader = this.swfupload({
        upload_url: "http://staging.pandastream.com/v2/videos.json",
        file_size_limit : 0,
        file_types : "*.*",
        file_types_description : "All Files",
        file_upload_limit : 0,
        flash_url : "/panda_js_uploader/swfupload-jquery/swfupload/swfupload.swf",
        button_image_url : '/panda_js_uploader/swfupload-jquery/swfupload/XPButtonUploadText_61x22.png',
        button_width : 61,
        button_height : 22,
        button_placeholder : placeholder,
        post_params : signed_params,
        file_post_name: "file",
        debug: true
    });
    PandaUploader.uploader.bind('swfuploadLoaded', setupSubmitButton);
    PandaUploader.uploader.bind('uploadSuccess', onSuccess);
    PandaUploader.uploader.bind('uploadComplete', onComplete);
}

function setupSubmitButton() {
    var form = $('#hidden-reference').closest("form")
    form.submit(onSubmit);    
}

function onSubmit(event) {
    PandaUploader.uploader.swfupload('startUpload');
    return false;
}

function onSuccess(event, file, response) {
    $('#hidden-reference').val(eval('(' + response + ')').id);
}

function onComplete() {
    var form = $('#hidden-reference').closest("form")[0];
    var tmpForm = document.createElement('FORM');
    tmpForm.submit.apply(form);
}

})();