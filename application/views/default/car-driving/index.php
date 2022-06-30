<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12 col-12">
            <ul class="listCategory list-group rounded mb-4">
                <?php if (!empty($license)) foreach ($license as $key => $value) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a class="" href="<?php echo base_url($onePage->slug . "/bien-bao/" . $value->Type_ID); ?>" title="Biển báo">
                            <h2><?php echo $value->ZNAME; ?></h2>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>