<?php
require 'vendor/autoload.php';
require 'lib/SproutVideo/Autoloader.php';
SproutVideo_Autoloader::register();
SproutVideo::$api_key = '';
print_r(SproutVideo\Video::list_videos());
?>