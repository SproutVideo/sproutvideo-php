<?php
namespace SproutVideo;
class AccessGrant extends Resource
{
	public static function list_access_grants($options=null)
	{
		return self::get('access_grants', $options);
	}

	public static function get_access_grant($access_grant_id, $options=null)
	{
		return self::get('access_grants/'.$access_grant_id, $options);
	}

	public static function create_access_grant($data, $options=null)
	{
		return self::post('access_grants', $data, $options);
	}

	public static function update_access_grant($access_grant_id, $data, $options=null)
	{
		return self::put('access_grants/'.$access_grant_id, $data, $options);
	}

	public static function delete_access_grant($access_grant_id, $options=null)
	{
		return self::delete('access_grants/'.$access_grant_id, $options);
	}
}
?>