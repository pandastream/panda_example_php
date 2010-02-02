<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="/player.php" method="get" id="upload-form">
    <label>Upload a video<br/></label>

    <span id="upload_button"></span>
    <input type="text" id="upload_filename" disabled="true" />
    <div id="upload_progress" class="progress_bar_container"></div>
    <input type="hidden" id="returned_video_id" name="panda_video_id" />

<script type="text/javascript">
$('#returned_video_id').pandaUploader(<?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>, {
    upload_button_id: 'upload_button',
    upload_filename_id: 'upload_filename',
    upload_progress_id: 'upload_progress'
});
</script>
        
		<p><input type="submit" value="Save" /></p>
		
</form>
<?php include('lib/foot.inc.html'); ?>