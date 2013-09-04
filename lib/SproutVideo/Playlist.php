<?php
namespace SproutVideo;
class Playlist extends Resource
{
	public static function list_playlists($options=null)
	{
		return self::get('playlists', $options);
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
}
?>