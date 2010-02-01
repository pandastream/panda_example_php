<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="/player.php" method="get" id="upload-form">
    <label>Upload a video<br/></label>

    <span id="the-button"></span>
    <input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
    <div class="flash" id="progress_bar_container"></div>
    <input name="video_id" type="hidden" id="video_panda_id" />
    <script type="text/javascript">
$('#the-button').pandaUploader(<?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>);
    </script>
		<p><input type="submit" value="Save" id="btnSubmit" /></p>
</form>
<?php include('lib/foot.inc.html'); ?>