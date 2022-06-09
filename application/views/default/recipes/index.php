<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4 col-12 order-2 order-md-1">
            <ul class="list-group">
                <?php if (!empty($listCategory)) foreach ($listCategory as $key => $value) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo returnLink('', getCatUrl($value->slug), $value->title); ?>
                        <h2><?php echo $value->title; ?></h2>
                        </a>
                        <span class="badge bg-primary rounded-pill"><?php echo $value->recipes; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-8 col-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12">
                    <div class="carousel">
                        <div class="wrap">
                            <ul>
                                <?php if (!empty($carousel)) foreach ($carousel as $key => $value) : ?>
                                    <li>
                                        <?php echo returnLink('', getUrlContent($value->slug), $value->title); ?>
                                        <?php echo returnImg('', '100%', '200px', $value->img, $value->title); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
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