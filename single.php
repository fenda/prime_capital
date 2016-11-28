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

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail()) : ?>
					<div class="article__ft-image">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>

				<p class="date">
					<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
						<?php the_date(); ?>
					</time>
				</p>

				<?php the_content(); ?>
				<div class="tags">
					<?php the_tags( __( 'Tags: ', 'html5blank' ), ' '); ?>
				</div>
			</article>

		<?php endwhile; ?>
		<?php else: ?>

			<article>
				<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
			</article>

		<?php endif; ?>
			<div class="sharing sharing--centered">
				<ul class="sharing__list reset-box">
					<li class="sharing__item sharing__item--title"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</li>
					<li class="sharing__item sharing__item--pinterest">
						<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
					</li>
					<li class="sharing__item sharing__item--twitter">
						<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					</li>
					<li class="sharing__item sharing__item--facebook">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook." target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					</li>
					<li class="sharing__item sharing__item--google">
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
					</li>
					<li class="sharing__item sharing__item--email">
						<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>" title="Send this article to a friend!"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</section>
	</main>

<?php get_footer(); ?>
