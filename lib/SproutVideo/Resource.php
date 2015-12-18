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

	protected static function upload($path, $file, $body, $options, $method='POST')
	{
		$client = new CurlClient();
		$c_file = new \CurlFile($file, null, $method == 'POST' ? 'source_video' : 'custom_poster_frame');

		$c_file->setPostFilename(basename($file));

		if(is_null($body)) {
			$body = array();
		}

		array_push($body, $c_file);

		$response = $client->upload($path, $body, $options, $method);

		return $response;
	}
}
?>
