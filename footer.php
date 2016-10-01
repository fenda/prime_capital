		<footer class="footer font-lato" role="contentinfo">
			<div class="wrapper">
				<nav class="footer__nav text text--align-center">
					<?php html5blank_nav(); ?>
				</nav>
				<div class="logo-list text--align-center">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widgets')) ?>
				</div>
				<div class="copyright clear">
					<p>&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.
						<a href="http://crush-interactive.com" target="_blank">Developed by	Crush Interactive</a></p>
				<div class="social-networks">
					<ul class="social-networks__list reset-box">
						<li class="social-networks__item"><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
						<li class="social-networks__item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li class="social-networks__item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>