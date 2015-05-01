<!doctype html>
<html>
<head>
  <title>Token Uploads</title>
</head>
<body>
  <?php
  if (isset($_GET['success'])) {
    print_r($_GET);
  } else {
    require 'vendor/autoload.php';
    SproutVideo::$api_key = ''; # replace with your API key
    $token = SproutVideo\UploadToken::create_upload_token(array('return_url' => 'http://localhost/token_upload.php'));
  ?>
  <form action='https://api.sproutvideo.com/v1/videos' method='post' enctype='multipart/form-data'>
      <fieldset>
        <legend>Upload:</legend>
        Title: <input name='title'><br/>
        Description: <textarea name='description'></textarea><br/>
        File: <input name='source_video' type='file'>
        <input type='hidden' name='token' value='<?= $token['token'] ?>'><br/>
        <input type='submit' value='Upload'>
      </fieldset>
    </form>
  <?php } ?>
</body>
</html>
