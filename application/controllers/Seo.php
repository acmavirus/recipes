<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seo extends PUBLIC_Controller
{
    protected $_category;
    protected $_page;
    protected $_post;
    protected $_post_recipes;

    protected $urls;
    protected $changefreqs;
    protected $_limit_url;
    protected $xml;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Category_model', 'Page_model', 'Post_model', 'Post_recipes_model']);
        $this->_category = new Category_model();
        $this->_page     = new Page_model();
        $this->_post     = new Post_model();
        $this->_post_recipes     = new Post_recipes_model();

        $this->urls = array();
        $this->changefreqs = array(
            'always',
            'hourly',
            'daily',
            'weekly',
            'monthly',
            'yearly',
            'never'
        );
        $this->_limit_url = 500;
    }

    public function sitemap()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"/>');

        $child = $xml->addChild('url');
        $child->addChild('loc', site_url('sitemap_category.xml'));
        $child->addChild('lastmod', date('c'));

        $child = $xml->addChild('url');
        $child->addChild('loc', site_url('sitemap_page.xml'));
        $child->addChild('lastmod', date('c'));

        $totalPOST = $this->_post_recipes->all();
        for ($i = 1; $i <= ceil($totalPOST / $this->_limit_url); $i++) {
            $child = $xml->addChild('url');
            $child->addChild('loc', site_url("sitemap_post_$i.xml"));
            $child->addChild('lastmod', date('c'));
        }

        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }

    public function category()
    {
        $all = $this->_category->getData([
            'page' => 1,
            'limit' => $this->_limit_url
        ]);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns=\'http://www.sitemaps.org/schemas/sitemap/0.9\' xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"/>');
        foreach ($all as $key => $item) {
            $child = $xml->addChild('url');
            $child->addChild('loc', getCatUrl($item->slug));
            $child->addChild('lastmod', date('c', strtotime($item->updated_time)));
            $child->addChild('changefreq', 'always');
            $child->addChild('priority', '0.9');
        }
        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }

    public function page()
    {
        $all = $this->_page->getData([
            'page' => 1,
            'limit' => $this->_limit_url
        ]);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns=\'http://www.sitemaps.org/schemas/sitemap/0.9\' xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"/>');
        foreach ($all as $key => $item) {
            $child = $xml->addChild('url');
            $child->addChild('loc', base_url($item->slug));
            $child->addChild('lastmod', date('c', time()));
            $child->addChild('changefreq', 'hourly');
            $child->addChild('priority', '0.9');
        }
        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }

    public function post($page = 1)
    {
        $all = $this->_post_recipes->getData([
            'page' => $page,
            'limit' => $this->_limit_url
        ]);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns=\'http://www.sitemaps.org/schemas/sitemap/0.9\' xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"/>');
        foreach ($all as $key => $item) {
            $child = $xml->addChild('url');
            $child->addChild('loc', getUrlContent($item->slug));
            $child->addChild('lastmod', date('c', strtotime($item->updated_time)));
            $child->addChild('changefreq', 'always');
            $child->addChild('priority', '0.9');
        }
        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }
}
