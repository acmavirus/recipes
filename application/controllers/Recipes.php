<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recipes extends PUBLIC_Controller
{
    protected $_category;
    protected $_page;
    protected $_post;
    protected $_post_recipes;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Category_model', 'Page_model', 'Post_model', 'Post_recipes_model']);
        $this->_category = new Category_model();
        $this->_page     = new Page_model();
        $this->_post     = new Post_model();
        $this->_post_recipes     = new Post_recipes_model();
    }

    public function index($page = 1)
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'recipes');
        $listCategory = $this->_category->getAllByField('parent_id', $onePage->id);
        $oneCategory = $listCategory[0];
        // ====================================
        $limit = 18;
        $listRecipes = $this->_post_recipes->getData([
            'category_id' => $oneCategory->id,
            'page' => $page,
            'limit' => $limit
        ]);
        $listCarousel = $this->_post_recipes->getData([
            'page' => 1,
            'limit' => 6
        ]);
        // ==>> END CODE <<== //
        // SETTING & SEO
        $SEO = (object) [
            'meta_title' => !empty($onePage->meta_title) ? $onePage->meta_title : '',
            'meta_description' => !empty($onePage->meta_description) ? $onePage->meta_description : '',
            'meta_keyword' => !empty($onePage->meta_keyword) ? $onePage->meta_keyword : '',
            'url' => current_url(),
            'is_robot' => true,
            'image' => !empty($onePage->thumbnail) ? getImageThumb($onePage->thumbnail, 600, 314) : '',
        ];
        // View
        $data = [
            'onePage' => $onePage,
            'listCategory' => $listCategory,
            'oneCategory' => $oneCategory,
            'data' => $listRecipes,
            'carousel' => $listCarousel,
            'page' => $page,
            'limit' => $limit,
            'SEO' => $SEO
        ];
        $data['main_content'] = $this->load->view('default/recipes/index', $data, true);
        $this->load->view('default/layout', $data);
    }

    public function category($slug, $page = 1)
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'recipes');
        $listCategory = $this->_category->getAllByField('parent_id', $onePage->id);
        $oneCategory = $this->_category->getByField('slug', $slug);
        // ====================================
        $limit = 18;
        $listRecipes = $this->_post_recipes->getData([
            'category_id' => $oneCategory->id,
            'page' => $page,
            'limit' => $limit
        ]);
        // ==>> END CODE <<== //
        // SETTING & SEO
        $SEO = (object) [
            'meta_title' => !empty($oneCategory->meta_title) ? $oneCategory->meta_title : '',
            'meta_description' => !empty($oneCategory->meta_description) ? $oneCategory->meta_description : '',
            'meta_keyword' => !empty($oneCategory->meta_keyword) ? $oneCategory->meta_keyword : '',
            'url' => current_url(),
            'is_robot' => true,
            'image' => !empty($oneCategory->thumbnail) ? getImageThumb($oneCategory->thumbnail, 600, 314) : '',
        ];
        // View
        $data = [
            'onePage' => $onePage,
            'listCategory' => $listCategory,
            'oneCategory' => $oneCategory,
            'data' => $listRecipes,
            'page' => $page,
            'limit' => $limit,
            'SEO' => $SEO
        ];
        $data['main_content'] = $this->load->view('default/recipes/category', $data, true);
        $this->load->view('default/layout', $data);
    }

    public function detail($slug)
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'recipes');
        $listCategory = $this->_category->getAllByField('parent_id', $onePage->id);
        $oneItem = $this->_post_recipes->getByField('slug', $slug);
        $oneCategory = $this->_category->getByField('id', $oneItem->category_id);
        // ====================================
        // ==>> END CODE <<== //
        // SETTING & SEO
        $SEO = (object) [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : '',
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : '',
            'meta_keyword' => !empty($oneItem->meta_keyword) ? $oneItem->meta_keyword : '',
            'url' => current_url(),
            'is_robot' => true,
            'image' => !empty($oneItem->thumbnail) ? getImageThumb($oneItem->thumbnail, 600, 314) : '',
        ];
        // View
        $data = [
            'onePage' => $onePage,
            'listCategory' => $listCategory,
            'oneCategory' => $oneCategory,
            'oneItem' => $oneItem,
            'SEO' => $SEO
        ];
        $data['main_content'] = $this->load->view('default/recipes/detail', $data, true);
        $this->load->view('default/layout', $data);
    }

    public function test() {
        $all = $this->_post_recipes->getData([
            'limit' => 10000
        ]);
        foreach ($all as $key => $item) {
            $this->_post_recipes->update('post_recipes', ['id'=>$item->id], [
                'meta_title' => $item->title,
                'meta_description' => strip_tags($item->content),
                'meta_keyword' => $item->title,
            ]);
        };
    }
}
