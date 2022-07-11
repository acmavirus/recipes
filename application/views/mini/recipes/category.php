<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div id="content" class="wrapper-row wrapper-expand">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="row" id="ajax_content">
                    <?php if (!empty($data)) foreach ($data as $key => $value) : ?>
                        <?php $this->load->view(PATH . "recipes/__widget-post", ['value' => $value]); ?>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="w-100 btnLoadMore" data-page="2" data-url="<?php echo base_url("recipes/$oneCategory->slug/page"); ?>">Show me more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
            <?php $this->load->view(PATH . "recipes/__sidebar-right"); ?>
            </div>
        </div>
    </div>
</div>