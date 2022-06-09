<style>
    .destination-card {
        background: #1a1d3a;
        background: linear-gradient(45deg, #1a1d3a 0%, #212752 100%);
        padding: 20px;
        width: 100%;
        border-radius: 6px;
    }

    .destination-card img {
        max-height: 240px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="d-flex flex-column flex-shrink-0 mt-4 mb-4">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <?php foreach ($post as $key => $item) : if ($key % 2 == 0) : ?>
                                <div class="destination-card mb-4">
                                    <div class="text-white pb-1"><?php echo returnLink($item); ?><?php echo $item['title']; ?></a></div>
                                    <?php echo returnLink($item); ?><?php echo returnImg($item); ?></a>
                                    <div><?php echo returnLink($item); ?><?php echo $item['description']; ?></a></div>
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?php foreach ($post as $key => $item) : if ($key % 2 == 1) : ?>
                                <div class="destination-card mb-4">
                                    <div class="text-white pb-1"><?php echo returnLink($item); ?><?php echo $item['title']; ?></a></div>
                                    <?php echo returnLink($item); ?><?php echo returnImg($item); ?></a>
                                    <div><?php echo returnLink($item); ?><?php echo $item['description']; ?></a></div>
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12"><?php $this->load->view("default/home/_sidebar-left"); ?></div>
    </div>
</div>