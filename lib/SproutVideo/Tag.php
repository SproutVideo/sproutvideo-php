<?php
namespace SproutVideo;
class Tag extends Resource
{
	public static function list_tags($options=null)
	{
		return self::get('tags', $options);
	}

	public static function get_tag($tag_id, $options=null)
	{
		return self::get('tags/'.$tag_id, $options);
	}

	public static function create_tag($data, $options=null)
	{
		return self::post('tags', $data, $options);
	}

	public static function update_tag($tag_id, $data, $options=null)
	{
		return self::put('tags/'.$tag_id, $data, $options);
	}

	public static function delete_tag($tag_id, $options=null)
	{
		return self::delete('tags/'.$tag_id, $options);
	}
}
?>