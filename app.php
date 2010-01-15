<?php

error_reporting(E_ALL);
define('APP_BASE', realpath(dirname(__FILE__)));

require_once 'lib/limonade/lib/limonade.php';
require_once 'lib/panda.php';

function configure() {
		option('base_uri', '/');
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
        return $video->url ? show() : processing();
    }
    else {
        return form();
    }
}

function processing() {
		update_video_status();
    return html('processing.html.php');
}

function show() {
		global $video;
		set('video', $video);
		return html('show.html.php');
}

function form() {
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
		global $video, $panda;
		
		if ($video->url) {
				return;
		}
  	$panda_encodings = json_decode($panda->get("/videos/{$video->panda_id}/encodings.json"));
  	$panda_encoding = $panda_encodings[0];
		if ($panda_encoding->status != 'success') {
				return;
		}

		$video->url    = $panda_encoding->video_url;
		$video->width  = $panda_encoding->width;
		$video->height = $panda_encoding->height;
}

function reset_video() {
		global $video;
		$video->panda_id = null;
		$video->url = null;
}

?>