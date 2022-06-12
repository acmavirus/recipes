<ul class="listCategory list-group rounded">
    <?php if (!empty($listCategory)) foreach ($listCategory as $key => $value) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center order-<?php echo ($oneCategory->id == $value->id) ? 'first' : ($key+6); ?> <?php echo ($oneCategory->id == $value->id) ? 'active' : ''; ?>">
            <?php echo returnLink('', getCatUrl($value->slug), $value->title); ?>
            <h2><?php echo $value->title; ?></h2>
            </a>
            <span class="badge bg-primary rounded-pill"><?php echo $value->recipes; ?></span>
        </li>
    <?php endforeach; ?>
</ul>