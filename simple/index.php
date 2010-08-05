<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.php');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>

<form action="<?php echo BASE_URL ?>/player.php">
    <!-- field where the video ID will be stored after the upload -->
    <input type="hidden" name="panda_video_id" id="returned_video_id" />

    <!-- upload progress bar (optional) -->
    <div id="upload_progress" class="panda_upload_progress"></div>

    <!-- a submit button -->
    <p><input type="submit" value="Upload video" /></p>
</form>
<script type="text/javascript">
$('#returned_video_id').pandaUploader(<?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>, {
    api_url: '<?php echo $panda->api_url() ?>',
    upload_progress_id: 'upload_progress',
    uploader_dir: '<?php echo BASE_URL ?>/panda_uploader'
});
</script>
<?php include('lib/foot.inc.php'); ?>