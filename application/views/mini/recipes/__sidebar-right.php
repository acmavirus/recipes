<div id="sidebar" class="col grid3">
    <div class="widget">
        <form role="search" method="get" class="searchform" action="<?= base_url("recipes/search"); ?>">
            <input type="text" name="key" placeholder="Enter search term...">
            <input type="submit" value="">
            <div class="clear"></div>
        </form>
    </div>
    <div class="widget">
        <h2>Về <?= $oneCategory->title; ?></h2>
        <h2 class="small"><?= $oneCategory->description; ?></h2>
    </div>
    <div class="widget widget_categories">
        <h3>Danh mục</h3>
        <ul class="small">
            <?php if (!empty($listCategory)) foreach ($listCategory as $key => $value) : ?>
                <li class="cat-item title"><?php echo returnLink('', getCatUrl($value->slug), $value->title); ?><?php echo $value->title; ?></a> <span class="count"><?php echo $value->count; ?></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php if(!empty($oneCategory)): ?>
    <div class="widget widget_recent_comments">
        <h3>Công thức cùng chuyên mục</h3>
        <ul id="recentcomments">
            <?php if (!empty($another_cate)) foreach ($another_cate as $key => $value) : ?>
                <li class="recentcomments title">
                    <?php echo returnLink('url', getUrlContent($value->slug), $value->title); ?><?php echo $value->title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="widget widget_recent_comments">
        <h3>Công thức khác</h3>
        <ul id="recentcomments">
            <?php if (!empty($another_recipe)) foreach ($another_recipe as $key => $value) : ?>
                <li class="recentcomments">
                    <?php echo returnLink('url', getUrlContent($value->slug), $value->title); ?><?php echo $value->title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="widget widget_calendar">
        <h3>lịch hôm nay</h3>
        <div id="datepicker" class="small"></div>
    </div>
</div>