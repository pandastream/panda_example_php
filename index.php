<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="/" method="post" id="upload-form">
    <label>Upload a video<br/></label>

    <span id="spanButtonPlaceholder"></span>
    <input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
    <div class="flash" id="progress_bar_container"></div>
    <input name="video[panda_id]" type="hidden" id="video_panda_id" />
    <script type="text/javascript">
PandaUploader.init(<?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>, {"api_host": '<?php echo $panda->api_host; ?>', "final_file_field_id": "video_panda_id", "form_id": "upload-form"}, {"debug": true, "flash_url": "/flash/swfupload.swf"});
    </script>
		<p><input type="submit" value="Save" id="btnSubmit" /></p>
</form>
<?php include('lib/foot.inc.html'); ?>