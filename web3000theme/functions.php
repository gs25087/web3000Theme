<?php
/**
 * web3000Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package web3000Theme
 */

if ( ! defined( 'WEB3000THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'WEB3000THEME_VERSION', '1.0' );
}

if ( ! function_exists( 'web3000theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function web3000theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on web3000Theme, use a find and replace
		 * to change 'web3000theme' to the name of your theme in all the template files.
		 */
		//load_theme_textdomain( 'web3000theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

    // Thumbnail sizes
    add_image_size('retina', 2560, '', false);
    add_image_size('large', 1920, '', false); // Large Thumbnail
    add_image_size('big', 1024, '', false); // Big Thumbnail
    add_image_size('medium', 768, '', true); // Medium Thumbnail
    add_image_size('small', 375, '', true); // Small Thumbnail
    add_image_size('lazy-small', 100, '', false);

    add_filter('big_image_size_threshold', '__return_false');


    function web3000theme_custom_image_sizes($sizes)
    {
      return array_merge($sizes, array(
        'retina' => __('2560px by 1600px'),
        'large' => __('1920px by 1080px'),
        'big' => __('1024px by 1024px'),
        'medium' => __('768px by 768px'),
        'small' => __('300px by 300px'),
      ));
    }
    add_filter('image_size_names_choose', 'web3000theme_custom_image_sizes');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'web3000theme' ),
				'menu-2' => __( 'Footer Menu', 'web3000theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'web3000theme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function web3000theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'web3000theme' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'web3000theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'web3000theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function web3000theme_scripts() {
	// wp_enqueue_style( 'web3000theme-style', get_stylesheet_uri(), array(), WEB3000THEME_VERSION );
	// wp_enqueue_script( 'web3000theme-script', get_template_directory_uri() . '/js/script.min.js', array(), WEB3000THEME_VERSION, true );

  if (is_page('test123')) {
    wp_enqueue_style( 'web3000theme-style', '/web3000theme/style.css', array(), WEB3000THEME_VERSION );
    wp_enqueue_script( 'web3000theme-script', '/web3000theme/js/script.min.js', array(), WEB3000THEME_VERSION, true );
  } else {
    wp_enqueue_style( 'web3000theme-style','/web3000theme/style.css' , array(), WEB3000THEME_VERSION );
    wp_enqueue_script( 'web3000theme-script', '/web3000theme/js/script.min.js', array(), WEB3000THEME_VERSION, true );
  }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'web3000theme_scripts' );

/**
 * Add the block editor class to TinyMCE.
 *
 * This allows TinyMCE to use Tailwind Typography styles.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function web3000theme_tinymce_add_class( $settings ) {
	$settings['body_class'] = 'block-editor-block-list__layout';
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'web3000theme_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/template-functions-web3000.php';