<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4 col-12 order-2 order-md-1">
            <?php $this->load->view("default/block/_listCategoryRecipes"); ?>
        </div>
        <div class="col-md-8 col-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12">
                    <div class="carousel">
                        <div class="carousel__nav">
                            <span id="moveLeft" class="carousel__arrow">
                                <svg class="carousel__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
                                </svg>
                            </span>
                            <span id="moveRight" class="carousel__arrow">
                                <svg class="carousel__icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                                </svg>
                            </span>
                        </div>
                        <?php if (!empty($carousel)) foreach ($carousel as $key => $value) : ?>
                            <div class="carousel-item carousel-item--<?php echo $key + 1; ?>">
                                <div class="carousel-item__image" style="background-image: url(<?php echo $value->img; ?>);"></div>
                                <div class="carousel-item__info">
                                    <h2 class="carousel-item__title"><?php echo returnLink('carousel-item__btn', getUrlContent($value->slug), $value->title); ?><?php echo $value->title; ?></a></h2>
                                    <p class="carousel-item__description"><?php echo returnLink('', getUrlContent($value->slug), $value->title); ?><?php echo strip_tags($value->content); ?></a></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="row" id="ajax_content">
                <?php if (!empty($data)) foreach ($data as $key => $value) : ?>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <?php echo returnLink('', getUrlContent($value->slug), $value->title); ?>
                                <?php echo returnImg('', '100%', '200px', $value->img, $value->title); ?>
                                </a>
                                <h3><?php echo $value->title; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <button class="btn btn-danger mx-auto my-3 btnLoadMore" data-page="2" data-url="<?php echo base_url('recipes/page'); ?>" type="button">Xem thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>