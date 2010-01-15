<h1>Your video, encoded with Panda</h1>
<div id="flash_container_<?php echo $video->panda_id ?>"><a href="http://www.macromedia.com/go/getflashplayer">Get the latest Flash Player</a> to watch this video.</div>
<script type="text/javascript">
  var flashvars = {};
  
  flashvars.file = "<?php echo $video->url ?>";
  flashvars.width = "<?php echo $video->width ?>";
  flashvars.height = "<?php echo $video->height ?>";
  flashvars.fullscreen = "true";
  flashvars.controlbar = "over";
  var params = {wmode:"transparent",allowfullscreen:"true"};
  var attributes = {};
  attributes.align = "top";
  swfobject.embedSWF("/flash/player.swf", "flash_container_<?php echo $video->panda_id ?>", "<?php echo $video->width ?>", "<?php echo $video->height ?>", "9.0.115", "/flash/expressInstall.swf", flashvars, params, attributes);
</script>
<p><a href="<?php echo url_for('reset') ?>">Try with a different video</a></p>