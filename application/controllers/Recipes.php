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
            'random' => 1,
            'limit' => 6
        ]);
        $listID = [];
        foreach ($listCarousel as $key => $value) {
            $listID[] = $value->id;
        }
        $Another_recipe = $this->_post_recipes->getData([
            'not_in' => $listID,
            'random' => 1,
            'limit' => 6
        ]);
        foreach ($Another_recipe as $key => $value) {
            $listID[] = $value->id;
        }
        $another_cate = $this->_post_recipes->getData([
            'category_id' => $oneCategory->id,
            'not_in' => $listID,
            'random' => 1,
            'limit' => 6
        ]);
        $one_item = $this->_post_recipes->getData([
            'not_in' => $listID,
            'random' => 1,
            'limit' => 1
        ]);
        $author = $this->_post->getDataBy('admin_users', ['id' => 1]);
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
            'author' => $author,
            'onePage' => $onePage,
            'listCategory' => $listCategory,
            'oneCategory' => $oneCategory,
            'data' => $listRecipes,
            'one_item' => $one_item[0],
            'another_recipe' => $Another_recipe,
            'another_cate' => $another_cate,
            'carousel' => $listCarousel,
            'page' => $page,
            'limit' => $limit,
            'SEO' => $SEO
        ];
        $data['main_content'] = $this->load->view(PATH . 'recipes/index', $data, true);
        $this->load->view(PATH . 'layout', $data);
    }

    public function category($slug, $page = 1)
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'recipes');
        $listCategory = $this->_category->getAllByField('parent_id', $onePage->id);
        $oneCategory = $this->_category->getByField('slug', $slug);
        $author = $this->_post->getDataBy('admin_users', ['id' => 1]);
        // ====================================
        $limit = 18;
        $listRecipes = $this->_post_recipes->getData([
            'category_id' => $oneCategory->id,
            'page' => $page,
            'limit' => $limit
        ]);
        $listID = [];
        foreach ($listRecipes as $key => $value) {
            $listID[] = $value->id;
        }
        $Another_recipe = $this->_post_recipes->getData([
            'not_in' => $listID,
            'random' => 1,
            'limit' => 6
        ]);
        foreach ($Another_recipe as $key => $value) {
            $listID[] = $value->id;
        }
        $another_cate = $this->_post_recipes->getData([
            'category_id' => $oneCategory->id,
            'not_in' => $listID,
            'random' => 1,
            'limit' => 6
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
            'author' => $author,
            'onePage' => $onePage,
            'listCategory' => $listCategory,
            'oneCategory' => $oneCategory,
            'data' => $listRecipes,
            'another_recipe' => $Another_recipe,
            'another_cate' => $another_cate,
            'page' => $page,
            'limit' => $limit,
            'SEO' => $SEO
        ];

        $data['main_content'] = $this->load->view(PATH . 'recipes/category', $data, true);
        $this->load->view(PATH . 'layout', $data);
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
        $data['main_content'] = $this->load->view(PATH . 'recipes/detail', $data, true);
        $this->load->view(PATH . 'layout', $data);
    }

    public function search()
    {
        // // ==>> START CODE <<== //
        $key = $_GET['key'];
        $data_search = $this->_post_recipes->getData([
            'keyword' => $key,
            'page' => 1,
            'limit' => 9000
        ]);
        // ==>> END CODE <<== //
        // SETTING & SEO
        $SEO = (object) [
            'meta_title' => "Kết quả tìm kiếm: $key",
            'meta_description' => "Kết quả tìm kiếm: $key",
            'meta_keyword' => "$key",
            'url' => current_url(),
            'is_robot' => true
        ];
        // View
        $data = [
            'SEO' => $SEO,
            'data_search' => $data_search
        ];
        $data['main_content'] = $this->load->view(PATH . 'recipes/search', $data, true);
        $this->load->view(PATH . 'layout', $data);
    }
}
