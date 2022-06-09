<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php if (!empty($SEO->meta_title)) echo $SEO->meta_title; ?></title>

    <!-- Meta rel -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name='robots' content='<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>' />
    <meta name="description" content="<?php if (!empty($SEO->meta_description)) echo $SEO->meta_description; ?>" />
    <meta name="keywords" content="<?php if (!empty($SEO->meta_keyword)) echo $SEO->meta_keyword; ?>" />
    <meta name="author" content="<?php if (!empty($SEO->url)) echo $SEO->url; ?>">
    <!-- Link icon -->

    <link rel="icon" href="<?php echo base_url(MEDIA_NAME) ?>favicon.ico">

    <!--Meta Facebook Page Other-->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php if (!empty($setting->meta_title)) echo $setting->meta_title; ?>" />
    <meta property="og:description" content="<?php if (!empty($setting->meta_description)) echo $setting->meta_description; ?>" />
    <meta property="og:image" content="<?php echo base_url('public/images/social.jpg'); ?>" />
    <meta property="og:url" content="<?php if (!empty($SEO->url)) echo $SEO->url; ?>" />

    <!--Facebook OG-->
    <link rel="canonical" href="<?php if (!empty($SEO->url)) echo $SEO->url; ?>" />
    <meta name="robots" content="<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>" />
    <meta name="Googlebot-News" content="<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>" />

    <!-- Link style -->
    <link rel="stylesheet" href="<?php echo base_url(VENDOR_PATH) ?>libs/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(VENDOR_PATH) ?>fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(VENDOR_PATH) ?>/libs/amlich/jquery.amlich.css">
    <link rel="stylesheet" href="<?php echo base_url('/public/default/') ?>scss/main.css">
    <style>
        .wrapper {
            min-height: 200px !important;
        }
    </style>
    <!-- Script first -->
    <script src="<?php echo base_url(VENDOR_PATH) ?>js/jquery-3.2.1.min.js"></script>
    <script>
        let base_url = '<?php echo base_url(); ?>';
    </script>
</head>
<script src="<?php echo base_url(VENDOR_PATH) ?>/js/chart.min.js"></script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php $this->load->view("default/lottery/chart/thongke-lanxuathien"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?php $this->load->view("default/lottery/chart/thongke-venhieunhat"); ?>
            </div>
            <div class="col-6">
                <?php $this->load->view("default/lottery/chart/thongke-itvenhat"); ?>
            </div>
        </div>
    </div>
    <!-- all plugins here -->
    <script src="<?php echo base_url(VENDOR_PATH) ?>libs/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(VENDOR_PATH) ?>libs/fontawesome/js/all.min.js"></script>
</body>

</html>