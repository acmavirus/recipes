<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4 col-12 order-2 order-md-1">
            <ul class="listCategory list-group rounded">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="" href="<?php echo base_url($onePage->slug."/bien-bao"); ?>" title="Biển báo">
                        <h2>Biển báo</h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-8 col-12 order-1 order-md-2">
            <div class="row">
                <div class="col-12">
                    <?php echo $carousel; ?>
                </div>
            </div>
        </div>
    </div>
</div>