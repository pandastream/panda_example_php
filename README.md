Panda example application, PHP
==============================

An example PHP web app that uses [**Panda**](http://pandastream.com) to encode videos and play them on a page.

Also available: the simple [PHP Panda client library](http://github.com/newbamboo/panda_client_php) that this application is based on.


Setup
-----

This application requires **PHP 5.2** or later. It's been tested successfully with **Apache 2**. Make sure of the following:

By default, Panda will encode your videos using the H.264 codec, playable with the HTML5 &lt;VIDEO&gt; tag. This example will use this to play your videos.

Additionally make sure of the following:

* These required PHP modules are installed: **php5-curl**, **php5-mcrypt**
* Copy the provided **lib/config.inc.php.example** into a new file **lib/config.inc.php** and fill it out with the appropriate info

And that should be it.


What does it do anyway?
-----------------------

The application will initially show a simple form where you can specify a video file to upload from your computer. Once uploaded, it will ask you to wait a bit until all is encoded. You'll have to reload the page yourself until this is done.

Finally, the video will appear embedded on the page, using a Flash player. If you wish to try again with another video, a link is provided to restart the process.


Notes
-----

Uploads are done using [panda_uploader](http://github.com/newbamboo/panda_uploader).
