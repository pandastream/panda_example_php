<?php

error_reporting(E_ALL);
define('APP_BASE', realpath(dirname(__FILE__)));

require_once 'lib/limonade/lib/limonade.php';
require_once 'lib/panda.php';

function configure() {
    global $base_uri;
    option('base_uri', isset($base_uri) ? $base_uri : '/');
    option('views_dir', APP_BASE . '/views');
    require('config.php');
}

function before() {
    global $video;

    $video = _read($_SESSION, 'video', new StdClass());
    if ( ! isset($video->panda_id)) {
        reset_video();
    }
    layout('layout.html.php');
}

function after($output) {
    $_SESSION['video'] = $GLOBALS['video'];
    return $output;
}

dispatch_get('/', 'index');
function index() {
    global $video;
    if ($video->panda_id) {
        return video_ready() ? show() : processing();
    }
    else {
        return form();
    }
}

function processing() {
    return html('processing.html.php');
}

function show() {
    if (player_present()) {
        return _show();
    }
    else {
        return _player_missing();
    }
}

function _show() {
    global $video;
    set('video', $video);
    return html('show.html.php');
}

function _player_missing() {
    return html('player_missing.html.php');
}

function form() {
    global $panda;
    set('panda', $panda);
    return html('form.html.php');
}

dispatch_post('/', 'create');
function create() {
    global $video;
    $video->panda_id = $_POST['video']['panda_id'];
    redirect_to('/');
}

dispatch('/authparams.json/:method/:request_uri/:extra_params', 'authparams');
function authparams() {
    global $panda;
    $response = $panda->signed_params(_read($_GET, 'method'), _read($_GET, 'request_uri'), _read($_GET, 'request_params', array()));
    return json($response);
}

dispatch('/reset', '_reset');
function _reset() {
    global $panda ;
    $panda->delete("videos/{$video->panda_id}.json");
    reset_video();
    redirect_to('/');
}


run();


function _read($array, $key, $default = null) {
    return isset($array[$key]) ? $array[$key] : $default;
}

function update_video_status() {
    global $video, $panda, $s3_bucket_name;

    if ($video->url) {
        return true;
    }
    $panda_encodings = json_decode($panda->get("/videos/{$video->panda_id}/encodings.json"));

    $panda_encoding = $panda_encodings[0];
    if ($panda_encoding->status != 'success') {
        return false;
    }

    $video->url    = "http://$s3_bucket_name.s3.amazonaws.com/{$panda_encoding->id}{$panda_encoding->extname}";
    $video->width  = $panda_encoding->width;
    $video->height = $panda_encoding->height;
    
    return true;
}

function reset_video() {
    global $video;
    $video->panda_id = null;
    $video->url = null;
}

function video_ready() {
    global $video;

    if ( ! $video->panda_id) {
        return false;
    }

    return update_video_status();
}

function player_present() {
    return is_file(APP_BASE . '/public/flash/player.swf');
}

?>