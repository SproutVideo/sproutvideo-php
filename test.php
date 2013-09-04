<?php
require 'vendor/autoload.php';
require 'lib/SproutVideo/SproutVideo.php';

SproutVideo::$api_key = '';
print_r(SproutVideo\Playlist::update_playlist('bd99ddb630', array('title' => 'Login', 'privacy' => 2)));
?>