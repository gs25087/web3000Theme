<?php defined('ABSPATH') || exit;
wp_redirect(home_url());
exit; ?>


<?php get_header(); ?>

<div id="content">

	<div id="inner-content">

		<main id="swup" class="swup-transition-fade" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

						<header class="article-header">

							<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
							<p class="byline vcard">
								<?php
								printf(__('Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link(get_the_author_meta('ID')), get_the_term_list($post->ID, 'custom_cat', ' ', ', ', ''));
								?></p>

						</header>

						<section class="entry-content">
							<?php
							// the content (pretty self explanatory huh)
							the_content();

							wp_link_pages(array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'bonestheme') . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							));
							?>
						</section> <!-- end article section -->

						<footer class="article-footer">
							<p class="tags"><?php echo get_the_term_list(get_the_ID(), 'custom_tag', '<span class="tags-title">' . __('Custom Tags:', 'bonestheme') . '</span> ', ', ') ?></p>

						</footer>

						<?php comments_template(); ?>

					</article>

				<?php endwhile; ?>


			<?php endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>