<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="wrapper-row">
    <section id="heading">
        <div class="iosSlider-container">
            <div class="iosSlider">
                <div class="slider">
                    <?php if (!empty($carousel)) foreach ($carousel as $key => $value) : ?>
                        <div class="item">
                            <?php echo returnLink('', getUrlContent($value->slug), $value->title); ?><img src="<?php echo $value->img; ?>" width="auto" height="auto" alt="$value->title" /></a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="controls">
                    <span class="prev"><em></em></span>
                    <span class="next"><em></em></span>
                </div>
            </div>
        </div>
        <div class="bar"></div>
    </section>
</div>
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
                        <button class="w-100 btnLoadMore" data-page="2" data-url="<?php echo base_url('recipes/page'); ?>">Show me more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <?php $this->load->view(PATH . "recipes/__sidebar-right"); ?>
            </div>
        </div>
    </div>
    <?php if (!empty($one_item)) : ?>
        <?php echo returnLink('', getUrlContent($one_item->slug), $one_item->title); ?>
        <section style="background: url(<?php echo $one_item->img; ?>) repeat top center fixed;background-repeat: round;">
            <div class="container">
                <div class="col grid12 textcenter">
                    <h2 style="margin:1em;"><span class="highlight"><?php echo $one_item->title; ?></span></h2>
                </div>
            </div>
        </section>
        </a>
    <?php endif; ?>
</div>