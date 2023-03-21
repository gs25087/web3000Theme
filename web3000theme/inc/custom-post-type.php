<?php
/*
**************************************************************
* Rename POSTS in Admin
*************************************************************/
function revcon_change_post_label()
{
 global $menu;
 global $submenu;
 $menu[5][0] = 'Projects';
 $submenu['edit.php'][5][0] = 'Projects';
 $submenu['edit.php'][10][0] = 'Add Project';
 $submenu['edit.php'][16][0] = 'Projects Tags';
 echo '';
}
function revcon_change_post_object()
{
 global $wp_post_types;
 $labels = &$wp_post_types['post']->labels;
 $labels->name = 'Projects';
 $labels->singular_name = 'Project';
 $labels->add_new = 'Add Project';
 $labels->add_new_item = 'Add Project';
 $labels->edit_item = 'Edit Project';
 $labels->new_item = 'Project';
 $labels->view_item = 'View Project';
 $labels->search_items = 'Search Projects';
 $labels->not_found = 'No Projects found';
 $labels->not_found_in_trash = 'No Projects found in Trash';
 $labels->all_items = 'All Projects';
 $labels->menu_name = 'Projects';
 $labels->name_admin_bar = 'Projects';
}

//add_action('admin_menu', 'revcon_change_post_label');
//add_action('init', 'revcon_change_post_object');

/*
**************************************************************
* Custom Post Types
*************************************************************/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_example() { 
	// creating (registering) the custom type 
	register_post_type( 'works', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Works', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Work', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Works', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Work', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Work', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Work', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Work', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Work', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'works', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'archive-works', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'works' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'works' );
	
}

	// adding the function to the Wordpress init
	//add_action( 'init', 'custom_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
//	register_taxonomy( 'custom_cat', 
//		array('works'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
//		array('hierarchical' => true,     /* if this is true, it acts like categories */
//			'labels' => array(
//				'name' => __( 'Custom Categories', 'bonestheme' ), /* name of the custom taxonomy */
//				'singular_name' => __( 'Custom Category', 'bonestheme' ), /* single taxonomy name */
//				'search_items' =>  __( 'Search Custom Categories', 'bonestheme' ), /* search title for taxomony */
//				'all_items' => __( 'All Custom Categories', 'bonestheme' ), /* all title for taxonomies */
//				'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
//				'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
//				'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
//				'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
//				'add_new_item' => __( 'Add New Custom Category', 'bonestheme' ), /* add new title for taxonomy */
//				'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
//			),
//			'show_admin_column' => true, 
//			'show_ui' => true,
//			'query_var' => true,
//			'rewrite' => array( 'slug' => 'custom-slug' ),
//			'show_in_rest' => true,
//		)
//	);
//	
//	// now let's add custom tags (these act like categories)
//	register_taxonomy( 'custom_tag', 
//		array('works'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
//		array('hierarchical' => false,    /* if this is false, it acts like tags */
//			'labels' => array(
//				'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
//				'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
//				'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
//				'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
//				'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
//				'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
//				'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
//				'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
//				'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
//				'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
//			),
//			'show_admin_column' => true,
//			'show_ui' => true,
//			'query_var' => true,
//			'show_in_rest' => true,
//		)
//	);
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
