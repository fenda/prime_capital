<?php get_header(); ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<div class="ft-image parallax-window" data-parallax="scroll" data-image-src="<?php echo $thumb['0'];?>"></div>
<div class="wrapper">
	<main role="main">
		<section class="clear">
			<div class="text--align-center page__description">
				<h1><?php the_title(); ?></h1>
			</div>
			

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>

		<?php else: ?>
			<article>
				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			</article>
		<?php endif; ?>

		</section>
	</main>
</div>
<?php get_footer(); ?>
