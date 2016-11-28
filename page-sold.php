<?php /*Template Name: Properties Sold */ get_header(); ?>
<?php query_posts('post_type=properties&post_status=publish&posts_per_page=9&category_name=sold-properties&paged='. get_query_var('paged')); ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<div class="ft-image parallax-window" data-parallax="scroll" data-image-src="<?php echo $thumb['0'];?>"></div>
<div class="wrapper text--align-center">
	<main role="main">
		<section>
			<div class="text--align-center page__description page__description-blog">
				<h1><?php the_title(); ?></h1>
				<?php echo apply_filters( 'the_content', get_post_field( 'post_content', get_option( 'page_for_posts' ) ) ); ?>
			</div>
			<div class="blog-section">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="post-item post-category">
						<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post__image">
								<div class="post-item__hover"></div>
								<?php the_post_thumbnail('property_slider'); ?>
							</a>
						<?php endif; ?>

						<h2  class="post-item__title post-category__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="property__highlights"><?php the_field('property_highlights'); ?></p>
						<h3 class="property__value"><?php the_field('property_value'); ?></h3>

					</article>

				<?php endwhile; ?>
				<?php else: ?>

					<article>
						<h2 class="post-item__title post-category__title"><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
					</article>

				<?php endif; ?>
				<hr class="not_visible">
				<?php get_template_part('pagination'); ?>
			</div>

		</section>
	</main>
</div>
<?php get_footer(); ?>