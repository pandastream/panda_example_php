<?php

include('lib/panda.php');
include('lib/config.inc.php');
header('Content-Type: application/json');

if ($_GET['q'] == 'encodings') {
    echo @$panda->get("/videos/{$_GET['video_id']}/encodings.json");
}
else if ($_GET['q'] == 'signed_params') {
    echo json_encode(@$panda->signed_params("POST", "/videos.json", array()));
}