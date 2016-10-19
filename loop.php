<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" class="post-item post-internal">
		<?php if ( has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post__image">
				<?php the_post_thumbnail('property_slider'); ?>
			</a>
		<?php endif; ?>

		<h2 class="post-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php html5wp_excerpt('html5wp_index') ?></p>
		<a href="<?php the_permalink(); ?>" class="post-item__button button button--green">Read more</a>

	</article>

<?php endwhile; ?>
<?php else: ?>

	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>

<?php endif; ?>