# SproutVideo
Use this library to interact with the [SproutVideo API](https://sproutvideo.com/docs/api.html)

# Installation
## Install with Composer
If you're using [Composer](https://getcomposer.org/) to manage dependencies, you can add SproutVideo with.

```json
{
  "require": {
    "sproutvideo/sproutvideo": "1.3.3"
  }
}
```
Composer will take care of the autoloading for you, so if you require the vendor/autoload.php, you're good to go.

## Install source from GitHub
To install the source code:

    $ git clone git://github.com/sproutvideo/sproutvideo-php.git

And including it using the autoloader:
```php
<?php
require_once '/path/to/sproutvideo-php/lib/SproutVideo/Autoloader.php';
SproutVideo_Autoloader::register();
?>
```

# Getting Started
The first thing you'll need to interact with the SproutVideo API is your API key.
```php
<?php
SproutVideo::$api_key = 'abcd1234';
?>
```

# Videos
The following methods are available: `list_videos`, `get_video`, `create_video`, `update_video`, `replace_video`, `delete_video`.

## list_videos
By default the videos listing is paginated with 25 videos per page and sorted by upload date in ascending order. You can pass two parameters to control the paging: page and per_page. You can also pass in the id of a tag to just return the videos tagged with that tag.

```php
<?php
SproutVideo\Video::list_videos();
SproutVideo\Video::list_videos(array('per_page' => 10));
SproutVideo\Video::list_videos(array('per_page' => 10, 'page' => 2));
SproutVideo\Video::list_videos(array('tag_id' => 'abc'));
?>
```

## get_video
The string passed to get_video is the ID of a SproutVideo video.

```php
<?php
SproutVideo\Video::get_video('abc123');
?>
```

## create_video
The most basic upload you can perform is to just pass the path to the video file to the method. The title of the video will default to the name of the file.

```php
<?php
SproutVideo\Video::create_video('/path/to/video.mp4');
?>
```

You can set the title as well as many other parameters by passing them as a array

 ```php
 <?php
 SproutVideo\Video::create_video('/path/to/video.mp4', array('title' => 'My Awesome Video', 'description' => 'This video is great', 'privacy' => 2));
 ?>
```

You can also apply any number of tags to the new upload by passing their ids along:

```php
<?php
SproutVideo\Video::create_video('/path/to/video.mp4', array('tags' => array('ec61', 'abc123'));
?>
```

You can also create and apply tags on the fly when uploading by passing along tag names:

```php
<?php
SproutVideo\Video::create_video('/path/to/video.mp4', array('tag_names' => array('Tag One', 'Tag Two'));
?>
```

You can also specify a webhook url. We'll send an HTTP POST with the video json when the video has finished processing or if there was an error during processing:

```php
<?php
SproutVideo\Video::create_video('/path/to/video.mp4', array('notification_url' => 'https://example.com/webhook_url'));
?>
```

Lastly, if you are using the `source_video_url` parameter instead of uploading a file directly, use the following syntax:

```php
<?php
SproutVideo\Video::create_video(null, array('source_video_url' => 'https://example.com/video-file.mp4'));
?>
```
## update_video
 The first parameter is the id of the video you wish to edit. The second parameter is a array of attributes to update on the video.

```php
<?php
SproutVideo\Video::update_video('abc123', array('title' => 'Updated Title'));
?>
```

## replace_video
The first parameter is the id of the video you wish to replace. The second parameter is the local path to the video file.

```php
<?php
SproutVideo\Video::replace_video('abc123', '/path/to/video.mp4');
?>
```


## Tags
To add a tag to a video, make sure to include all of the tags currently associated with the video. For instance, if the video already has tags with the ids "abc" and "123", and you want to add a tag with the id "def", pass "abc", "123" and "def" to the update method.

```php
<?php
SproutVideo\Video::update_video('abc123', 'tags' => array("abc", "123", "def"));
?>
```

If you want to remove a tag from a video, remove the tag from the list of tags on the video but make sure to include all of the tags you wish to keep. For instance, if you now want to remove the tag with id "123" from the example above, pass in "abc" and "def"

```php
<?php
SproutVideo\Video::update_video("abc123", array('tags' => array("abc","def"));
?>
```

You can remove all of the tags from a video by just passing an empty array as the tags parameter.

```php
<?php
SproutVideo\Video::update_video('abc123', array('tags' => array()));
?>
```

## Upload poster frame
You can upload a custom poster frame for a video by calling the upload_poster_frame method. The first parameter is the id of the video for wish you'd like the poster frame to be associated and the second parameter is the path to the image file.
```php
<?php
SproutVideo\Video::upload_poster_frame('abc123','/path/to/video.mp4');
?>
```


## delete_video
Pass in the id of the video you wish to delete.

```php
<?php
SproutVideo\Video::delete_video('abc123');
?>
```

## Signed Embed Codes
You can use this convenience method to sign an embed code. It will return the embed code URL which can be used to build an iframe embed code.

```php
<?php
SproutVideo\Video::signed_embed_code($video_id, $security_token, $query_parameters, $expiration_time, $protocol);
?>
```

### Parameters
video_id - *String* ( *Required* )
: The id of the video for which you're generating the signed embed code

security_token - *String* ( *Required* )
: The security token of the video for which you're generatingn the signed embed code

query_parameteres - *Array* ( *Optional* )
: A array of query parameters to be passed to the embed code. Example: `array('type' => 'hd', 'autoplay' => 'true')`

expiration_time - *Integer* ( *Optional* )
: The number of seconds from the Epoc that this signed embed code should expire. This defaults to 5 minutes from the time the signed embed code was generated.

protocol - *String* ( *Optional* )
: `http` or `https`. Defaults to `http`

### Examples
```php
<?php
SproutVideo\Video::signed_embed_code('abc123','def456'); #sign a base embed code with no other options
SproutVideo\Video::signed_embed_code('abc123','def456', array('type' => 'hd')); #set parameters for the embed code such as changing the default video type to HD
SproutVideo\Video::signed_embed_code('abc123','def456', array(), 1368127991); #set a specific expiration time for the signed embed code. (By default the expiration time is set to 5 minutes from the time the signed embed code was generated).
SproutVideo\Video::signed_embed_code('abc123','def456', array(), null, 'https'); #Use https instead of http
?>
```
# Upload Tokens
The following methods are available: `create_upload_token`

## create_upload_token
```php
<?php
SproutVideo\UploadToken::create_upload_token();
SproutVideo\UploadToken::create_upload_token(array('return_url' => 'https://example.com'));
SproutVideo\UploadToken::create_upload_token(array('return_url' => 'https://example.com', 'seconds_valid' => 3600));
?>
```

# Live Streams
The following methods are available: `list_live_streams`, `create_live_stream`, `get_live_stream`, `update_live_stream`, `delete_live_stream`, `end_live_stream` `upload_poster_frame`.

## list_live_streams
By default the live_stream listing is paginated with 25 live_streams per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page.

```php
<?php
SproutVideo\LiveStream::list_live_streams();
SproutVideo\LiveStream::list_live_streams('per_page' => 10);
SproutVideo\LiveStream::list_live_streams('per_page' => 10, 'page' => 2);
?>
```

## get_live_stream
```php
<?php
SproutVideo\LiveStream::get_live_stream('d3f456')
?>
```

## create_live_stream

```php
<?php
SproutVideo\LiveStream::create_live_stream(array('name' => 'new live_stream'));
// with a poster frame
$file = '/users/dw/beach.jpg';
$data = [ 'title' => 'beacch vibezz' ];
Sproutvideo\LiveStream::create_live_stream($data, $file);
?>
```

## update_live_stream
```php
<?php
SproutVideo\LiveStream::update_live_stream('abc123', array('name' => 'updated live_stream name'));
// with a poster frame
$file = '/users/dw/beach.jpg';
$data = [ 'title' => 'beacch vibezz' ];
Sproutvideo\LiveStream::update_live_stream('abc123', $data, $file);
?>
```

## delete_live_stream
Pass in the id of the live_stream you wish to delete.

```php
<?php
SproutVideo\LiveStream::delete_live_stream('abc123');
?>
```

## end_live_stream
Pass in the id of the live_stream you wish to end.

```php
<?php
SproutVideo\LiveStream::end_live_stream('abc123');
?>
```

# Tags
The following methods are available: `list_tags`, `create_tag`, `get_tag`, `update_tag`, `delete_tag`.

## list_tags
By default the tag listing is paginated with 25 tags per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page.

```php
<?php
SproutVideo\Tag::list_tags();
SproutVideo\Tag::list_tags('per_page' => 10);
SproutVideo\Tag::list_tags('per_page' => 10, 'page' => 2);
?>
```

## get_tag
```php
<?php
SproutVideo\Tag::get_tag('d3f456')
?>
```

## create_tag

```php
<?php
SproutVideo\Tag::create_tag(array('name' => 'new tag'));
?>
```

## update_tag
```php
<?php
SproutVideo\Tag::update_tag('abc123', array('name' => 'updated tag name'));
?>
```

## delete_tag
Pass in the id of the tag you wish to delete.

```php
<?php
SproutVideo\Tag::delete_tag('abc123');
?>
```

# Folders
The following methods are avaialble: `list_folders`, `create_folder`, `get_folder`, `update_folder`, `delete_folder`
## list_folders
By default, the folder listing is paginated with 25 folders per page and sorted by `created_at` date in ascending order. You can pass tow parameters to control the paging: `page` and `per_page`. If you do not pass in a `parent_id` only the folders within the root folder will be returned. To get the folders in a specific folder, make sure to pass in that folder's id using the `parent_id` parameter.

```php
<?php
SproutVideo\Folder::list_folders();
SproutVideo\Folder::list_folders(array('order_by' => 'name', 'order_dir' => 'desc'));
SproutVideo\Folder::list_folders(array('parent_id' => 'def456'));
?>
```

## create_folder
Creating a folder without a `parent_id` will place that folder in the root folder. Passing in a `parent_id` will place the newly created folder in the folder specified by `parent_id`.

```php
<?php
 // folder is created in the root folder.
SproutVideo\Folder.create_folder(array('name' => 'New Folder'));

// folder is created as a child of the folder specified by the id 'def456'
SproutVideo\Folder.create_folder(array(
  'name' => 'New Folder',
  'parent_id' => 'def456'
));
?>
```

## get_folder
```php
<?php
SproutVideo\Folder.get_folder('d3f456')
?>
```

## update_folder
```php
<?php
SproutVideo\Folder.update_folder('def456', array('name' => 'Renamed Folder'))
?>
```

## delete_folder
By default, when deleting a folder, all of the contents of that folder (videos and folders), will be moved the root folder to prevent unintended data loss. If you wish to actually delete all of the content of a folder, make sure to pass in `delete_all` as true.

```php
<?php
// delete the folder and move it's contents to the root folder
SproutVideo\Folder.delete_folder('def456');

// delete the folder and everything in it.
SproutVideo\Folder.delete_folder('def456', array('delete_all' => true));
?>
```
# Playlists
The following methods are available: `list_playlists`, `create_playlist`, `get_playlsit`, `update_playlist`, `delete_playlist`.

## list_playlists
By default, the playlist listing is paginated with 25 playlists per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page.

```php
<?php
SproutVideo\Playlist::list_playlists();
SproutVideo\Playlist::list_playlists(array('per_page' => 10));
SproutVideo\Playlist::list_playlists(array('per_page' => 10, 'page' => 2));
?>
```

## create_playlist
You can add videos to a playlist when creating it by passing in the videos you'd like to add in the videos parameter in the order you'd like them to appear.

```php
<?php
SproutVideo\Playlist::create_playlist(array(
  'title' => 'New Playlist',
  'privacy' => 2,
  'videos' => array('abc123','def456','ghi789'));
?>
```
## update_playlist

```php
<?php
SproutVideo\Playlist::update_playlist('abc123', array('title' => 'Update Playlist Title'));
?>
```
### videos
To add a video to a playlist, make sure to include all of the videos currently associated with that playlist. For instance if the playlist already has videos with the ids "abc" and "123" and you want to add a video with the id "def" do pass "abc", "123" and "def" to the update method.

```php
<?php
SproutVideo\Playlist::update_playlist('abc123', array('videos' => array("abc", "123", "def")));
?>
```

If you want to remove a video from a playlist, remove the video from the list of videos in the playlist but make sure to include all of the videos you wish to keep. For instance, if you now want to remove the video with id "123" from the example above, pass in "abc" and "def"

```php
<?php
SproutVideo\Playlist::update_playlist("abc123", array('videos' => array("abc","def")));
?>
```

You can remove all of the videos from a playlist by just passing an empty array as the videos parameter.

```php
<?php
SproutVideo\Playlist::update_playlist('abc123', array('videos' => array()));
?>
```

## delete_playlist
Pass in the id of the playlist you wish to delete.

```php
<?php
SproutVideo\Playlist::delete_playlist('abc123');
?>
```

# Logins
The following methods are available: `list_logins`, `create_login`, `get_login`, `update_login`, `delete_login`

## list
By default the login listing is paginated with 25 tags per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page.

```php
<?php
SproutVideo\Login::list_logins();
SproutVideo\Login::list_logins(array('per_page' => 10));
SproutVideo\Login::list_logins(array('per_page' => 10, 'page' => 2));
?>
```

## create_login
create_login takes two required parameters, `email` and `password`, which will be used to allow a viewer to login to watch a video if the login has an associated `access_grant` for that video.

```php
<?php
SproutVideo\Login::create_login(array(
  'email' => 'test@example.com',
  'password' => 'thisisthepassword'));
?>
```

## get_login
The string passed to get_login is the ID of a SproutVideo login.

```php
<?php
SproutVideo\Login::get_login('abc123');
?>
```

## update_login

You can change the password for a login.

```php
<?php
SproutVideo\Login::update_login('abc123',array(
  'password' => 'newpassword'));
?>
```

## delete_login
Pass in the id of the login you wish to delete.

```php
<?php
SproutVideo\Login::delete_login('asdf1234');
?>
```
# Access Grants
The following methods are available: `list_access_grants`, `create_access_grant`, `get_access_grant`, `update_acces_grant`, `delete_access_grant`

## list_access_grants
By default the access grant listing is paginated with 25 tags per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page.

```php
<?
SproutVideo\AccessGrant::list_access_grants();
SproutVideo\AccessGrant::list(array('per_page' => 10));
SproutVideo\AccessGrant::list(array('per_page' => 10, 'page' => 2));
?>
```

## create_access_grant
create_access_grant takes two required parameters, `video_id` and `login_id`, which will be used to allow a viewer to login to watch a video based on the other optional parameters.

```php
<?php
SproutVideo\AccessGrant::create_access_grant(array(
  'video_id' => 'abc123',
  'login_id' => 'abc123'));
?>
```
## bulk_create_access_grants
bulk_create_access_grants takes an array of access grant objects and creates them in a single API call to efficiently create access grants in bulk, and reduce the number of API calls needed.
```php
<?php
SproutVideo\AccessGrant::bulk_create_access_grants(
  array(
    array(
      'video_id' => 'abc123',
      'login_id' => 'abc123'
    ),
    array(
      'video_id' => 'def456',
      'login_id' => 'def456'
    )
  )
);
?>
```
## get_access_grant
The string passed to get_access_grant is the ID of a SproutVideo login.

```php
<?php
SproutVideo\AccessGrant::get_access_grant('abc123');
?>
```

## update_access_grant

You can change the optional parameters for an access grant.

```php
<?php
SproutVideo\AccessGrant.update_access_grant('abc123', array(
  'allowed_plays' => 20,
  'access_ends_at' => '2015-04-15T00:00:00+00:00'));
?>
```

## delete_access_grant
Pass in the id of the access grant you wish to delete.

```php
<?php
SproutVideo\AccessGrant::delete_access_grant('asdf1234')
?>
```
# Analytics
The following methods are available through the API client for analytics:

* play_counts
* domains
* geo
* video_types
* playback types
* device_types

Check the API documentation for more information about the data returned by these calls.

Each method can be called on it's own for overall account data for all time like this:
```php
<?php
SproutVideo\Analytics::play_counts();
SproutVideo\Analytics::domains();
SproutVideo\Analytics::geo();
SproutVideo\Analytics::video_types();
SproutVideo\Analytics::playback_types();
SproutVideo\Analytics::device_types();
?>
```
Each method can also take an options array containing a :video_id for retrieving overall data for a specific video:
```php
<?php
SproutVideo\Analytics::play_counts(array('video_id' => 'abc123'));
SproutVideo\Analytics::domains(array('video_id' => 'abc123'));
SproutVideo\Analytics::geo(array('video_id' => 'abc123'));
SproutVideo\Analytics::video_types(array('video_id' => 'abc123'));
SproutVideo\Analytics::playback_types(array('video_id' => 'abc123'));
SproutVideo\Analytics::device_types(array('video_id' => 'abc123'));
?>
```
The following methods can also take an options array containing a :live for retrieving overall data for a specific video:
```php
<?php
SproutVideo\Analytics::play_counts(array('live_stream_id' => 'abc123'));
SproutVideo\Analytics::domains(array('live_stream_id' => 'abc123'));
SproutVideo\Analytics::geo(array('live_stream_id' => 'abc123'));
SproutVideo\Analytics::device_types(array('live_stream_id' => 'abc123'));
?>
```
Each method can also take an optional :start_date and :end_date to specify a date range for the returned data:
```php
<?php
SproutVideo\Analytics::play_counts(array('start_date' => '2013-01-01'));
SproutVideo\Analytics::device_types(array('video_id' => 'abc123', 'end_date' => '2012-12-31'));
?>
```

The geo method can take an optional :country to retrieve playback data by city within that country
```php
<?php
SproutVideo\Analytics::geo(array('video_id' => 'abc123', 'country' => 'US'));
?>
```

## misc analytics endpoints
```php
<?php
SproutVideo\Analytics::popular_videos();
?>
```

# Engagement
You can grab the total number of seconds of your videos that have been watched like this:
```php
<?php
SproutVideo\Analytics::engagement();
?>
```

And for livestreams:
```php
<?php
SproutVideo\Analytics::live_streams_engagement();
?>
```

You can grab engagement for a specific video like so:
```php
<?php
SproutVideo\Analytics::engagement(array('video_id' => 'abc123'));
?>
```

And for a livestream:
```php
<?php
SproutVideo\Analytics::live_streams_engagement(array('live_stream_id' => 'abc123'));
?>
```

Lastly, you can grab every single playback session for a video like this:
```php
<?php
SproutVideo\Analytics::engagement_sessions('abc123')
SproutVideo\Analytics::engagement_sessions('abc123', array('page' => 3));
SproutVideo\Analytics::engagement_sessions('abc123', array('page' => 3, 'per_page' => 40));
?>
```

You can also grab engagement sessions for a video for a specific email address like so:
```php
<?php
SproutVideo\Analytics::engagement_sessions('abc123', array('vemail' => 'test@example.com'));
?>
```

You can also grab engagement sessions for a live stream:
```php
<?php
SproutVideo\Analytics::live_streams_engagement_sessions();
// and for a specific live stream
SproutVideo\Analytics::live_streams_engagement_sessions(array('live_stream_id' => 'abc123'));
?>
```

# Account
The following methods are available: `get_account`, `update_account`.

## get_account

```php
<?php
SproutVideo\Account::get_account();
?>
```

## update_account

```php
<?php
SproutVideo\Account::update_account(array('download_hd' => true));
?>
```

# Subtitles
The following methods are available: `list_subtitles`, `create_subtitle`, `get_subtitle`, `update_subtitle`, `delete_subtitle`.

## list_subtitles
By default, the subtitle listing is paginated with 25 subtitles per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page. You must pass a video_id in the options array.

```php
<?php
SproutVideo\Subtitle::list_subtitles(array('video_id' => 'abd124'));
SproutVideo\Subtitle::list_subtitles(array('video_id' => 'abd124', 'per_page' => 10));
SproutVideo\Subtitle::list_subtitles(array('video_id' => 'abd124', 'per_page' => 10, 'page' => 2));
?>
```

## create_subtitle
To create a subtitle, you must pass the following `data`: language and content. You must also pass the `video_id` option for the video you want to add the subtitle to.

```php
<?php
$data = array('language' => 'en', 'content' => 'WEBVTT FILE...');
$options = array('movie_id' => 'abc123');

SproutVideo\Subtitle::create_subtitle($data, $options);
?>
```

## update_subtitle

```php
<?php
$data = array('language' => 'fr');
$options = array('movie_id' => 'abc123', 'id' => 'cde345');

SproutVideo\Subtitle::update_subtitle($data, $options);
?>
```

## delete_subtitle
Pass in the id of the subtitle you wish to delete and it's associated video_id.

```php
<?php
$options = array('movie_id' => 'abc123', 'id' => 'cde345');
SproutVideo\Subtitle::delete_subtitle($options);
?>
```

# Calls to Action
The following methods are available: `list_ctas`, `create_cta`, `get_cta`, `update_cta`, `delete_cta`.

## list_ctas
By default, the cta listing is paginated with 25 ctas per page and sorted by created at date in ascending order. You can pass two parameters to control the paging: page and per_page. You must pass a video_id in the options array.

```php
<?php
SproutVideo\CallToAction::list_ctas(array('video_id' => 'abd124'));
SproutVideo\CallToAction::list_ctas(array('video_id' => 'abd124', 'per_page' => 10));
SproutVideo\CallToAction::list_ctas(array('video_id' => 'abd124', 'per_page' => 10, 'page' => 2));
?>
```

## create_cta
To create a cta, you must pass the following `data`: text, url, start_time, and end_time. You must also pass the `video_id` option for the video you want to add the cta to.

```php
<?php
$data = array('text' => 'get it done', 'url' => 'https://sproutvideo.com', 'start_time' => 1, 'end_time' => 2);
$options = array('movie_id' => 'abc123');

SproutVideo\CallToAction::create_cta($data, $options);
?>
```

## update_cta

```php
<?php
$data = array('text' => 'do something else');
$options = array('movie_id' => 'abc123', 'id' => 'cde345');

SproutVideo\CallToAction::update_cta($data, $options);
?>
```

## delete_cta
Pass in the id of the cta you wish to delete and it's associated video_id.

```php
<?php
$options = array('movie_id' => 'abc123', 'id' => 'cde345');
SproutVideo\CallToAction::delete_cta($options);
?>
```

# Contributing to sproutvideo-php

* Check out the latest master to make sure the feature hasn't been implemented or the bug hasn't been fixed yet.
* Check out the issue tracker to make sure someone already hasn't requested it and/or contributed it.
* Fork the project.
* Start a feature/bugfix branch.
* Commit and push until you are happy with your contribution.

## Setup

* download deps by running `composer install`
* run the test suite by running `./vendor/bin/phpunit tests`

# Copyright

Copyright (c) 2021 SproutVideo. See LICENSE.txt for further details.
