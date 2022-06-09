<div class="col-12 align-self-center pb-4">
    <p class="mb-0">Hiển thị <?php if (!empty($pagination)) echo $pagination['min']; ?>–<?php if (!empty($pagination)) echo $pagination['max']; ?> of <?php if (!empty($pagination)) echo $pagination['total']; ?> kết quả</p>
</div>
<?php if (!empty($data)) foreach ($data as $key => $value) : ?>
    <div class="col-md-6">
        <div class="single-item-wrap">
            <div class="thumb">
                <img src="<?php echo $value['img']; ?>" alt="img">
                <a class="fav-btn" href="#"><i class="ri-heart-line"></i></a>
            </div>
            <div class="wrap-details">
                <h5><a href="<?php echo getUrlContent($value['slug']); ?>"><?php echo $value['name']; ?></a></h5>
                <div class="wrap-footer">
                    <div class="rating">
                        <?php echo $value['level']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<nav class="text-end">
    <script>
        let type = 'category';
    </script>
    <?php if (!empty($pagination)) echo $pagination['links']; ?>
</nav>