<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $_controller;
    public $_method;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();
        //load cache driver
        $this->load->driver('cache', array('adapter' => CACHE_ADAPTER, 'backup' => 'file', 'key_prefix' => CACHE_PREFIX_NAME));
    }
    function session($type, $data)
    {
        switch ($type) {
            case 'set':
                $this->session->set_userdata($data);
                break;
            case 'remove':
                $this->session->unset_userdata($data);
                break;
        }
    }

    public function setCacheFile($timeOut = 1)
    {
        $this->output->cache($timeOut);
    }
    public function setCache($key, $data, $timeOut = 3600)
    {
        $this->cache->save($key, $data, $timeOut);
    }

    public function getCache($key)
    {
        return $this->cache->get($key);
    }

    public function deleteCache($key = null)
    {
        if (!empty($key)) {
            return $this->cache->delete($key);
        } else return $this->cache->clean();
    }

    public function geneJsonFile($url = 'database/setting_dashboard.json', $cache_name = 'cache_dbsetting', $cache = true)
    {
        if ($cache == true) $data = $this->getCache($cache_name);
        if (empty($data)) if ($cache == true) {
            $data = json_decode(file_get_contents(base_url($url)));
            $this->setCache($cache_name, $data);
        }
        return $data;
    }

    public function toSetting()
    {
        $data = $this->getCache('settings');
        if (empty($data)) {
            $data = json_decode(file_get_contents(base_url('settings.json')));
            $this->setCache('settings', $data);
        }
        return $data;
    }

    public function cUrl($url, array $post_data = array(), $delete = false, $verbose = false, $ref_url = false, $cookie_location = false, $return_transfer = true)
    {
        $pointer = curl_init();

        curl_setopt($pointer, CURLOPT_URL, $url);
        curl_setopt($pointer, CURLOPT_TIMEOUT, 40);
        curl_setopt($pointer, CURLOPT_RETURNTRANSFER, $return_transfer);
        curl_setopt($pointer, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.28 Safari/534.10");
        curl_setopt($pointer, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($pointer, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($pointer, CURLOPT_HEADER, false);
        curl_setopt($pointer, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($pointer, CURLOPT_AUTOREFERER, true);
        curl_setopt($pointer, CURLOPT_SSL_VERIFYPEER, false);
        if ($cookie_location !== false) {
            curl_setopt($pointer, CURLOPT_COOKIEJAR, $cookie_location);
            curl_setopt($pointer, CURLOPT_COOKIEFILE, $cookie_location);
            curl_setopt($pointer, CURLOPT_COOKIE, session_name() . '=' . session_id());
        }

        if ($verbose !== false) {
            $verbose_pointer = fopen($verbose, 'w');
            curl_setopt($pointer, CURLOPT_VERBOSE, true);
            curl_setopt($pointer, CURLOPT_STDERR, $verbose_pointer);
        }

        if ($ref_url !== false) {
            curl_setopt($pointer, CURLOPT_REFERER, $ref_url);
        }

        if (count($post_data) > 0) {
            curl_setopt($pointer, CURLOPT_POST, true);
            curl_setopt($pointer, CURLOPT_POSTFIELDS, $post_data);
        }
        if ($delete !== false) {
            curl_setopt($pointer, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $return_val = curl_exec($pointer);

        $http_code = curl_getinfo($pointer, CURLINFO_HTTP_CODE);

        if ($http_code == 404) {
            return false;
        }

        curl_close($pointer);

        unset($pointer);

        return $return_val;
    }

    function sendXmlOverPost($url, $xml)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // For xml, change the content-type.
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned

        // Send to remote and return data to caller.
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function toSlug($doc)
    {
        $str = addslashes(html_entity_decode($doc));
        $str = $this->toNormal($str);
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace("\/", '', $str);
        $str = str_replace("+", "", $str);
        $str = strtolower($str);
        $str = stripslashes($str);
        return trim($str, '-');
    }

    public function toNormal($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    public function returnJson($data = null)
    {
        if ($this->config->item('csrf_protection') == TRUE) {
            $csrf = [
                'csrf_form' => [
                    'csrf_name' => $this->security->get_csrf_token_name(),
                    'csrf_value' => $this->security->get_csrf_hash()
                ]
            ];
            if (empty($data)) $data = $this->_message;
            $data = array_merge($csrf, (array) $data);
        }
        die(json_encode($data));
    }

    public function array_group_by(array $arr, callable $key_selector)
    {
        $result = array();
        foreach ($arr as $i) {
            $key = call_user_func($key_selector, $i);
            $result[$key][] = $i;
        }
        return $result;
    }

    function getFeeds(string $url, int $feedLimit)
    {
        $feeds = [];
        $rss_tags = array('title', 'link', 'guid', 'comments', 'description', 'pubDate', 'category');
        $rss_item_tag = 'item';
        $doc = new DOMdocument();
        $doc->load($url);
        $items = array();
        foreach ($doc->getElementsByTagName($rss_item_tag) as $node) {
            foreach ($rss_tags as $key => $value) {
                if (is_object($node->getElementsByTagName($value)->item(0))) {
                    //do your stuff
                    if ($value === 'description') {
                        $str = $node->getElementsByTagName($value)->item(0)->nodeValue;
                        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
                        $items['image'] = null;
                        if (!empty($image['src'])) $items['image'] = $image['src'];
                        $items[$value] = strip_tags($str);
                    } else {
                        $items[$value] = $node->getElementsByTagName($value)->item(0)->nodeValue;
                    }
                }
            }
            array_push($feeds, $items);
        };
        return $feeds;
    }

    public function recaptcha_verify_request()
    {
        if (!$this->recaptcha_status) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                return true;
            }
        }
        return false;
    }

    public function __loadadminview($view, $data)
    {
        $data['main'] = $this->load->view($view, $data, true);
        $this->load->view('admin/layout', $data);
    }
}

class Admin_Controller extends MY_Controller
{
    public $_data;
    function __construct()
    {
        parent::__construct();
        $this->_template_path = 'default/';
        $this->_templates_assets = base_url('public/admin/');
        $this->template_admin = 'admin';
        $this->load->model('admin/Common_model');
        $this->_data = new Common_model();
    }

    public function ___root()
    {
        $data = [];
        return $data;
    }

    public function __breadcrumb()
    {
        $breadcrumb = [];
        $root = $this->_data->getDataBy('admin_menu', ['url' => 'admin']);
        $page = $this->_data->getDataBy('admin_menu', ['url' => str_replace('/index.php/', '', $_SERVER['PHP_SELF'])]);
        if (!empty($page) && $page['parent_id'] != 0) $parent = $this->_data->getDataBy('admin_menu', ['id' => $page['parent_id']]);
        if (!empty($parent) && $parent['parent_id'] != 0) $grandf = $this->_data->getDataBy('admin_menu', ['id' => $parent['parent_id']]);
        $breadcrumb['root'] = $root;
        if (!empty($grandf)) $breadcrumb['grandf'] = $grandf;
        if (!empty($parent)) $breadcrumb['parent'] = $parent;
        $breadcrumb['page'] = $page;
        return $breadcrumb;
    }
}

class Public_Controller extends MY_Controller
{
    protected $_setting;
    function __construct()
    {
        parent::__construct();
        $this->_template_path = 'default/';
        $this->_templates_assets = base_url('public/admin/');
        $this->template_main = 'default';
        $this->load->model('admin/Settings_model');
        $this->_setting = new Settings_model();
    }

    public function setting()
    {
        $data['setting'] = $this->_setting->getAll();
        return $data;
    }
}
