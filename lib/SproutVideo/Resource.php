<?php
namespace SproutVideo;

use GuzzleHttp\Client;

class Resource
{
    protected static function get($path, $options=null)
    {
        $client = self::getHttpClient();
        $response = $client->get($path, array('query' => $options));
		var_dump($response);
        return $response->json();
    }

    protected static function post($path, $body, $options=null)
    {
        $client = self::getHttpClient();
        $response = $client->post(
            $path,
            array(
            'body' => json_encode($body),
            'query' => $options,
            )
        );
        return $response->json();
    }

    protected static function put($path, $body, $options=null)
    {
        $client = self::getHttpClient();
        $response = $client->put(
            $path,
            array(
            'body' => json_encode($body),
            'query' => $options,
            )
        );
        return $response->json();
    }

    protected static function delete($path, $options=null)
    {
        $client = self::getHttpClient();
        $response = $client->delete($path, array('query' => $options));
        return $response->json();
    }

    protected static function upload($path, $file, $body, $options, $method='POST')
    {
        $client = self::getHttpClient();
        if($method == 'POST') {
            $response = $client->post(
                $path, array(
                'body' => array(
                'source_video' => fopen($file, 'r'),
                ),
                'query' => $options
                )
            );
        } else {
            $response = $client->post(
                $path, array(
                'body' => array(
                'custom_poster_frame' => fopen($file, 'r'),
                '_method' => 'PUT',
                ),
                'query' => $options
                )
            );
        }
        return $response->json();
    }

    protected static function getHttpClient()
    {
        $client = new Client(
            array(
            'base_url' => \SproutVideo::$base_url,
            'defaults' => array(
            'headers' => array(
            'SproutVideo-Api-Key' => \SproutVideo::$api_key,
            'Content-Type', 'application/json;charset=utf-8'
            ),
            )
            )
        );
        return $client;
    }
}
