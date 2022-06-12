<?php if (!empty($oneCategory)) :
    $data = getFeatured($oneCategory);
?>
    <ul class="list-group rounded mt-1 mb-1">
        <li class="list-group-item d-flex justify-content-between align-items-center active">
            <h2>Xem thêm công thức</h2>
        </li>
        <?php if (!empty($oneCategory)) foreach ($data as $key => $item) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo returnLink('', getCatUrl($item->slug), $item->title); ?>
                <h2><?php echo $item->title; ?></h2>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>