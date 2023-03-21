<?php defined('ABSPATH') || exit;
wp_redirect(home_url());
exit; ?>
<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="swup" class="swup-transition-fade" role="main">
			<h1 class="archive-title"><span><?php _e('Search Results for:', 'bonestheme'); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

						<header class="entry-header article-header">

							<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

							<p class="byline entry-meta vcard">
								<?php printf(
									__('Posted %1$s by %2$s', 'bonestheme'),
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link(get_the_author_meta('ID')) . '</span>'
								); ?>
							</p>

						</header>

						<section class="entry-content">
							<?php the_excerpt('<span class="read-more">' . __('Read more &raquo;', 'bonestheme') . '</span>'); ?>

						</section>

						<footer class="article-footer">

							<?php if (get_the_category_list(', ') != '') : ?>
								<?php printf(__('Filed under: %1$s', 'bonestheme'), get_the_category_list(', ')); ?>
							<?php endif; ?>

							<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', '</p>'); ?>

						</footer> <!-- end article footer -->

					</article>

				<?php endwhile; ?>

				<?php web3000theme_the_posts_navigation(); ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e('Sorry, No Results.', 'bonestheme'); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e('Try your search again.', 'bonestheme'); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e('This is the error message in the search.php template.', 'bonestheme'); ?></p>
					</footer>
				</article>

			<?php endif; ?>

		</main>

		<?php //get_sidebar(); 
		?>

	</div>

</div>

<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package web3000Theme
 */

get_header();
?>

	<section id="primary">
		<main id="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				printf(
					/* translators: 1: search result title. 2: search term. */
					'<h1 class="page-title">%1$s <span>%2$s</span></h1>',
					esc_html__( 'Search results for:', 'web3000theme' ),
					get_search_query()
				);
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			web3000theme_the_posts_navigation();

		else :

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
