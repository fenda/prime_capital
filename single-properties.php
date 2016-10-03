<?php
	get_header(); 
	$options = get_option('prime_capital_options');
?>
<div class="ft-image parallax-window" data-parallax="scroll" data-image-src="<?php echo $options['properties_img_url']; ?>"></div>
	<main role="main">
		<section>
			<div class="wrapper clear">
				<div class="text--align-center page__description page__description-blog">
					<h1><?php the_title(); ?></h1>
				</div>
			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="columns columns__fifty">	
						<?php if ( has_post_thumbnail()) : ?>
							<div class="property-thumb">
								<?php //the_post_thumbnail(); ?>
								<?php
									$args = array(
										'post_parent' => $post->ID,
										'post_type' => 'attachment',
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'numberposts' => 25,
										'post_mime_type' => 'image'
									);
									
									if ( $images = get_children( $args ) ) {
										echo '<div class="property-slider">';
										foreach( $images as $image ) {
											$attachment_meta = wp_get_attachment($image);
											echo wp_get_attachment_image( $image->ID, 'property_slider' );
										}
										echo '</div>'; 
									}
								?>
							</div>
						<?php endif; ?>
						<div class="property-map">
							<?php echo GeoMashup::map('height=400&zoom=13&add_overview_control=false&add_map_type_control=false');?>
						</div>
						<div class="property-form">
							<h2 class="property-form__title text--align-center">Inquire About This Property</h2>
							<?php echo do_shortcode( '[contact-form-7 id="67" title="Property Enquiry"]' ); ?>
						</div>
					</div>
					<div class="columns columns__fifty padding-l-40">
						<div class="custom-fields">
							<?php if( get_field('property_details') ): ?>
								<p><?php the_field('property_details'); ?></p>
							<?php endif; ?>

							<?php if( get_field('financial_details') ): ?>
								<h4>Financials</h4>
								<p><?php the_field('financial_details'); ?></p>
								<h4>Description</h4>
							<?php endif; ?>
						</div>
						<div class="property-description">
							<?php the_content(); ?>
						</div>
						<div class="sharing">
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
				</article>
			<?php endwhile; ?>
			<?php else: ?>
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
			<?php endif; ?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
