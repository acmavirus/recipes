<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Facebook\InstantArticles\AMP\AMPArticle;

class Seo extends Public_Controller
{
    protected $urls;
    protected $changefreqs;
    protected $_limit_url = 10000;
    protected $_data_post;
    protected $_data_category;
    protected $_data_store;
    protected $_data_deals;
    protected $_data_tags;
    protected $xml;

    public function __construct()
    {
        parent::__construct();
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
        $this->load->model(['Category_model', 'Page_model', 'Post_model', 'Post_recipes_model']);
        $this->_category = new Category_model();
        $this->_page     = new Page_model();
        $this->_post     = new Post_model();
        $this->_post_recipes     = new Post_recipes_model();
    }

    public function sitemap()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        
        $child = $xml->addChild('sitemap');
        $child->addChild('loc', site_url('sitemap_category.xml.gz'));
        $child->addChild('lastmod', date('c'));

        $child = $xml->addChild('sitemap');
        $child->addChild('loc', site_url('sitemap_page.xml.gz'));
        $child->addChild('lastmod', date('c'));

        $child = $xml->addChild('sitemap');
        $child->addChild('loc', site_url("sitemap_post.xml.gz"));
        $child->addChild('lastmod', date('c'));

        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }

    public function category()
    {
        $this->setCacheFile(60 * 60);
        $this->add(base_url(), null, date('c'), 'always', 1);
        $all = $this->_category->getData([
            'page' => 1,
            'limit' => $this->_limit_url
        ]);
        foreach ($all as $key => $item) {
            $url = getCatUrl($item->slug);
            $this->add($url, null, date('c'), 'always', 0.8);
        }
        $this->output();
    }

    public function page()
    {
        $this->setCacheFile(60 * 60);
        $this->add(base_url(), null, date('c'), 'always', 1);
        $all = $this->_category->getData([
            'page' => 1,
            'limit' => $this->_limit_url
        ]);
        foreach ($all as $key => $item) {
            $url = getCatUrl($item->slug);
            $this->add($url, null, date('c'), 'always', 0.8);
        }
        $this->output();
    }


    public function post()
    {
        $all = $this->_post_recipes->getData([
            'page' => 1,
            'limit' => 20000
        ]);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"  xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"/>');
        if (!empty($all)) {
            foreach ($all as $item) {
                $child = $xml->addChild('url');
                $child->addChild('loc', getUrlContent($item->slug));
                if (isset($item->img)) {
                    $image = $child->addChild('image:image:image');
                    $image->addChild('image:image:loc', !empty($item->img) ? getImageThumb($item->img, 470, 246) : '');
                    $image->addChild('image:image:title', $item->title);
                }
                if (isset($item->updated_time)) {
                    $child->addChild('lastmod', date('c', strtotime($item->updated_time)));
                }
                $child->addChild('changefreq', 'always');
                $child->addChild('priority', '0.8');
            }
        }
        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }

    public function add($loc, $image = null, $lastmod = null, $changefreq = null, $priority = null)
    {
        // Do not continue if the changefreq value is not a valid value
        if ($changefreq !== null && !in_array($changefreq, $this->changefreqs)) {
            show_error('Unknown value for changefreq: ' . $changefreq);
            return false;
        }
        // Do not continue if the priority value is not a valid number between 0 and 1
        if ($priority !== null && ($priority < 0 || $priority > 1)) {
            show_error('Invalid value for priority: ' . $priority);
            return false;
        }
        $item = new stdClass();
        $item->loc = $loc;
        $item->lastmod = $lastmod;
        $item->image = $image;
        $item->changefreq = $changefreq;
        $item->priority = $priority;
        $this->urls[] = $item;
        return true;
    }

    /**
     * Generate the sitemap file and replace any output with the valid XML of the sitemap
     *
     * @param string $type Type of sitemap to be generated. Use 'urlset' for a normal sitemap. Use 'sitemapindex' for a sitemap index file.
     * @access public
     * @return void
     */
    private function output($type = 'urlset')
    {
        $root = $type . " xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xhtml=\"http://www.w3.org/1999/xhtml\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\"";
        if (isset($this->urls[0]->image)) {
            $root .= " xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'";
        }
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><' . $root . '/>');
        if ($type == 'urlset') {
            foreach ($this->urls as $url) {
                $child = $xml->addChild('url');
                $child->addChild('loc', strtolower($url->loc));
                if (isset($url->image)) {
                    $image = $child->addChild('image:image:image');
                    $image->addChild('image:image:loc', $url->image);
                }
                if (isset($url->lastmod)) {
                    $child->addChild('lastmod', $url->lastmod);
                }
                if (isset($url->changefreq)) {
                    $child->addChild('changefreq', $url->changefreq);
                }
                if (isset($url->priority)) {
                    $child->addChild('priority', number_format($url->priority, 1));
                }
            }
        } elseif ($type == 'sitemapindex') {
            foreach ($this->urls as $url) {
                $child = $xml->addChild('sitemap');
                $child->addChild('loc', strtolower($url->loc));
                if (isset($url->lastmod)) {
                    $child->addChild('lastmod', $url->lastmod);
                }
            }
        }
        $this->output->set_content_type('application/xml')->set_output($xml->asXml());
    }
}
