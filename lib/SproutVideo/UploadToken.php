<?php
namespace SproutVideo;
class UploadToken extends Resource
{
  public static function create_upload_token($data, $options=null)
  {
    return self::post('upload_tokens', $data, $options);
  }
}
?>
