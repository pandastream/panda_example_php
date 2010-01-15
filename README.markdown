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
* **mod_rewrite** for Apache is enabled
* **DocumentRoot** is set to the path of the **public/** directory
* The **public/** directory is set to **AllowOverride All**. This will enable the included .htaccess file
* Copy the provided **config.php.example** into a new file **config.php** and fill it out with the appropriate info

And that should be it.


What does it do anyway?
-----------------------

The application will initially show a simple form where you can specify a video file to upload from your computer. Once uploaded, it will ask you to wait a bit until all is encoded. You'll have to reload the page yourself until this is done.

Finally, the video will appear embedded on the page, using a Flash player. If you wish to try again with another video, a link is provided to restart the process.

All data is stored on the session, so no DB connection is needed.


Notes
-----

This example app uses the [Limonade PHP framework](http://limonade.sofa-design.net/) (included) by Fabrice Luraine. However, it relies on a non-official fork by [DataShaman](http://github.com/datashaman/limonade). It's also a [very specific commit](http://github.com/datashaman/limonade/commit/12a479a23bd62ef1c99c21314bffba289656c5ca), as a later version removed functionality needed by the app. You shouldn't worry about that though, when you build a Panda app yourself.

Uploads are done using [SWFUpload](http://www.swfupload.org/).
