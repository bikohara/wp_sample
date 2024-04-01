<!DOCTYPE html>
<html lang="ja">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MVWCMKX');</script>
<!-- End Google Tag Manager -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(is_404()): ?>
<meta name='robots' content='noindex, nofollow' />
<?php endif; ?>
<title><?php global $page, $paged;
	wp_title('|', true, 'right');
	bloginfo('name');
	$site_description = "&nbsp;サイトのキャッチコピー";
	if($site_description && (is_front_page()))
		echo " | $site_description";
	if($paged >= 2 || $page >= 2)
		echo ' | ' . sprintf(__('Page %s', 'present'), max($paged, $page));
?></title>
<meta name="description" content="<?php echo trim(wp_title('', false)); if(wp_title('', false)){ echo ' - '; } bloginfo('description'); ?>">
<meta name="keywords" content="キーワード1,キーワード2,キーワード3,キーワード4,キーワード5,キーワード6,キーワード7," />
<?php if(is_front_page()): ?>
<link rel="canonical" href="<?php echo esc_url(home_url('/')); ?>" />
<?php endif; ?>
<?php
	global $post;
	$slug = $post->post_name;
?>
<meta property="og:title" content="<?php bloginfo('name'); ?>">
<?php if(is_home()): ?>
<meta property="og:type" content="news">
<?php else: ?>
<meta property="og:type" content="<?php echo $slug; ?>">
<?php endif; ?>
<meta property="og:description" content="<?php bloginfo('description'); ?>">
<meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<?php if(is_single()): ?>
<?php if(has_post_thumbnail()) : ?>
<meta property="og:image" content="<?php echo the_post_thumbnail_url(); ?>">
<meta property="og:image:secure_url" content="<?php echo the_post_thumbnail_url(); ?>" />
<?php else : ?>
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png">
<meta property="og:image:secure_url" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png" />
<?php endif ; ?>
<?php else : ?>
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png">
<meta property="og:image:secure_url" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png" />
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php bloginfo('name'); ?>" />
<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
<?php if(is_single()): ?>
<?php if(has_post_thumbnail()) : ?>
<meta name="twitter:image" content="<?php echo the_post_thumbnail_url(); ?>" />
<?php else : ?>
<meta name="twitter:image" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png" />
<?php endif ; ?>
<?php else : ?>
<meta name="twitter:image" content="<?php bloginfo('template_url'); ?>/images/thumbnail.png" />
<?php endif; ?>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<style>
<?php if(is_user_logged_in()): ?>
#header, #mainnav, .panel {margin-top:32px;}
@media only screen and (max-width:767px){
	#header, #mainnav {margin-top:46px;}
	.panel {margin-top:0;}
	.mean-container .mean-bar{top:46px!important;}
}
<?php else : ?>
#wpadminbar{display:none;}
<?php endif; ?>
</style>
<?php wp_head(); ?>
</head>

<body>
<header>
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
	<nav>
<?php wp_nav_menu(array('theme_location' => 'header')); //ヘッダーメニュー呼び出し ?>
	</nav>
</header>