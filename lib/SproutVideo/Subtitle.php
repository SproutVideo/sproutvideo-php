<?php
namespace SproutVideo;
class Subtitle extends Resource
{
	public static function list_subtitles($options=null)
	{
		return self::get(self::build_url($options), $options);
	}

	public static function get_playlist($playlist_id, $options=null)
	{
		return self::get('playlists/'.$playlist_id, $options);
	}

	public static function create_playlist($data, $options=null)
	{
		return self::post('playlists', $data, $options);
	}

	public static function update_playlist($playlist_id, $data, $options=null)
	{
		return self::put('playlists/'.$playlist_id, $data, $options);
	}

	public static function delete_playlist($playlist_id, $options=null)
	{
		return self::delete('playlists/'.$playlist_id, $options);
	}

    private static function build_url($options)
    {
        if (!array_key_exists('video_id', $options)) {
            throw new \Exception('video_id must be set');
        }
        return "videos/${options["video_id"]}/subtitles";
    }
}
?>