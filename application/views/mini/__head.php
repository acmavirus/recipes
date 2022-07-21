	<!-- Basic Page Needs =====================================-->
	<meta charset="utf-8">
	<!-- Mobile Specific Metas ================================-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Site Title- -->
	<title><?php if (!empty($SEO->meta_title)) echo $SEO->meta_title; ?></title>

	<!-- Meta rel -->
	<meta name='robots' content='<?php echo (!empty($SEO) && $SEO->is_robot == true) ? 'index,follow' : 'noindex,nofollow'; ?>' />
	<meta name="description" content="<?php if (!empty($SEO->meta_description)) echo $SEO->meta_description; ?>" />
	<meta name="keywords" content="<?php if (!empty($SEO->meta_keyword)) echo $SEO->meta_keyword; ?>" />
	<meta name="author" content="<?php if (!empty($SEO->url)) echo $SEO->url; ?>">
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

	<!-- Link style -->
	<link rel="stylesheet" href="<?php echo base_url('/public/' . PATH) ?>css/css_minify.min.css">
	
	<!-- Script first -->
	<script>
	  let base_url = '<?php echo base_url(); ?>';
	</script>