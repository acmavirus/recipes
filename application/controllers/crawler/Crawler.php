<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Goutte\Client;
use GuzzleHttp\Cookie\CookieJarInterface;

class Crawler extends CI_Controller
{
    protected $_client;
    protected $_category;
    protected $_page;
    protected $_post;
    protected $_post_recipes;
    protected $_post_cardriving;

    public function __construct()
    {
        parent::__construct();
        $domain = 'blackdragon.mobi';
        $values = ['PHPSESSID' => 'vlhamf89urhma8jhuibuhrmtu0'];
        $cookieJar = GuzzleHttp\Cookie\CookieJar::fromArray($values, $domain);

        $this->_client = new GuzzleHttp\Client([
            'cookies'  => $cookieJar
        ]);
        $this->load->model(['Category_model', 'Page_model', 'Post_model', 'Post_recipes_model', 'Post_cardriving_model']);
        $this->_category = new Category_model();
        $this->_page     = new Page_model();
        $this->_post     = new Post_model();
        $this->_post_recipes     = new Post_recipes_model();
        $this->_post_cardriving     = new Post_cardriving_model();
    }

    public function test()
    {
        $file = file_get_contents(base_url("database/skill.txt"));
        $file = explode("<br>", $file);
        foreach ($file as $key => $value) {
            if (!empty(trim($value))) {
                $save = [
                    'content' => trim($value),
                    'type' => 'skill'
                ];
                $this->_post_cardriving->insert($save);
            }
        }
    }

    public function getimg()
    {
        $data = $this->_post_recipes->getData([
            'limit' => 9677
        ]);
        foreach ($data as $key => $item) {
            $img = $item->img;
            if (strpos($img, 'ttps://') !== false) {
                $pathinfo = pathinfo($img);
                $nameIMG = $pathinfo['filename'] . '.' . $pathinfo['extension'];
                $saveIMG = $this->saveIMG($img, "media/img/$nameIMG");
                if ($saveIMG == true) {
                    $this->_post_recipes->update(['id' => $item->id], ['img' => "media/img/$nameIMG"]);
                }
            } else {
                echo "\n ==========  =========== \n";
            }
        }
    }

    private function saveIMG($url, $newFolder)
    {
        $url = str_replace("\\", "/", $url);
        if (file_get_contents($url)) {
            file_put_contents($newFolder, file_get_contents($url));
            echo "\n ========== save $url =========== \n";
            return true;
        } else {
            echo "\n ========== error $url =========== \n";
            return false;
        }
    }

    private function saveJSON($src, $newFolder, $data)
    {
        $data['img'] = $newFolder . basename($src);
        $rs = json_encode($data);
        file_put_contents("database/$data[slug].json", $rs);
    }

    private function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
