<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<div id="content" class="wrapper-row wrapper-expand">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12 content">
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
                        <?php echo returnImg('', '', '', $src, $oneItem->title); ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3 col-12">
            <?php $this->load->view(PATH . "recipes/__sidebar-right"); ?>
            </div>
        </div>
    </div>
</div>