<header id="header" class="wrapper-row">
    <div class="container">
        <div class="wrapper">
            <div id="logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(MEDIA_NAME . 'logo.png'); ?>" width="auto" height="auto" alt="Logo">
                </a>
                <span id="menu-switch" class="icon-arrow-down"></span>
            </div>
            <nav id="menu">
                <?php echo main_menu(); ?>
                <li class="has-children shop-menu-item"> <a href="#">TÀI KHOẢN</a>
                    <ul class="left-side">
                        <li><a href="<?php echo base_url('dang-ky.html'); ?>" class="clearfix">ĐĂNG KÝ</a></li>
                        <li><a href="<?php echo base_url('dang-nhap.html'); ?>" class="clearfix">ĐĂNG NHẬP</a>
                    </ul>
                </li>
            </nav>
            <div class="clear"></div>
        </div>
    </div>
</header>