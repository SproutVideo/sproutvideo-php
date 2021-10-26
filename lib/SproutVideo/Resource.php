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
		$c_file = new \CurlFile($file, null, $field_name);

		$c_file->setPostFilename(basename($file));

		if (is_null($body)) {
			$body = array();
		}

		array_push($body, $c_file);

        $method = null;
        if (!empty($options) && $options['method']) {
            $method = $options['method'];
		    unset($options['method']);
        }
        echo json_encode($body);

		$response = $client->upload($path, $body, $options, $method);

		return $response;
	}
}
?>
