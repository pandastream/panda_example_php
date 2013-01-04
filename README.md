Panda example application, PHP
==============================

Some example PHP web apps that use [**Panda**](http://www.pandastream.com) to encode videos and play them on a page.

The full tutorial is available here: <http://pandastream.com/docs/integrate_with_php>
Also available:

* The [PHP Panda client library](http://github.com/pandastream/panda_client_php) that this application is based on.
* The [Panda Uploader](http://www.pandastream.com/video_uploader).

Setup
-----

By default, Panda will encode your videos using the H.264 codec, playable with the HTML5 &lt;VIDEO&gt; tag. These examples will use this to play your videos. Make sure you use a compatible browser to watch it.

These applications require **PHP 5.2** or later. They have been tested successfully with **Apache 2**. Make sure of the following:

* These required PHP modules are installed: **php5-curl**, **php5-mcrypt**
* For each example, copy the provided **lib/config.inc.php.example** into a new file **lib/config.inc.php** and fill it out with the appropriate info

Run the web server (php >= 5.4):

$ cd ./simple
$ php -S localhost:8080


What do these examples do anyway?
---------------------------------

The applications will initially show a simple form where you can specify a video file to upload from your computer. After uploading a video and waiting for encoding to finish, it will be shown to you.
