<div class="d-none" id="shop"></div>
<?php $this->load->view("default/recipes/_header"); ?>

<!-- shop Area Start-->
<section class="shop-area" style="margin-top: 100px;">
    <div class="container">
        <div class="row justify-content-center" id="tableContent">
            <div class="col-lg-12 col-12">
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-4 align-self-center pb-4">
                        <p class="mb-0">
                            <?php if (!empty($result['data'])) : ?>
                                Hiển thị kết quả tìm kiếm: <?php if (!empty($result)) echo $result['min']; ?>–<?php if (!empty($result)) echo $result['max']; ?> of <?php if (!empty($result)) echo $result['total']; ?> kết quả
                            <?php else : ?>
                                Không có công thức nào phù hợp
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-4 align-self-center pb-4">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php if (!empty($result['data'])) foreach ($result['data'] as $key => $value) : ?>
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
                            <script>
                                let type = 'search/<?php echo $_GET['s']; ?>';
                            </script>
                            <?php if (!empty($pagination)) echo $pagination; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop Area End -->
<?php $this->load->view("default/recipes/_footer"); ?>