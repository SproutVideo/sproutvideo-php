<?php
require 'vendor/autoload.php';
SproutVideo::$api_key = ''; # replace with your API key
print_r(SproutVideo\Video::list_videos());
?>