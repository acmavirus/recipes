<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cardriving extends PUBLIC_Controller
{
    protected $_folder;
    protected $_category;
    protected $_page;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Category_model', 'Page_model']);
        $this->_category = new Category_model();
        $this->_page     = new Page_model();
        $this->_folder = base_url('media/carDriver');
    }

    public function index()
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'car-driving');
        $license = $this->getDatabase('ZLICENSE');
        // ====================================
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
            'SEO' => $SEO,
            'license' => $license
        ];
        $data['main_content'] = $this->load->view('default/car-driving/index', $data, true);
        $this->load->view('default/car-driving/layout', $data);
    }

    public function page($slug, $id = null)
    {
        // // ==>> START CODE <<== //
        $onePage = $this->_page->getByField('slug', 'car-driving');
        $license = $this->getDatabase('ZLICENSE');

        switch ($slug) {
            case 'bien-bao':
                $category = json_decode(file_get_contents(base_url('media/carDriver/databases/TABLE_NOTICE_BOARD_TYPE.json')));
                if ($id > 0) {
                    $sign = json_decode(file_get_contents(base_url('media/carDriver/databases/TABLE_NOTICE_BOARD.json')));
                    $data = [];
                    foreach ($sign as $key => $value) {
                        if ($value->Type_ID == $id) $data[] = $value;
                    }
                }
                break;

            default:
                # code...
                break;
        }
        // ====================================
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
            'SEO' => $SEO,
            'category' => $category,
            'license' => $license,
            'data' => $data
        ];
        $data['main_content'] = $this->load->view("default/car-driving/$slug", $data, true);
        $this->load->view('default/car-driving/layout', $data);
    }

    private function getDatabase($name)
    {
        return json_decode(file_get_contents("$this->_folder/databases/$name.json"));
    }

    private function getJson($folder, $name)
    {
        return json_decode(file_get_contents("$this->_folder/$folder/$name.json"));
    }
}
