<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.php');
?>


<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="<?php echo $panda->api_url() ?>/videos.json" method="post" id="upload-form" enctype="multipart/form-data">
    <label>Upload a video<br/></label>

    <input type="file" name="file" />
    <?php
    $player_path = dirname($_SERVER['SCRIPT_NAME']) . '/player.php';
    $return_url =  "http://{$_SERVER['HTTP_HOST']}$player_path?panda_video_id=\$id";
    $params = $panda->signed_params('POST', '/videos.json', array('upload_redirect_url' => $return_url));
    ?>
    <input type="hidden" name="cloud_id" value="<?php echo $params['cloud_id'] ?>">
    <input type="hidden" name="access_key" value="<?php echo $params['access_key'] ?>">
    <input type="hidden" name="timestamp" value="<?php echo $params['timestamp'] ?>">
    <input type="hidden" name="signature" value="<?php echo $params['signature'] ?>">
    <input type="hidden" name="upload_redirect_url" value="<?php echo $params['upload_redirect_url'] ?>">

    <p><input type="submit" value="Save" /></p>
</form>

<?php
include('lib/foot.inc.php');
?>
