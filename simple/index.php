<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="<?php echo BASE_URL ?>/player.php" method="get" id="upload-form">
    <label>Upload a video<br/></label>
    
    <span id="upload_button"></span>
    <input type="text" id="upload_filename" disabled="true" class="panda_upload_filename" />
    <div id="upload_progress" class="panda_upload_progress"></div>
    <input type="hidden" id="returned_video_id" name="panda_video_id" />

    <p><input type="submit" value="Save" /></p>
</form>
<script type="text/javascript">
$('#returned_video_id').pandaUploader(<?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>, {
    upload_button_id: 'upload_button',
    upload_filename_id: 'upload_filename',
    upload_progress_id: 'upload_progress',
    api_url: '<?php echo $panda->api_url() ?>',
    uploader_dir: '<?php echo BASE_URL ?>/panda_uploader',
});
</script>
<?php include('lib/foot.inc.html'); ?>