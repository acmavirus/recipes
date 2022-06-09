<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Goutte\Client;
use GuzzleHttp\Cookie\CookieJarInterface;

class Crawler extends CI_Controller
{
    protected $_client;

    public function __construct()
    {
        parent::__construct();
        $domain = 'blackdragon.mobi';
        $values = ['PHPSESSID' => 'vlhamf89urhma8jhuibuhrmtu0'];
        $cookieJar = GuzzleHttp\Cookie\CookieJar::fromArray($values, $domain);

        $this->_client = new GuzzleHttp\Client([
            'cookies'  => $cookieJar
        ]);
    }

    public function test()
    {
        $crawler = $this->_client->request('GET', "https://blackdragon.mobi/library/index/c=68715");
        dd($crawler);
    }
}
