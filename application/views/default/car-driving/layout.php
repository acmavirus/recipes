<!DOCTYPE html>
<html lang="en">

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
    <meta name="google-site-verification" content="QGm1xnMq4ZXUhzUmstwS8j-XznjrHp56hXi1C4adDSA" />
    <!-- Link icon -->
    <link rel="icon" href="<?php echo base_url(MEDIA_NAME) ?>favicon.ico">
    <!-- Facebook OG -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php if (!empty($SEO->meta_title)) echo $SEO->meta_title; ?>" />
    <meta property="og:description" content="<?php if (!empty($SEO->meta_description)) echo $SEO->meta_description; ?>" />
    <meta property="og:image" content="<?php echo base_url('public/images/social.jpg'); ?>" />
    <meta property="og:url" content="<?php if (!empty($SEO->url)) echo $SEO->url; ?>" />
    <!-- Google OG-->
    <link rel="canonical" href="<?php if (!empty($SEO->url)) echo $SEO->url; ?>" />
    <meta name="robots" content="<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>" />
    <meta name="Googlebot-News" content="<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>" />
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152623543-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-152623543-1');
    </script>
    <!-- Link style -->
    <link rel="stylesheet" href="<?php echo base_url(VENDOR_PATH) ?>libs/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('/public/app/') ?>scss/main.css">
    <!-- Script first -->
    <script src="<?php echo base_url(VENDOR_PATH) ?>js/jquery-3.2.1.min.js"></script>
    <script>
        let base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body class="bg-dark">
    <h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
    <div class="container bg-secondary" style="border: 2px solid #fff; max-width: 480px;">
        <div class="row">
            <div class="col-12 p-0 m-0" style="height: 98vh;">
                <div class="d-flex align-items-end flex-column" style="height: 98vh;">
                    <header class="w-100"><?php $this->load->view("default/$onePage->slug/_header"); ?></header>
                    <main><?php if (!empty($main_content)) echo $main_content; ?></main>
                    <footer class="mt-auto bg-dark"><?php $this->load->view("default/$onePage->slug/_footer"); ?></footer>
                </div>
            </div>
        </div>
    </div>
    <!-- all plugins here -->
    <script src="<?php echo base_url(VENDOR_PATH) ?>libs/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- main js  -->
    <script src="<?php echo base_url('/public/default/') ?>js/app.js"></script>
</body>

</html>