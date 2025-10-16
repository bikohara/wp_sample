<style>
<?php if(is_user_logged_in()) : ?>
#header,#mainnav,.panel{margin-top:32px;}@media (min-width:783px) and (max-width:1023px){.meanmenu-reveal-btn{top:32px!important;}}@media only screen and (max-width:782px){#header,#mainnav{margin-top:46px;}.panel{margin-top:0;}.mean-container .mean-bar{top:46px!important;}}
<?php else : ?>
#wpadminbar{display:none;}
<?php endif; ?>
</style>
<?php
if (is_page_template('template/top-page.php')) {
	$pa = new WP_Query(array(
		'category_name' => 'important',
		'posts_per_page' => 1,
		'post_status' => 'publish',
	));
	
	if (!$pa->have_posts()) {
		echo '<style>@media only screen and (max-width:767px){.main-txt{margin:0 0 40%!important;}}</style>';
	}
	
	wp_reset_postdata();
}
?>