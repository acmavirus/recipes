<div class="col-md-4 col-12">
    <div class="thumb directional">
        <div class="photo">
            <a href="<?php echo getUrlContent($value->slug); ?>" class="lightbox" data-fancybox-group="project-item">
                <?php echo returnImg('', '100%', '200px', $value->img, $value->title); ?>
                <span class="info"><span class="icon-arrow-right"></span></span>
                <span class="bar"></span>
            </a>
        </div>
        <h4 class="title"><?= $value->title ?></h4>
        <span class="type">
            <ul class="post-meta-info">
                <li>
                    <i class="fa fa-clock-o"></i>
                    <?php echo date("F d/Y", strtotime($value->updated_time)); ?>
                </li>
                <li class="active">
                    <i class="icon-fire"></i>
                    <?php echo $value->time; ?> minute
                </li>
            </ul>
        </span>
    </div>
</div>