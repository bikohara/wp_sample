<?php get_header(); ?>
<div id="page-header">
	<div id="page-inner">
		<div id="page-text">
			<h2 class="title topfade"><?php _e('News', 'sample'); ?></h2>
		</div>
	</div>
</div>
<?php output_breadcrumb(); ?>
<div id="content">
	<div class="inner">
		<div id="side-contents">
			<div id="post-<?php the_ID(); ?>" class="main-data">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h3 class="heading"><?php the_title(); ?></h3>
<?php if(has_post_thumbnail()): ?>
				<figure class="post-images">
					<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				</figure>
<?php endif; ?>
<?php the_content(); ?>
				<p class="post-day"><time datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p>
<?php
if (comments_open() || get_comments_number()){
	comments_template();
}
endwhile;
?>
			</div>
			<div class="side-data">
<?php get_sidebar(); ?>
			</div>
		</div>
	<div class="pagenav">
		<div class="prev_post"><?php next_post_link('%link', __('Next Post', 'sample')); ?></div>
		<div class="next_post"><?php previous_post_link('%link', __('Previous Post', 'sample')); ?></div>
	</div>
<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
