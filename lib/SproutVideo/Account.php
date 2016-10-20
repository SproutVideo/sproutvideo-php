<?php
namespace SproutVideo;
class Account extends Resource
{
  public static function get_account()
  {
    return self::get('account', null);
  }

  public static function update_account($body=null)
  {
    return self::put('account', $body, null);
  }
}
?>
