<?php
namespace SproutVideo;

use Guzzle\Http\Client;

class Resource
{
	protected static function get($path, $options=null)
	{
		$client = new Client(\SproutVideo::$base_url);

		if(is_null($options)){
			$request = $client->get($path);
		} else {
			$request = $client->get($path, array(), array('query' => $options));	
		}
		
		$request->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);
		$response = $request->send();
		return $response->json();
	}

	protected static function post($path, $body, $options=null)
	{
		$client = new Client(\SproutVideo::$base_url);
		if(is_null($options)) {
			$request = $client->post($path, null, json_encode($body));
		} else {
			$request = $client->post($path, null, json_encode($body), array('query' => $options));
		}
		$request->addHeader('Content-Type', 'application/json;charset=utf-8');
		$request->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);
		$response = $request->send();
		return $response->json();

	}

	protected static function put($path, $body, $options=null)
	{
		$client = new Client(\SproutVideo::$base_url);
		if(is_null($options)) {
			$request = $client->put($path, null, json_encode($body));
		} else {
			$request = $client->put($path, null, json_encode($body), array('query' => $options));
		}
		$request->addHeader('Content-Type', 'application/json;charset=utf-8');
		$request->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);
		$response = $request->send();
		return $response->json();
	}

	protected static function delete($path, $options=null)
	{
		$client = new Client(\SproutVideo::$base_url);

		if(is_null($options)){
			$request = $client->delete($path);
		} else {
			$request = $client->delete($path, array(), array('query' => $options));	
		}
		
		$request->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);
		$response = $request->send();
		return $response->json();
	}

	protected static function upload($path, $file, $body, $options, $method='POST')
	{
		$client = new Client(\SproutVideo::$base_url);
		if(is_null($options)){
			if(is_null($body)) {
				$request = $client->post($path);
			} else {
				$request = $client-> post($path, null, $body);
			}
		} else {
			$request = $client->post($path, null, $body, array('query' => $options));
		}
		if($method == 'POST') {
			$request->addPostFiles(array('source_video' => $file));
		} else {
			$request->setPostField('_method', 'PUT');
			$request->addPostFiles(array('custom_poster_frame' => $file));
		}
		$request->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);
		$response = $request->send();
		return $response->json();
	}
}
?>