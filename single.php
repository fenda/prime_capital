<?php
	get_header(); 
	$options = get_option('prime_capital_options');
?>
<div class="ft-image parallax-window" data-parallax="scroll" data-image-src="<?php echo $options['blog_img_url']; ?>"></div>
	<main role="main">
	<section>
		<div class="wrapper clear">
			<div class="text--align-center page__description page__description-blog">
				<h1><?php the_title(); ?></h1>
			</div>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<?php the_post_thumbnail(); // Fullsize image for the single post ?>
			<?php endif; ?>

			<span class="date">
				<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
			</span>
			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>

			<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

			<p><?php _e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>

			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

			<?php comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>
		</div>
	</section>
	<!-- /section -->
	</main>

<?php get_footer(); ?>
