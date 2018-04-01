<?php

  namespace Xtroo;

  use Xtroo\Exceptions\XtrooException;
  use Http\Discovery\HttpClientDiscovery;
  use Http\Discovery\MessageFactoryDiscovery;
  use Http\Client\Common\HttpMethodsClient;
  use Http\Client\Common\PluginClient;
  use Http\Client\Common\Plugin\HeaderSetPlugin;


  /**
   * Class Xtroo
   *
   * The main API class
   *
   * @package Xtroo
   */
  class Xtroo
  {
    protected $token = null;

    protected $urlEndpooint = 'http://xtroo.io/api/';

    private $client = null;

    function __construct($token = null)
    {
      if ($token == null)
        throw new XtrooException('Missing Token, please set API Token');

      $this->token = $token;
    }

    /**
     * Get the set token
     *
     * @return null|string
     */
    public function getToken()
    {
      return $this->token;
    }

    /**
     * Set up / Get the HTTP Client
     *
     * @param HttpMethodsClient|null $client
     *
     * @return $this
     */
    public function httpClient(HttpMethodsClient $client = null)
    {
      if ($client === null && $this->client === null)
      {
        $headerSetPlugin = new HeaderSetPlugin([
          'api' => $this->token,
        ]);

        $client = HttpClientDiscovery::find();

        $client = new PluginClient(
          $client,
          [
            $headerSetPlugin
          ]
      );

        $client = new HttpMethodsClient(
          $client,
          MessageFactoryDiscovery::find()
        );
      }

      $this->client = $client;

      return $this->client;
    }

    /**
     * Actually go ahead and make the call
     *
     * @param $endpoint
     * @param $params
     * @throws XtrooException
     */
    private function makeCall($endpoint, $params)
    {
      $client = $this->httpClient();

      $querystring = '?';

      foreach ($params as $field => $value)
        $querystring .= '&' . $field . '=' . urlencode($value);

      $response = $client->get($this->urlEndpooint . $endpoint . $querystring);

      $json = json_decode($response->getBody()->getContents());

      if (!is_object($json))
        throw new XtrooException('Invalid URL or URL problem.');

      return $json;
    }

    /**
     * Get an articles content
     *
     * @param $url
     * @return mixed
     * @throws XtrooException
     */
    public function getContent($url)
    {
      $json = $this->makeCall('content', [
        'url' => $url
      ]);

      return $json;
    }
  }