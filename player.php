<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.php');

$video_id = ($_REQUEST['panda_video_id']);
$cloud_id = $panda_config['cloud_id'];
$cloud = json_decode(@$panda->get("/clouds/$cloud_id.json"));
$panda_encodings = json_decode(@$panda->get("/videos/{$video_id}/encodings.json"));
$mp4 = false;

foreach ($panda_encodings as $panda_encoding) {
    if ($panda_encoding->{'profile_name'} == 'h264') {
        $mp4 = clone $panda_encoding;
        $mp4->url    = "{$cloud->url}{$panda_encoding->path}{$panda_encoding->extname}";

        $mp4->thumbnails = array();
        foreach (range(1, 7) as $number) {
            array_push($mp4->thumbnails, "{$cloud->url}{$panda_encoding->path}_{$number}.jpg");
        }
    }
}
?>
<?php if ($mp4->status == 'success') : ?>
    <h1>Your video, encoded with Panda</h1>

    <div>
        <h2>Using HTML5</h2>
        <video id="movie" width="<?php echo $mp4->width ?>" height="<?php echo $mp4->height ?>" preload="none" poster="<?php echo $mp4->thumbnails[4] ?>" controls>
          <source src="<?php echo $mp4->url ?>" type="video/mp4">
        </video>
    </div>


    <h3>Thumbnails</h3>
    
    <?php foreach ($mp4->thumbnails as $thumb): ?>
    <ul class="thumbnails">
      <li class="span3">
        <a class="thumbnail" href="#">
          <img src="<?php echo $thumb ?>"
               style="width:<?php echo $mp4->width ?>; height:<?php echo $mp4->width ?>">
        </a>
      </li>
    <?php endforeach; ?>
    </ul>

    <p style="clear: both; padding-top: 1em;"><a href="/index.php">Try with a different video</a></p>
<?php else : ?>

    <div class='progress progress-striped progress-success'>
        <span id="progress-bar" class='bar' style="width: <?php echo $mp4->encoding_progress ?>%"><?php echo $mp4->encoding_progress ?> %</span>
    </div>

    <p>Your video has not been encoded yet. Please wait a few moments and <a href="/player.php?panda_video_id=<?php echo $video_id ?>">refresh this page</a>.</p>
<?php endif ?>
<h2>Encoding details</h2>
<pre><?php print_r($panda_encodings) ?></pre>
<?php include('lib/foot.inc.php'); ?>