<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends Public_Controller
{
    protected $_data;
    protected $_post;
    protected $_page;
    protected $_setting;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Data_model', 'Posts_model', 'Page_model']);
        $this->_data = new Data_model();
        $this->_post = new Posts_model();
        $this->_page = new Page_model();
        $this->_setting = $this->setting();
    }

    public function index($slug)
    {
        // DATA & RESULT
        $data = $this->_setting;
        $data['oneCategory'] = $oneCategory = (object) $this->_page->getBy(['slug' => '/']);
        $data['post']        = $post = $this->_post->getDataBy('post', ['slug'=>$slug]);
        // SETTING & SEO
        $data['SEO'] = (object) [
            'meta_title' => !empty($oneCategory->meta_title) ? $oneCategory->meta_title : '',
            'meta_description' => !empty($oneCategory->meta_description) ? $oneCategory->meta_description : '',
            'meta_keyword' => !empty($oneCategory->meta_keyword) ? $oneCategory->meta_keyword : '',
            'url' => base_url($oneCategory->slug),
            'is_robot' => true,
            'image' => !empty($oneCategory->thumbnail) ? getImageThumb($oneCategory->thumbnail, 600, 314) : '',
        ];
        // BREADCRUMBS
        $this->breadcrumbs->push('Home', base_url($this->_page));
        $this->breadcrumbs->push($post['title'], getPostUrl($post['slug']));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // VIEW
        // dump($data);
        // =============================
        $data['main_content'] = $this->load->view("$this->template_main/home/detail", $data, true);
        $this->__loadview("$this->template_main/index", $data);
    }
}