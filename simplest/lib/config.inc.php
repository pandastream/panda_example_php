<?php

define('BASE_URL', dirname($_SERVER["SCRIPT_NAME"]));

//
// The details of your Panda account
//
$panda = new Panda(array(
    'api_host'   => 'api.pandastream.com',
    'cloud_id'   => 'a016162968d4cc2ca008a5d2a4c1ef4c',
    'access_key' => '39514a04-0a69-11df-9401-12313b0440a2',
    'secret_key' => '9I+/+P72iC6TLtgrhk5Qov+88h/i1tLUA37cMgjK',
));

//
// The S3 bucket where your Panda cloud has been told to store encoded videos
//
$s3_bucket_name = 'panda-test-videos';

//
// You may want to change this to your own timezone,
// but this default should be safe
//
date_default_timezone_set('UTC');

?>
