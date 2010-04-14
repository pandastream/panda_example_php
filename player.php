<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');

$video_id = $_GET['panda_video_id'];
$panda_encodings = json_decode(@$panda->get("/videos/{$video_id}/encodings.json"));
$panda_encoding = $panda_encodings[0];
$encoding = false;
if ($panda_encoding->status == 'success') {
    $encoding = new StdClass();
    $encoding->id     = $panda_encoding->id;
    $encoding->url    = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}{$panda_encoding->extname}";
    $encoding->width  = $panda_encoding->width;
    $encoding->height = $panda_encoding->height;
}

?>
<?php if ($encoding) : ?>
    <h1>Your video, encoded with Panda</h1>
    <div id="flash_container_<?php echo $encoding->id ?>"><a href="http://www.macromedia.com/go/getflashplayer">Get the latest Flash Player</a> to watch this video.</div>
    <script type="text/javascript">
      var flashvars = {};
  
      flashvars.file = "<?php echo $encoding->url ?>";
      flashvars.width = "<?php echo $encoding->width ?>";
      flashvars.height = "<?php echo $encoding->height ?>";
      flashvars.fullscreen = "true";
      flashvars.controlbar = "over";
      var params = {wmode:"transparent",allowfullscreen:"true"};
      var attributes = {};
      attributes.align = "top";
      swfobject.embedSWF("<?php echo BASE_URL ?>/player.swf", "flash_container_<?php echo $encoding->id ?>", "<?php echo $encoding->width ?>", "<?php echo $encoding->height ?>", "9.0.115", "/flash/expressInstall.swf", flashvars, params, attributes);
    </script>
    <p><a href="<?php echo BASE_URL ?>/index.php">Try with a different video</a></p>
<?php else : ?>
    <p>Your video has not been encoded yet. Please wait a few moments and <a href="<?php echo $_SERVER['REQUEST_URI'] ?>">refresh this page</a>.</p>
<?php endif ?>
<h2>Encoding details</h2>
<pre><?php print_r($panda_encodings) ?></pre>
<?php include('lib/foot.inc.html'); ?>