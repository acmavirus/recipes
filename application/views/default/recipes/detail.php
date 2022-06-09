<h1 class="d-none">Công thúc nấu ăn món <?php echo $oneItem->meta_title; ?></h1>
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
    </div>
</div>