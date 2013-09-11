<?php
require 'vendor/autoload.php';
SproutVideo::$api_key = ''; # replace with your API key

if (empty($_FILES)) {
?>
<form method="post" enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="Submit">
</form>

<?php
} else {
	//rename the file so that it is named correctly on SproutVideo.
	$dir = dirname($_FILES["file"]["tmp_name"]);
	$destination = $dir . '/' . $_FILES["file"]["name"];
	rename($_FILES["file"]["tmp_name"], $destination);

	//upload!
	$result = SproutVideo\Video::create_video("@{$destination}");
}
?>
<pre>
<?php
	print_r($result);
?>
</pre>

