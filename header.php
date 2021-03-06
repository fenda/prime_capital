<?php $options = get_option('prime_capital_options'); ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
		<header class="header font-lato font-lato--bold" role="banner">
			<div class="wrapper clear">		
				<div class="logo">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo__image">
					</a>
				</div>
				<div class="contact header__widget">
					<p class="header__widget__title">Call Today: <a href="tel:786.251.3756" class="contact__phone">786.251.3756</a></p>
					<div class="social-networks header__widget">
						<p class="header__widget__title">Follow Us:</p>
						<ul class="social-networks__list reset-box">
							<li class="social-networks__item"><a href="<?php echo $options['facebook_url']; ?>" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
							<li class="social-networks__item"><a href="<?php echo $options['instagram_url']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li class="social-networks__item"><a href="<?php echo $options['twitter_url']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
				<a class="mobile_nav">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</a>
				<nav class="menu" role="navigation">
					<?php html5blank_nav(); ?>
				</nav>
			</div>
		</header>