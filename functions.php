<?php

if (!isset($content_width)){
	$content_width = 900;
}

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	//add_image_size('large', 700, '', true); // Large Thumbnail
	//add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 362, 267, '', true); // Small Thumbnail
	add_image_size('property_slider', 562, 409, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	add_theme_support('automatic-feed-links');
	load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

// HTML5 Blank navigation
function html5blank_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'container'       => 'div',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0
		)
	);
}

// Sidebar
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => __('Become a "Prime" Client', 'html5blank'),
		'id' => 'home-widgets',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="callout__title">',
		'after_title' => '</h2>'
	));

	register_sidebar(array(
		'name' => __('Footer logos', 'html5blank'),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>'
	));
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), true);

		wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0', false, true);
		wp_enqueue_script('conditionizr');

		wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1', false, true);
		wp_enqueue_script('modernizr');

		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), '2.7.1', false, true);
		wp_enqueue_script('jquery');

		wp_register_script('parallax', get_template_directory_uri() . '/js/lib/parallax.min.js', array(), '2.7.1', false, true);
		wp_enqueue_script('parallax');

		wp_register_script('owlCarousel', get_template_directory_uri() . '/js/lib/owl.carousel.min.js', array(), false, true);
		wp_enqueue_script('owlCarousel');

		wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts-min.js', array('jquery'), '1.0.0', false, true); 
		wp_enqueue_script('html5blankscripts');
	}
}

// Load HTML5 Blank styles
function html5blank_styles() {
	wp_register_style('normalize', get_template_directory_uri() . '/css/lib/normalize.css', array(), '1.0');
	wp_enqueue_style('normalize');

	wp_register_style('html5blankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
	wp_enqueue_style('html5blankcssmin');

	wp_register_style('owlCarousel', get_template_directory_uri() . '/css/lib/owl.carousel.css', array(), '1.0', 'all');
	wp_enqueue_style('owlCarousel'); // Enqueue it!
	
}

function enqueue_font_awesome() {
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
}

function load_fonts() {
	wp_register_style('openSans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i');
	wp_enqueue_style( 'openSans');
	wp_register_style('lato', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i');
	wp_enqueue_style( 'lato');
}

// Register HTML5 Blank Navigation
function register_html5_menu(){
	register_nav_menus(array( // Using array to specify more menus if needed
		'header-menu' => __('Header Menu', 'html5blank') // Main Navigation
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
}

// Custom Excerpts
function html5wp_index($length)  {
	// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'enqueue_font_awesome'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'load_fonts'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_properties'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('after_setup_theme', 'remove_admin_bar');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// shortcodes
function pcr_button($atts, $content = null) {
	extract( shortcode_atts( array(
		'url' => '#'
	), $atts ) );
	return '<a href="'.$url.'" class="button">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'pcr_button');

function pcr_columns($atts, $content = null) {
	extract( shortcode_atts( array(
		'class' => '#'
	), $atts ) );
	return '<div class="columns columns__'.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col', 'pcr_columns');


// Properties post type
function create_post_type_properties() {
	register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'html5-blank');
	register_post_type('properties', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Properties', 'html5blank'), // Rename these to suit
			'singular_name' => __('Property', 'html5blank'),
			'add_new' => __('Add New', 'html5blank'),
			'add_new_item' => __('Add New Property', 'html5blank'),
			'edit' => __('Edit', 'html5blank'),
			'edit_item' => __('Edit Property', 'html5blank'),
			'new_item' => __('New Property', 'html5blank'),
			'view' => __('View Properties', 'html5blank'),
			'view_item' => __('View Property', 'html5blank'),
			'search_items' => __('Search Properties', 'html5blank'),
			'not_found' => __('No Properties found', 'html5blank'),
			'not_found_in_trash' => __('No Properties found in Trash', 'html5blank')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'menu_icon' => 'dashicons-admin-home',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail'
		), // Go to Dashboard Custom HTML5 Blank post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post_tag',
			'category'
		) // Add Category and Post Tags support
	));
}

function wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

require_once ( get_stylesheet_directory() . '/theme-options.php' );