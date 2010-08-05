<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.html');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>
<form action="<?php echo BASE_URL ?>/player.php" method="get" id="upload-form">
    <label>Upload a video<br/></label>
    
    <!-- field where the video ID will be stored after the upload -->
    <input type="hidden" name="panda_video_id" id="returned_video_id" />

    <!-- upload progress bar (optional) -->
    <div id="upload_progress" class="panda_upload_progress"></div>

    <!-- here we'll show the preview (optional) -->
    <div id="preview"></div>
</form>
<script type="text/javascript">
// OH NOES!!! Global variables!
var signed_params = <?php echo json_encode(@$panda->signed_params("POST", "/videos.json", array())); ?>;
var pollTimeout;

$('#returned_video_id').pandaUploader(get_signed_params, {
    upload_progress_id: 'upload_progress',
    api_url: '<?php echo $panda->api_url() ?>',
    uploader_dir: '<?php echo BASE_URL ?>/panda_uploader',
    upload_strategy: new PandaUploader.UploadOnSelect(),
    onsuccess: resetPreview
});

function get_signed_params() {
    var ret = signed_params;
    $.getJSON('<?php echo BASE_URL ?>/json.php', {
        q: 'signed_params',
        ie_cache_buster: IECacheBuster()
    }, function(res) {
        signed_params = res;
    });
    return ret;
}

function resetPreview() {
    $('#preview').removeClass('waiting');
    checkForPreview();
}

function IECacheBuster() {
    // ...although this example doesn't work in IE anyway, due to the <VIDEO> tag
    if ( ! this.ie_cache_buster) {
        this.ie_cache_buster = 0;
    }
    return ++this.ie_cache_buster;
}

function checkForPreview() {
    $.getJSON('<?php echo BASE_URL ?>/json.php', {
        q: 'encodings',
        video_id: $('#returned_video_id').val(),
        ie_cache_buster: IECacheBuster()
    }, function(encodings){
        var vid = encodings[0];
        if (vid.status == 'success') {
            createPreview(vid);
        }
        else {
            var $p = $('#preview');
            if ( ! $p.hasClass('waiting')) {
                $p.css({
                    display: 'block',
                    height: vid.height,
                    width: vid.width,
                    background: '#eee',
                    textAlign: 'center'
                })
                $p.html('<p style="padding-top: 3em;">Waiting for preview...</p><p><img src="<?php echo BASE_URL ?>/roller.gif" /></p>');
                $p.addClass('waiting');
                $p.slideDown('slow');
            }
            
            if (pollTimeout) {
                clearTimeout(pollTimeout);
            }
            pollTimeout = setTimeout(checkForPreview, 1000);
        }
    });
}
function createPreview(vid) {
    var url = 'http://<?php echo $s3_bucket_name ?>.s3.amazonaws.com/' + vid.id + vid.extname;
    var screenshot_url = 'http://<?php echo $s3_bucket_name ?>.s3.amazonaws.com/' + vid.id + '_4.jpg';
    $('#preview').html('<video style="margin: 0 auto;" id="movie" width="' + vid.width + '" height="' + vid.height + '" poster="' + screenshot_url + '" preload="none" controls><source src="' + url + '" type="video/mp4"></video>');
}
</script>
<?php include('lib/foot.inc.html'); ?>