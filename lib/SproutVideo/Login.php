<?php
namespace SproutVideo;
class Login extends Resource
{
	public static function list_logins($options=null)
	{
		return self::get('logins', $options);
	}

	public static function get_login($login_id, $options=null)
	{
		return self::get('logins/'.$login_id, $options);
	}

	public static function create_login($data, $options=null)
	{
		return self::post('logins', $data, $options);
	}

	public static function update_login($login_id, $data, $options=null)
	{
		return self::put('logins/'.$login_id, $data, $options);
	}

	public static function delete_login($login_id, $options=null)
	{
		return self::delete('logins/'.$login_id, $options);
	}
}
?>