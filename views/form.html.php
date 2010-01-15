<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="/" method="post" id="upload-form">
    <label>Upload a video<br/></label>

    <span id="spanButtonPlaceholder"></span>
    <input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
    <div class="flash" id="progress_bar_container"></div>
    <input name="video[panda_id]" type="hidden" id="video_panda_id" />
    <script type="text/javascript"><!--//
PandaUploader.init('http://ec2-174-129-52-14.compute-1.amazonaws.com:80/v2', {"final_file_field_id":"video_panda_id","form_id":"upload-form","state_update_url":"http://localhost.com:4000/videos/$id/status_update"}, {"debug":true,"flash_url":"/flash/swfupload.swf"});
    //--></script>
		<p><input type="submit" value="Save" id="btnSubmit" /></p>
</form>