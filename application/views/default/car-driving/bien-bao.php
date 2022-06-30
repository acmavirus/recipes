<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4 col-12 order-2 order-md-1">
            <ul class="listCategory list-group rounded mb-4">
                <?php if (!empty($category)) foreach ($category as $key => $value) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a class="" href="<?php echo base_url($onePage->slug . "/bien-bao/" . $value->Type_ID); ?>" title="Biển báo">
                            <h2><?php echo $value->Type_Name; ?></h2>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-8 col-12 order-1 order-md-2">
            <div class="row" id="ajax_content">
                <?php if (!empty($data)) foreach ($data as $key => $value) : ?>
                    <div class="col-md-3 col-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <?php echo returnImg('', '100%', '', base_url($value->Icon), $value->Name); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>