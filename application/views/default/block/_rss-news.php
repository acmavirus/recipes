<?php $data = rss_feed(); ?>
<style>
    ul li {
        padding: 5px;
    }
    ul li a img {
        width: 100%;
    }
</style>
<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-dark">
    <div class="d-flex align-items-center flex-shrink-0 p-3 link-white text-decoration-none">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">Tin mới nhất hôm nay</span>
    </div>
    <div class="list-group list-group-flush scrollarea">
        <ul>
            <?php foreach ($data as $key => $value) : ?>
                <li>
                    <?php echo $value['title']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>