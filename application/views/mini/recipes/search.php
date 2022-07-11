<div id="content" class="wrapper-row wrapper-expand">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="row">
                    <?php if (!empty($data_search)) foreach ($data_search as $key => $value) : ?>
                        <?php $this->load->view(PATH . "recipes/__widget-post", ['value' => $value]); ?>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="button light w-100 text-center">Show me more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <?php $this->load->view(PATH . "recipes/__sidebar-right"); ?>
            </div>
        </div>
    </div>
</div>