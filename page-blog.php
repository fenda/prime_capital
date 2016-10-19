<?php /*Template Name: PCR Blog*/ get_header(); ?>
<?php query_posts('post_type=post&post_status=publish&posts_per_page=9&paged='. get_query_var('paged')); ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<div class="ft-image parallax-window" data-parallax="scroll" data-image-src="<?php echo $thumb['0'];?>"></div>
<div class="wrapper text--align-center">
	<main role="main">
		<section>
			<div class="text--align-center page__description page__description-blog">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="blog-section">
				<?php get_template_part('loop'); ?>
				<hr class="not_visible">
				<?php get_template_part('pagination'); ?>
			</div>

		</section>
	</main>
</div>

<div class="clear"></div>
<?php get_footer(); ?>