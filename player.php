<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');

$video_id = $_GET['panda_video_id'];
$panda_encodings = json_decode(@$panda->get("/videos/{$video_id}/encodings.json"));
$flv = $mp4 = false;

foreach ($panda_encodings as $panda_encoding) {
    if ($panda_encoding->extname == '.flv' && $panda_encoding->status == 'success') {
        $flv = new StdClass();
        $flv->id     = $panda_encoding->id;
        $flv->url    = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}{$panda_encoding->extname}";
        $flv->width  = $panda_encoding->width;
        $flv->height = $panda_encoding->height;
        $flv->screenshot_url = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}_4.jpg";
    }
    if ($panda_encoding->extname == '.mp4' && $panda_encoding->status == 'success') {
        $mp4 = new StdClass();
        $mp4->id     = $panda_encoding->id;
        $mp4->url    = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}{$panda_encoding->extname}";
        $mp4->width  = $panda_encoding->width;
        $mp4->height = $panda_encoding->height;
        $mp4->screenshot_url = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}_4.jpg";
    }
}
?>
<?php if ($flv || $mp4) : ?>
    <h1>Your video, encoded with Panda</h1>

    <?php if ($mp4) : ?>
        <div style="float: left; margin-right: 2em;">
            <h2>Using HTML5</h2>
            <video id="movie" width="<?php echo $mp4->width ?>" height="<?php echo $mp4->height ?>" preload="none" poster="<?php echo $mp4->screenshot_url ?>" controls>
              <source src="<?php echo $mp4->url ?>" type="video/mp4">
            </video>
        </div>
    <?php endif ?>

    <?php if ($flv) : ?>
        <div style="float: left;">
            <h2>Using Flash</h2>
            <div id="flash_container_<?php echo $flv->id ?>"><a href="http://www.macromedia.com/go/getflashplayer">Get the latest Flash Player</a> to watch this video.</div>
            <script type="text/javascript">
              var flashvars = {};
  
              flashvars.file = "<?php echo $flv->url ?>";
              flashvars.image = "<?php echo $flv->screenshot_url ?>";
              flashvars.width = "<?php echo $flv->width ?>";
              flashvars.height = "<?php echo $flv->height ?>";
              flashvars.fullscreen = "true";
              flashvars.controlbar = "over";
              var params = {wmode:"transparent",allowfullscreen:"true"};
              var attributes = {};
              attributes.align = "top";
              swfobject.embedSWF("<?php echo BASE_URL ?>/player.swf", "flash_container_<?php echo $flv->id ?>", "<?php echo $flv->width ?>", "<?php echo $flv->height ?>", "9.0.115", "/flash/expressInstall.swf", flashvars, params, attributes);
            </script>
        </div>
    <?php endif ?>
    <p style="clear: both; padding-top: 1em;"><a href="<?php echo BASE_URL ?>/index.php">Try with a different video</a></p>
<?php else : ?>
    <p>Your video has not been encoded yet. Please wait a few moments and <a href="<?php echo $_SERVER['REQUEST_URI'] ?>">refresh this page</a>.</p>
<?php endif ?>
<h2>Encoding details</h2>
<pre><?php print_r($panda_encodings) ?></pre>
<?php include('lib/foot.inc.html'); ?>