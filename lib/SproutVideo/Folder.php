<?php
namespace SproutVideo;
class Folder extends Resource
{
  public static function list_folders($options=null)
  {
    return self::get('folders', $options);
  }

  public static function get_folder($folder_id, $options=null)
  {
    return self::get('folders/'.$folder_id, $options);
  }
  
  public static function create_folder($data, $options=null)
  {
    return self::post('folders', $data, $options);
  }

  public static function update_folder($folder_id, $data, $options=null)
  {
    return self::put('folders/'.$folder_id, $data, $options);
  }

  public static function delete_folder($folder_id, $options=null)
  {
    return self::delete('folders/'.$folder_id, $options);
  }
}
?>