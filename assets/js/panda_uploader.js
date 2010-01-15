function PandaUploader() {
}

PandaUploader.init = function(api_url, custom_args, swfu_args) {
    if (api_url === undefined) {
        alert("There was an error setting up the upload form. (The api_url parameter was not specified).");
        return false;
    }
    custom_args = custom_args === undefined ? {} : custom_args;
    swfu_args = swfu_args === undefined ? {} : swfu_args;
        
    var custom_options = PandaUploader.merge({
		progress_bar_container_id : "progress_bar_container",
		upload_successful : false,
		final_file_field_id: 'panda_id',
		submit_id: 'btnSubmit',
		form_id: 'upload_form',
		authentication_params_url: '/authparams.json',
		state_update_url: null
	}, custom_args);
    
    var swfu_options = PandaUploader.merge({
        upload_url: api_url + "/videos.json",
        flash_url: "/swfupload.swf",
        upload_post_params: {},

    	file_post_name: "file",
    	post_params : {},

    	// Flash file settings
    	file_size_limit : "100 MB",
    	file_types : "*.*",			// or you could use something like: "*.doc;*.wpd;*.pdf",
    	file_types_description : "All Files",
    	file_upload_limit : "0",
    	file_queue_limit : "1",

    	// Event handler settings
    	swfupload_loaded_handler : swfUploadLoaded,
    	file_dialog_start_handler: fileDialogStart,
    	file_queued_handler : fileQueued,
    	file_queue_error_handler : fileQueueError,
    	file_dialog_complete_handler : fileDialogComplete,
    	upload_start_handler : uploadStart,
    	upload_progress_handler : uploadProgress,
    	upload_error_handler : uploadError,
    	upload_success_handler : uploadSuccess,
    	upload_complete_handler : uploadComplete,

    	// Button Settings
        button_placeholder_id: "spanButtonPlaceholder",
        button_image_url: "/images/DefaultUploaderButton.png",
        button_width: "61",
        button_height: "22",

    	// Debug settings
    	debug: false,
    	
    	// Custom settings
    	custom_settings: custom_options
    }, swfu_args);

    return new SWFUpload(swfu_options);
}

PandaUploader.merge = function(a, b) {
    var ret = {};
    var key;
    for (key in a) {
      ret[key] = a[key];
    }
    for (key in b) {
      ret[key] = b[key];
    }
    return ret;
}

// Thanks PPK: http://www.quirksmode.org/js/xmlhttp.html
PandaUploader.async_xhr = function(url,callback,postData) {
	var req = createXMLHTTPObject();
	if (!req) return;
	var method = (postData) ? "POST" : "GET";
	req.open(method,url,false);
	req.setRequestHeader('User-Agent','XMLHTTP/1.0');
	if (postData)
		req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	if (req.readyState == 4) return;
	req.send(postData);
    callback(req);

    function createXMLHTTPObject() {
        var XMLHttpFactories = [
        	function () {return new XMLHttpRequest()},
        	function () {return new ActiveXObject("Msxml2.XMLHTTP")},
        	function () {return new ActiveXObject("Msxml3.XMLHTTP")},
        	function () {return new ActiveXObject("Microsoft.XMLHTTP")}
        ];
    	var xmlhttp = false;
    	for (var i=0;i<XMLHttpFactories.length;i++) {
    		try {
    			xmlhttp = XMLHttpFactories[i]();
    		}
    		catch (e) {
    			continue;
    		}
    		break;
    	}
    	return xmlhttp;
    }
}