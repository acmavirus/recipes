<div class="col-lg-12 col-12">
    <div class="row">
        <div class="col-4">
            <div class="widget widget_search mb-0">
                <form class="search-form">
                    <div class="form-group">
                        <input type="text" placeholder="Search your itmes">
                    </div>
                    <button class="submit-btn" type="submit"><i class="ri-search-line"></i></button>
                </form>
            </div>
        </div>
        <div class="col-4 align-self-center pb-4">
            <p class="mb-0">Hiển thị <?php if (!empty($pagination)) echo $pagination['min']; ?>–<?php if (!empty($pagination)) echo $pagination['max']; ?> of <?php if (!empty($pagination)) echo $pagination['total']; ?> kết quả</p>
        </div>
        <div class="col-4 align-self-center pb-4">
            <select class="single-select float-sm-end">
                <option>Default sorting</option>
                <option value="asc">Pizza</option>
                <option value="desc">Burger</option>
                <option value="pop">Ramen</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php if (!empty($data)) foreach ($data as $key => $value) : ?>
            <div class="col-md-4">
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
    </div>
    <div class="row">
        <div class="col-12">
            <nav class="text-end">
                <?php if (!empty($pagination)) echo $pagination['links']; ?>
            </nav>
        </div>
    </div>
</div>