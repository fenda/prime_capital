<?php 
	/* Template Name: Home Page */
	get_header();
?>

	<?php if( function_exists('cyclone_slider') ) cyclone_slider('home'); ?>
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	<div class="slider-alternative" style="background-image: url('<?php echo $thumb['0'];?>')"></div>
	<main role="main">
		<section class="page">
			<div class="wrapper--narrow">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="text--align-center page__description">
						<?php the_content(); ?>
					</article>
				<?php endwhile; endif; ?>
			</div>
		</section>
		<section class="prime-client text--align-center">
			<h1>Become a "Prime" Client</h1>
			<div class="wrapper">
				<div class="callout">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-widgets')) ?>
				</div>
			</div>
		</section>
		<section class="wrapper text--align-center">
			<h1>From the PCR Blog</h1>
			<div class="blog-section">
				<?php
					$args = array( 'numberposts' => 3 );
					$postslist = get_posts( $args );
					foreach ($postslist as $post) :  setup_postdata($post); ?> 
				<div class="post-item">
					<?php if ( has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post__image">
							<?php the_post_thumbnail('property_slider'); ?>
						</a>
					<?php endif; ?>
					<h2 class="post-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php html5wp_excerpt('html5wp_index') ?>
					<a href="<?php the_permalink(); ?>" class="post-item__button button button--green">Read more</a>
				</div>
			<?php endforeach; ?>
			</div>
			<a href="<?php echo get_site_url(); ?>/blog/" class="button">Read all blog posts</a>
		</section>
	</main>
<?php get_footer(); ?>