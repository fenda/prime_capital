<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

function theme_options_init(){
	register_setting( 'sample_options', 'prime_capital_options', 'theme_options_validate' );
}

function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'prime_capital' ), __( 'Theme Options', 'prime_capital' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

function theme_options_do_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>

	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'prime_capital' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'prime_capital' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'sample_options' ); ?>
			<?php $options = get_option( 'prime_capital_options' ); ?>

			<h3>Blog Featured Image</h3>
			<table class="form-table">
				<!--tr valign="top"><th scope="row"><?php _e( 'Banner title', 'prime_capital' ); ?></th>
					<td>
						<textarea id="prime_capital_options[banner_title]" class="large-text" cols="50" rows="3" name="prime_capital_options[banner_title]"><?php echo esc_textarea( $options['banner_title'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Banner text', 'prime_capital' ); ?></th>
					<td>
						<textarea id="prime_capital_options[banner_text]" class="large-text" cols="50" rows="3" name="prime_capital_options[banner_text]"><?php echo esc_textarea( $options['banner_text'] ); ?></textarea>
					</td>
				</tr-->
				<tr valign="top"><th scope="row"><?php _e( 'Image URL', 'prime_capital' ); ?></th>
					<td>
						<input id="prime_capital_options[blog_img_url]" class="regular-text" type="text" name="prime_capital_options[blog_img_url]" value="<?php esc_attr_e( $options['blog_img_url'] ); ?>" />
					</td>
				</tr>
			</table>

			<h3>Properties Featured Image</h3>
			<table class="form-table">
				<tr valign="top"><th scope="row"><?php _e( 'Image URL', 'prime_capital' ); ?></th>
					<td>
						<input id="prime_capital_options[properties_img_url]" class="regular-text" type="text" name="prime_capital_options[properties_img_url]" value="<?php esc_attr_e( $options['properties_img_url'] ); ?>" />
					</td>
				</tr>
			</table>

			<h3>Social Networks</h3>
			<table class="form-table">
				<tr valign="top"><th scope="row"><?php _e( 'Facebook', 'prime_capital' ); ?></th>
					<td>
						<input id="prime_capital_options[facebook_url]" class="regular-text" type="text" name="prime_capital_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Instagram', 'prime_capital' ); ?></th>
					<td>
						<input id="prime_capital_options[instagram_url]" class="regular-text" type="text" name="prime_capital_options[instagram_url]" value="<?php esc_attr_e( $options['instagram_url'] ); ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Twitter', 'prime_capital' ); ?></th>
					<td>
						<input id="prime_capital_options[twitter_url]" class="regular-text" type="text" name="prime_capital_options[twitter_url]" value="<?php esc_attr_e( $options['twitter_url'] ); ?>" />
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'prime_capital' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

function theme_options_validate( $input ) {
	//$input['banner_title'] = wp_filter_post_kses( $input['banner_title'] );
	//$input['banner_text'] = wp_filter_post_kses( $input['banner_text'] );
	//$input['design_text'] = wp_filter_post_kses( $input['design_text'] );

	return $input;
}