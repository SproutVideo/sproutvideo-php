<?php
namespace SproutVideo;

class Resource
{
	protected static function get($path, $options=null)
	{
		$client = new CurlClient();
		$response = $client->get($path, $options);
		return $response;
	}

	protected static function post($path, $body, $options=null)
	{
		$client = new CurlClient();
		$response = $client->post($path, json_encode($body), $options);
		return $response;
	}

	protected static function put($path, $body, $options=null)
	{
		$client = new CurlClient();
		$response = $client->put($path, json_encode($body), $options);
		return $response;
	}

	protected static function delete($path, $options=null)
	{
		$client = new CurlClient();
		$response = $client->delete($path, $options);
		return $response;
	}

	protected static function upload($path, $file, $body, $options, $field_name)
	{
		$client = new CurlClient();

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, $file);
		$c_file = new \CurlFile($file, $mime_type, $field_name);

		$c_file->setPostFilename(basename($file));

		if (is_null($body)) {
			$body = array();
		}

		$body[$field_name] = $c_file;

        $method = null;
        if (!empty($options) && $options['method']) {
            $method = $options['method'];
		    unset($options['method']);
        }

		$response = $client->upload($path, $body, $options, $method);

		return $response;
	}
}
?>
