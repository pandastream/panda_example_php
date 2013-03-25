<?php
include('lib/panda.php');
include('lib/config.inc.php');
include('lib/head.inc.php');
?>
<p>This is an example <strong>Panda</strong> client application, written in <strong>PHP</strong>.</p>

<form action="/player.php" id="new_video" method="POST">

  <input type="hidden" name="panda_video_id"/>

  <div class='progress progress-striped progress-success active'>
    <span id="progress-bar" class='bar'></span>
  </div>

  <div class='btn-toolbar'>
    <div id='browse-files' class='btn btn-primary btn-success'><span>Choose file</span></div>
    <button id='cancel-button' type="button" class='btn btn-danger'>Cancel</button>
  </div>

</form>

<script type="text/javascript">

  $('#cancel-button').click(function(e){
    upl.cancel(upl.getQueuedFiles()[0]);
    e.preventDefault();
  })

  var upl = panda.uploader.init({
    'buttonId': 'browse-files',
    'progressBarId': 'progress-bar',
    'authorizeUrl': "lib/authorize_upload.php",
    'onProgress': function(file, percent) {
      console.log("progress", percent, "%")
    },
    'onSuccess': function(file, data) {
      $("#new_video")
        .find("[name=panda_video_id]")
          .val(data.id)
        .end()
        .submit();
    },

    'onCancel': function(file, data) {
      upl.setProgress(0);
    },

    'onError': function(file, message) {
      console.log("error", message)
    }
  });
</script>

<?php include('lib/foot.inc.php'); ?>