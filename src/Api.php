<?php


namespace Seek\QuansutongSDK;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    const ROOT_URL = 'http://171.15.17.81:9530';

    protected $_appKey;
    protected $_appSecret;
    protected $code;

    public function __construct(string $appKey, string $appSecret, string $ebusinessQstCode)
    {
        $this->_appKey = $appKey;
        $this->_appSecret = $appSecret;
        $this->code = $ebusinessQstCode;
    }


    public function request($url, $params)
    {
        $params['ebusinessQstcode'] = $this->code;
        $http = $this->getHttp();
        $headers = $this->headers($params);
        $http->addMiddleware($this->headerMiddleware($headers));
        $response = $http->post(self::ROOT_URL . '/api/' . $url, $params);

        return json_decode(strval($response->getBody()), true);
    }

    /**
     * @param string $md5Str
     * @param string $timestamp
     * @return string
     */
    private function signature(string $md5Str, string $timestamp): string
    {
        return base64_encode(hash_hmac('sha256', $md5Str . $timestamp . $this->_appSecret, $this->_appSecret, true));


    }

    /**
     * @param array $params 应用参数
     * @return array
     */
    private function headers(array $params): array
    {
        $headers = [];
        $headers['timestamp'] = time();
        $headers['md5'] = md5(json_encode($params));
        $headers['signature'] = $this->signature($headers['md5'], $headers['timestamp']);

        return $headers;
    }
}