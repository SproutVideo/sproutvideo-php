<?php
namespace SproutVideo;

class CurlClient
{
  protected $ch;
  protected $headers;

  public function __construct()
  {
    $this->ch = curl_init();
    curl_setopt_array($this->ch, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_USERAGENT => 'SproutVideo PHP API Client'
    ));
    $this->headers = array();
    $this->addHeader('SproutVideo-Api-Key', \SproutVideo::$api_key);

  }

  public function addHeader($key, $value)
  {
    $this->headers[$key] = $value;
    $headers = array();
    foreach ($this->headers as $key => $value){
      $headers[] = $key . ': ' . $value;
    }
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
  }

  private function request($method, $uri, $body, $options = null, $upload = false)
  {
    $url = \SproutVideo::$base_url . '/' . $uri;
    if(!is_null($options)) {
      $url .= '?' . http_build_query($options);
    }

    curl_setopt_array($this->ch, array(
      CURLOPT_URL => $url,
      CURLOPT_CUSTOMREQUEST => $method
    ));

    if(!is_null($body)) {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);
    }

    if ($upload == false && ($method == 'POST' || $method == 'PUT')) {
      $this->addHeader('Content-Type', 'application/json;charset=utf-8');
      $this->addHeader('Content-Length', strlen($body));
    }

    $result = curl_exec($this->ch);

    if($result === false) {
      $exception = new \Exception(curl_error($this->ch));
      curl_close($this->ch);
      throw $exception;
    } else {
      curl_close($this->ch);
    }

    return json_decode($result, true);
  }

  public function get($uri, $options = null)
  {
    return $this->request('GET', $uri, null, $options);
  }

  public function post($uri, $body, $options = null)
  {
    return $this->request('POST', $uri, $body, $options);
  }

  public function put($uri, $body, $options=null)
  {
    return $this->request('PUT', $uri, $body, $options);
  }

  public function delete($uri, $options = null)
  {
    return $this->request('DELETE', $uri, $body, $options);
  }

  public function upload($uri, $body, $options, $method = 'POST')
  {
    return $this->request($method, $uri, $body, $options, true);
  }
}

?>
