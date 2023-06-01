<?php
namespace SproutVideo;
class CallToAction extends Resource
{
	public static function list_ctas($options)
	{
		return self::get(self::build_url($options), $options);
	}

	public static function get_cta($options)
	{
		return self::get(self::build_url($options).'/'.$options['id'], $options);
	}

	public static function create_cta($data, $options)
	{
		return self::post(self::build_url($options), $data, $options);
	}

	public static function update_cta($data, $options)
	{
		return self::put(self::build_url($options).'/'.$options['id'], $data, $options);
	}

	public static function delete_cta($options)
	{
		return self::delete(self::build_url($options).'/'.$options['id'], $options);
	}

    private static function build_url($options)
    {
        if (!array_key_exists('video_id', $options)) {
            throw new \Exception('video_id must be set');
        }
        return "videos/{$options["video_id"]}/calls_to_action";
    }
}
?>
