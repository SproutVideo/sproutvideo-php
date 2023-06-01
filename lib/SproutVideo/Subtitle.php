<?php
namespace SproutVideo;
class Subtitle extends Resource
{
	public static function list_subtitles($options)
	{
		return self::get(self::build_url($options), $options);
	}

	public static function get_subtitle($options)
	{
		return self::get(self::build_url($options).'/'.$options['id'], $options);
	}

	public static function create_subtitle($data, $options)
	{
		return self::post(self::build_url($options), $data, $options);
	}

	public static function update_subtitle($data, $options)
	{
		return self::put(self::build_url($options).'/'.$options['id'], $data, $options);
	}

	public static function delete_subtitle($options)
	{
		return self::delete(self::build_url($options).'/'.$options['id'], $options);
	}

    private static function build_url($options)
    {
        if (!array_key_exists('video_id', $options)) {
            throw new \Exception('video_id must be set');
        }
        return "videos/{$options["video_id"]}/subtitles";
    }
}
?>
