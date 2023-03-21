<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package web3000Theme
 */

// remove WP version from RSS
function web300theme_rss_version() {
	return '';
}

// remove WP version from scripts
function web300theme_remove_wp_ver_css_js($src) {
	if (strpos($src, 'ver='))
		$src = remove_query_arg('ver', $src);
	return $src;
}


function web300theme_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	// remove WP version from css
	add_filter('style_loader_src', 'web300theme_remove_wp_ver_css_js', 9999);
	// remove Wp version from scripts
	add_filter('script_loader_src', 'web300theme_remove_wp_ver_css_js', 9999);

  /******************************************************************************
  * Remove FEED Links
  ******************************************************************************/
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
  remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
  remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
  remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
  remove_action('wp_head', 'start_post_rel_link'); // Removes the random post link
  remove_action('wp_head', 'index_rel_link'); // Removes the index page link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  add_filter('xmlrpc_enabled', '__return_false');

}

 function web300theme_init() {
	// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
	require_once('custom-post-type.php');

	// launching operation cleanup
	add_action('init', 'web300theme_head_cleanup');
	// A better title
	add_filter('wp_title', 'rw_title', 10, 3);
	// remove WP version from RSS
	add_filter('the_generator', 'web300theme_rss_version');

}
add_action('after_setup_theme', 'web300theme_init');


// This removes the annoying […] to a Read More link
function web300theme_excerpt_more($more) {
	global $post;
	return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read more &raquo;', 'bonestheme') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;', 'bonestheme') . '</a>';
}
//add_filter('excerpt_more', 'web300theme_excerpt_more');


/******************************************************************************
 * Preserves HTML formating to the automatically generated Excerpt.
 * Also Code modifies the default excerpt_length and excerpt_more filters.
 *******************************************************************************/
function custom_wp_trim_excerpt($text)
{
	$raw_excerpt = $text;
	if ('' == $text) {
		//Retrieve the post content.
		$text = get_the_content('');

		//Delete all shortcode tags from the content.
		$text = strip_shortcodes($text);

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		$allowed_tags = '<p>,<a>,<em>,<strong>,<br>,<br />';
		/*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
		$text = strip_tags($text, $allowed_tags);

		$excerpt_word_count = 55;
		/*** MODIFY THIS. change the excerpt word count to any integer you like.***/
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);

		$excerpt_end = '[...]';
		/*** MODIFY THIS. change the excerpt endind to something else.***/
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
//add_filter('get_the_excerpt', 'custom_wp_trim_excerpt', 5);


/***************************************************************************
 * Excerpts length
 **************************************************************************/
function custom_trim_excerpt($text = '')
{
	$raw_excerpt = $text;
	if ('' == $text) {
		$text = get_the_content('');

		$text = strip_shortcodes($text);

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 51);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '&hellip;');
		$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
//add_filter('get_the_excerpt', 'custom_trim_excerpt');


/***************************************************************
 * excerpt read more
 ***************************************************************/
function et_excerpt_more($more)
{
	global $post;
	return ' ...<div class="readmore"><a href="' . get_permalink($post->ID) . '" class="view-full-post">READ MORE</a></div>';
}
//add_filter('excerpt_more', 'et_excerpt_more');


/***************************************************************
 * excerpt by characters
 ***************************************************************/
function excerpt_character_length( $excerpt ){
  $excerpt   = get_the_content();
  $excerpt   = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt   = strip_shortcodes($excerpt);
  $excerpt   = strip_tags($excerpt);
  $excerpt   = substr($excerpt, 0, 160);
  $excerpt   = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt   = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt   = $excerpt . '&nbsp;...';
  return $excerpt;
}
add_filter('the_excerpt', 'excerpt_character_length');


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */
function ar_responsive_image($image_id, $image_size, $max_width)
{

	// set the default src image size
	//$image_src = wp_get_attachment_image_url( $image_id, $image_size );
	$image_src = wp_get_attachment_image_src($image_id, $image_size);

	// set the srcset with various image sizes
	$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

	// generate the markup for the responsive image
	echo 'src="' . $image_src[0] . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '" width="' . $image_src[1] . '" height="' . $image_src[2] . '" loading="lazy class="mx-auto"';
}

function lazy_picture($image_id, $altText, $extraClasses = '')
{

	$image_src = wp_get_attachment_image_src($image_id, 'small');

	echo '<picture>';
	if ($image_src) {
		echo '<source	data-srcset="' . $image_src[0] . '"	media="--small" />';
	}

	$image_src = wp_get_attachment_image_src($image_id, 'medium');
	if ($image_src) {
		echo '<source	data-srcset="' . $image_src[0] . '"	media="--medium" />';
	}

	$image_src = wp_get_attachment_image_src($image_id, 'big');
	if ($image_src) {
		echo '<source	data-srcset="' . $image_src[0] . '"	media="--big" />';
	}

	$image_src = wp_get_attachment_image_src($image_id, 'large');
	if ($image_src) {
		echo '<source	data-srcset="' . $image_src[0] . '"	media="--large" />';
	}

	$image_src = wp_get_attachment_image_src($image_id, 'retina');
	if ($image_src) {
		echo '<source	data-srcset="' . $image_src[0] . '" />';
	}
	$image_src_small = wp_get_attachment_image_src($image_id, 'lazy-small');
	echo '<img src="' . $image_src_small[0] . '"  class="mx-auto lazyload blur-up ' . $extraClasses . '" alt="' . $altText . '" width="' . $image_src[1] . '" height="' . $image_src[2] . '" /></picture>';
}

function lazy_image($image_id, $image_size, $max_width)
{

	// check the image ID is not blank
	if ($image_id != '') {

		// set the default src image size
		$imageLazy_src = wp_get_attachment_image_src($image_id, 'lazy-small');
		$image_src = wp_get_attachment_image_src($image_id, $image_size);

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

		// generate the markup for the responsive image
		echo 'src="' . $imageLazy_src[0] . '" data-sizes="auto" data-src="' . $image_src[0] . '" data-srcset="' . $image_srcset . '"  width="' . $image_src[1] . '" height="' . $image_src[2] . '" class="mx-auto"';
	}
}


/*function ar_responsive_square($image_id){

	// check the image ID is not blank
	if($image_id != '') {
		$max_width = 1024;
		
		$image_bigsrc = wp_get_attachment_image_src( $image_id, 'square-tiny' );
		if ( $image_bigsrc ) {
			$image_srcset = $image_bigsrc[0] . ' 300vw';
		}
		
		$image_src = wp_get_attachment_image_src( $image_id, 'square-small' );
		if ( $image_src[2] >= 600 ) {
			$image_bigsrc = $image_src;
			$image_srcset = $image_bigsrc[0] . ' 600vw, ' . $image_srcset;
		}
		
		$image_src = wp_get_attachment_image_src( $image_id, 'square-medium' );
		if ( $image_src[2] >= 1000 ) {
			$image_bigsrc = $image_src;
			$image_srcset = $image_bigsrc[0] . ' 1000vw, ' . $image_srcset;
		}
		
		$image_src = wp_get_attachment_image_src( $image_id, 'square' );
		if ( $image_src[2] >= 1500  ) {
			$image_bigsrc = $image_src;
			$image_srcset = $image_bigsrc[0] . ' 1500vw, ' . $image_srcset;
		}

		// generate the markup for the responsive image
		echo 'src="'.$image_bigsrc[0].'" srcset="'. $image_srcset .'" sizes="(min-width: '.$max_width.'px) 50vw, 100vw"';
	}
}*/


/* ==========================================================================================================
 * OWN SCRIPTS
 * ==========================================================================================================*/

/*************************************************************************
 * Add page slug to body class, love this - Credit: Starkers Wordpress Theme
 ***************************************************************************/
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
add_filter('body_class', 'add_slug_to_body_class');


/************************************************************** 
 * Logout time
 *************************************************************/
function keep_me_logged_in_for_1_year($expirein) {
	return 31556926; // 1 year in seconds
}
add_filter('auth_cookie_expiration', 'keep_me_logged_in_for_1_year');


/*************************************************************************
 *   META descriptions from posts
 ************************************************************************/
function create_meta_desc()
{
	global $post;
	if (!is_single()) {
		return;
	}
	$meta = strip_tags($post->post_content);
	$meta = strip_shortcodes($meta); /* here you have to use the same variable, or else the strip_tags will not have any effect */
	$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
	$meta = substr($meta, 0, 155);
	echo "<meta name='description' content='$meta' />";
}
//add_action('wp_head', 'create_meta_desc');


/************************************************************** 
 * remove canonical
 *************************************************************/
function wpseo_canonical_exclude($canonical) {
	return false;
}
add_filter('wpseo_canonical', 'wpseo_canonical_exclude');


/************************************************************** 
 * remove update email
 *************************************************************/
add_filter('auto_core_update_send_email', 'wpb_stop_auto_update_emails', 10, 4);
add_filter('send_password_change_email', '__return_false');

function wpb_stop_update_emails($send, $type, $core_update, $result)
{
	if (!empty($type) && $type == 'success') {
		return false;
	}
	return true;
}

//Disable the new user notification sent to the site admin
function smartwp_disable_new_user_notifications()
{
	//Remove original use created emails
	remove_action('register_new_user', 'wp_send_new_user_notifications');
	remove_action('edit_user_created_user', 'wp_send_new_user_notifications', 10, 2);

	//Add new function to take over email creation
	add_action('register_new_user', 'smartwp_send_new_user_notifications');
	add_action('edit_user_created_user', 'smartwp_send_new_user_notifications', 10, 2);
}
function smartwp_send_new_user_notifications($user_id, $notify = 'user')
{
	if (empty($notify) || $notify == 'admin') {
		return;
	} elseif ($notify == 'both') {
		//Only send the new user their email, not the admin
		$notify = 'user';
	}
	wp_send_new_user_notifications($user_id, $notify);
}
add_action('init', 'smartwp_disable_new_user_notifications');


/**
 * Remove Editor Blocks styles from the front end.
 */
function web3000_remove_editor_blocks_assets()
{
	if (!is_admin()) {
		wp_dequeue_style('wp-block-library');
	}
}
add_action('enqueue_block_assets', 'web3000_remove_editor_blocks_assets');


function web3000_deregister_styles() {
	if (!is_admin()) {
		wp_dequeue_style('everest-forms-pro-frontend-css');
		wp_deregister_style('everest-forms-pro-frontend-css');
		wp_dequeue_style('everest-forms-general-css');
		wp_deregister_style('everest-forms-general-css');
		wp_dequeue_style('bb-tcs-editor-style-shared');
		wp_dequeue_style('dashicons');
		wp_dequeue_style('global-styles');
		wp_dequeue_style('global-styles-inline-css');
		wp_deregister_style('global-styles-inline-css');
	}
}
add_action('wp_print_styles', 'web3000_deregister_styles', 100);

function web3000_dequeue_scripts() {
	wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'web3000_dequeue_scripts');

function web3000_deregister_scripts() {
	if (!is_admin()) {
		wp_deregister_script('bb-tcs-editor-style-shared');
	}
}
//add_action( 'wp_print_scripts', 'web3000_deregister_scripts', 100 );


/** * Completely Remove jQuery From WordPress */
function my_init() {
  if (!is_admin()) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', false);
  }
}
add_action('init', 'my_init');

//Remove JQuery migrate
 function remove_jquery_migrate( $scripts ) {
  if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
       $script = $scripts->registered['jquery'];
    if ( $script->deps ) { 
    // Check whether the script has any dependencies

          $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
    }
  }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);


add_filter('render_block', function ($block_content, $block) {
	if ($block['blockName'] === 'core/columns') {
		return $block_content;
	}
	if ($block['blockName'] === 'core/column') {
		return $block_content;
	}
	if ($block['blockName'] === 'core/group') {
		return $block_content;
	}

	return wp_render_layout_support_flag($block_content, $block);
}, 10, 2);

add_filter('emoji_svg_url', '__return_false');

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

/**
 * Disable REST API user endpoints.
 */
function web3000_rest_endpoints($endpoints)
{
	if (isset($endpoints['/wp/v2/users'])) {
		unset($endpoints['/wp/v2/users']);
	}
	if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
		unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
	}

	return $endpoints;
}
add_filter('rest_endpoints', 'web3000_rest_endpoints');

function remove_post_format()
{
	remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'remove_post_format', 15);


/* Use Paste As Text by default in the editor
----------------------------------------------------------------------------------------*/
add_filter('tiny_mce_before_init', 'ag_tinymce_paste_as_text');
function ag_tinymce_paste_as_text($init) {
	$init['paste_as_text'] = true;
	return $init;
}

function web3000_disable_gutenberg_posttype($current_status, $post_type) {
	if ($post_type === 'post') return false;
	return $current_status;
}
//add_filter('use_block_editor_for_post_type', 'web3000_disable_gutenberg_posttype', 10, 2);

/**
 * Templates and Page IDs without editor
 *
 */
function web3000_disable_editor($id = false) {

	$excluded_templates = array(
		'page-customPartner.php',
	);

	$excluded_ids = array();

	if (empty($id))
		return false;

	$id = intval($id);
	$template = get_page_template_slug($id);

	return in_array($id, $excluded_ids) || in_array($template, $excluded_templates);
}

/**
 * Disable Gutenberg by template
 *
 */
function web3000_disable_gutenberg($can_edit, $post_type)
{

	if (!(is_admin() && !empty($_GET['post'])))
		return $can_edit;

	if (web3000_disable_editor($_GET['post']))
		//$can_edit = falsef;

		return $can_edit;
}
add_filter('gutenberg_can_edit_post_type', 'web3000_disable_gutenberg', 10, 2);
add_filter('use_block_editor_for_post_type', 'web3000_disable_gutenberg', 10, 2);

// Remove tags support from posts
function web3000_unregister_tags() {
	//unregister_taxonomy_for_object_type('category', 'post');
	unregister_taxonomy_for_object_type('post_tag', 'post');
}
//add_action('init', 'web3000_unregister_tags');

remove_filter('the_content', 'wptexturize');
add_filter( 'run_wptexturize', '__return_false' );

//add_filter( 'wpml_custom_field_original_data', __return_null );

add_filter('acf-autosize/wysiwyg/min-height', function () {
	return 0;
});

function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/***************************************************************
 *TINYMCE Filter
 **************************************************************/

 add_filter('tiny_mce_before_init', 'my_mce_before_init');
 function my_mce_before_init($settings) {
 
   $style_formats = array(
     array(
       'title' => 'Format 1',
       'block' => 'div',
       'classes' => 'format1',
       'wrapper' => true
     ),
     array(
       'title' => 'Archivo Font',
       'inline' => 'span',
       'classes' => 'archivo',
       'styles' => array(
         'fontWeight' => 'bold',
         'fontFamily' => '"Archivo Black", Arial, "Helvetica Neue", Helvetica'
       )
     )
   );
 
   $settings['style_formats'] = json_encode($style_formats);
 
   return $settings;
 }
 
 
 /***************************************************************
  * protected password form
  **************************************************************/
 function my_password_form()
 {
   global $post;
   $post = get_post($post);
   $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
   $output = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form" method="post">
   <p>' . __('Please enter the password') . '</p>
   <p><label for="' . $label . '">' . __('Password:') . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . esc_attr__('Submit') . '" /></p>
   </form>
   ';
   return $output;
 }
 add_filter('the_password_form', 'my_password_form');


 /**************************************************************
 * ACF SETTINGS
 *************************************************************/
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

add_filter('acf/settings/default_language', 'my_acf_settings_default_language');

function my_acf_settings_default_language($language)
{
	return 'en';
}

//add_filter('acf/settings/current_language', 'my_acf_settings_current_language');

function my_acf_settings_current_language($language)
{
	return 'de';
}

/**
 * Advanced Custom Fields Options function
 * Always fetch an Options field value from the default language
 */
function cl_acf_set_language() {
  return 'de'; //acf_get_setting('default_language');
}
function get_global_option($name) {
	add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	$option = get_field($name, 'option');
	remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	return $option;
}


/**************************************************************
 * ACF Blocks
 *************************************************************/


function web3000_allowed_block_types($allowed_blocks, $post)
{
	$allowed_blocks = array(
		//'core/heading',
		//'core/paragraph',
		'core/audio',
		//'core/columns',
		//'core/shortcode',
		//'tadv/classic-paragraph',
		'acf/text-block',
		'acf/image',
		//'acf/slideshow',
		'acf/video',
		'acf/embed',
		//'acf/menu-section-block',
		//'acf/grid-block',
		//'acf/seemore',
		//'acf/seemore2',
	);
	/* 	if( $post->post_type === 'page' ) {
		$allowed_blocks[] = 'core/shortcode';
	} */
	return $allowed_blocks;
}
add_filter('allowed_block_types', 'web3000_allowed_block_types', 10, 2);


// Custom Backend Footer
function bones_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://web3000.net" target="_blank">web3000.net</a></span>.', 'web3000Theme');
}
add_filter('admin_footer_text', 'bones_custom_admin_footer');

function load_custom_wp_admin_style() {
	wp_enqueue_style('custom_wp_admin_css', get_template_directory_uri() . '/dist/css/admin.css', false, '1.0.0');
}

function gutenberg_block_editor_admin_styles() {
	$current_screen = get_current_screen();
	if (!is_null($current_screen) && $current_screen->is_block_editor()) {
		/** This action is documented in wp-admin/admin-footer.php */
		// phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
		wp_enqueue_style('bones_adminbase_css', get_template_directory_uri() . '/css/style.css', false);
		wp_enqueue_style('bones_admin_css', get_template_directory_uri() . '/css/admin.css', false);
	} elseif (!is_null($current_screen)) {
		wp_enqueue_style('bones_admin_css', get_template_directory_uri() . '/css/admin.css', false);
	}
}

if (is_admin()) {
	//add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
	//add_action('admin_print_styles', 'gutenberg_block_editor_admin_styles');
}

/**************************************************************
 * CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
 *************************************************************/
function all_settings_link()
{
	add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');



// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2_func($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
	return '<h2>' . $content . '</h2>';
}
// Shortcodes
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2_func'); // Place [html5_shortcode_demo_2] in Pages, Posts now.


// Remove Admin bar
add_filter( 'show_admin_bar', '__return_false' );

