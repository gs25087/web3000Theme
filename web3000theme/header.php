<?php defined('ABSPATH') || exit; ?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package web3000Theme
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <!--
		NO CACHE
		-->
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>

  <?php /*<script src="//cdn.jsdelivr.net/npm/eruda"></script>
		<script>eruda.init();</script> */ ?>


  <?php // <script>  
    //document.write('<style>.js_hidden { display: none; }</style>'); 		
		// history.scrollRestoration = "manual";
  //	</script>  ?>

  <!--
		Technical realization by web3000 (http://web3000.net/)
		-->
</head>

<?php global $wp_query;
$post_id = $wp_query->get_queried_object_id(); ?>

<body <?php if (is_page(array(2, 247, 'HOME')))  body_class('firststart');
else if (is_page(array(9999, 'abcdef'))) body_class('9999');
else body_class('not_home'); ?> itemscope itemtype="http://schema.org/WebPage">

<?php wp_body_open(); ?>

<div id="page">
	<a href="#content" class="sr-only"><?php esc_html_e( 'Skip to content', 'web3000theme' ); ?></a>

	<?php get_template_part( 'template-parts/header', 'content' ); ?>
