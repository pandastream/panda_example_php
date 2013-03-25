<?php
include('panda.php');
include('config.inc.php');

$payload = json_decode($_POST['payload']);

$filename = $payload->{'filename'};
$filesize = $payload->{'filesize'};

$upload = json_decode(@$panda->post("/videos/upload.json", 
  array('file_name' => $filename, 'file_size' => $filesize, 'profiles' => 'h264')));

$response = array('upload_url' => $upload->{"location"});

header('Content-Type: application/json');
echo json_encode($response);
?>
