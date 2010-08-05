Panda example application, PHP
==============================

Some example PHP web apps that use [**Panda**](http://pandastream.com) to encode videos and play them on a page.

Also available:

* The simple [PHP Panda client library](http://github.com/newbamboo/panda_client_php) that this application is based on.
* The jQuery-based [upload plugin](http://github.com/newbamboo/panda_uploader) used in some examples.


Setup
-----

By default, Panda will encode your videos using the H.264 codec, playable with the HTML5 &lt;VIDEO&gt; tag. These examples will use this to play your videos. Make sure you use a compatible browser to watch it.

These applications require **PHP 5.2** or later. They have been tested successfully with **Apache 2**. Make sure of the following:

* These required PHP modules are installed: **php5-curl**, **php5-mcrypt**
* For each example, copy the provided **lib/config.inc.php.example** into a new file **lib/config.inc.php** and fill it out with the appropriate info

And that should be it.


What do these examples do anyway?
---------------------------------

The applications will initially show a simple form where you can specify a video file to upload from your computer. After uploading a video and waiting for encoding to finish, it will be shown to you.

At the moment, the following examples are available:

* `simplest`: no Javascript involved. The form posts the video directly to Panda, and the browser is then redirected back from Panda to the application. No progress bar is shown and the user doesn't receive much feedback.
* `simple`: simple usage of the Javascript upload plugin. Video is uploaded to Panda directly using Flash and showing a progress bar, then the form is posted to your application.
* `ajax`: advanced example. It uploads the videos as soon as they are selected, and displays the result on the same page.