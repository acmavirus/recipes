<h1 class="d-none">Công thúc nấu ăn món <?php echo $oneItem->meta_title; ?></h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-3 col-12 order-2 order-md-1">
            <?php $this->load->view("default/block/_listCategoryRecipes"); ?>
        </div>
        <div class="col-md-6 col-12 order-1 order-md-2">
            <div class="content card mt-0">
                <h3><?php echo $oneItem->title; ?></h3>
                <?php echo $oneItem->content; ?>
                <ul>
                    <h5>Chuẩn bị</h5>
                    <?php if (!empty($oneItem->components)) foreach (json_decode($oneItem->components) as $key => $value) : ?>
                        <li><?php echo $value->title; ?> - <?php echo $value->quantity; ?> <?php echo $value->unit; ?></li>
                    <?php endforeach; ?>
                </ul>
                <br>
                <h5>Các bước tiến hành</h5>
                <?php if (!empty($oneItem->cook_steps)) foreach (json_decode($oneItem->cook_steps) as $key => $value) : ?>
                    <li>
                        <div class="step">Bước <?php echo $value->step; ?>: <?php echo $value->des; ?></div>
                    </li>
                    <?php if (!empty($value->pictures)) foreach ($value->pictures as $key => $src) : ?>
                        <?php echo returnImg('', '100%', '100%', $src, $oneItem->title); ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-3 col-12 order-1 order-md-3">
            <?php $this->load->view("default/block/_stats"); ?>
            <?php $this->load->view("default/block/_featured"); ?>
        </div>
    </div>
</div>