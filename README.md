Panda example application, PHP
==============================

An example PHP web app that uses [**Panda**](http://beta.pandastream.com) to encode videos and play them on a page.

Also available: the simple [PHP Panda client library](http://github.com/newbamboo/panda_client_php) that this application is based on.


Setup
-----

This application requires **PHP 5.2** or later. It's been tested successfully with **Apache 2**. Make sure of the following:

The most important step is setting up the video player. The one that this application uses is [JW Player](http://www.longtailvideo.com/players/jw-flv-player/) by Longtail. However, it has a restrictive license that forces us not to distribute it along with the rest of the package.

Instead, you need to go to their website at http://www.longtailvideo.com, download the player, and copy the **player.swf** file into the public/flash/ directory of the application. 

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

Uploads are done using [SWFUpload](http://www.swfupload.org/).
