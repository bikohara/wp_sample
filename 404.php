<?php get_header(); ?>
<section class="page_area">
<div class="breadarea">
<?php get_template_part('breadcrumb'); ?>
</div>
	<div class="inner">
	<h2 class="post_head"><span><?php _e('Page not found'); ?></span></h2>
<?php _e("No posts found."); ?>
	</div>
</section>
<?php get_footer(); ?>