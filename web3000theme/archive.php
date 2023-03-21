<?php defined('ABSPATH') || exit;
wp_redirect(home_url());
exit; ?>
<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="swup" class="swup-transition-fade" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (is_category()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e('Posts Categorized:', 'web3000theme'); ?></span> <?php single_cat_title(); ?>
				</h1>

			<?php } elseif (is_tag()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e('Posts Tagged:', 'web3000theme'); ?></span> <?php single_tag_title(); ?>
				</h1>

			<?php } elseif (is_author()) {
				global $post;
				$author_id = $post->post_author;
			?>
				<h1 class="archive-title h2">

					<span><?php _e('Posts By:', 'web3000theme'); ?></span> <?php the_author_meta('display_name', $author_id); ?>

				</h1>
			<?php } elseif (is_day()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e('Daily Archives:', 'web3000theme'); ?></span> <?php the_time('l, F j, Y'); ?>
				</h1>

			<?php } elseif (is_month()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e('Monthly Archives:', 'web3000theme'); ?></span> <?php the_time('F Y'); ?>
				</h1>

			<?php } elseif (is_year()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e('Yearly Archives:', 'web3000theme'); ?></span> <?php the_time('Y'); ?>
				</h1>
			<?php } ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

						<header class="entry-header article-header">

							<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<p class="byline entry-meta vcard">
								<?php printf(
									__('Posted %1$s by %2$s', 'web3000theme'),
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link(get_the_author_meta('ID')) . '</span>'
								); ?>
							</p>

						</header>

						<section class="entry-content cf">

							<?php the_post_thumbnail('small'); ?>

							<?php the_excerpt(); ?>

						</section>

						<footer class="article-footer">

						</footer>

					</article>

				<?php endwhile; ?>

				<?php web3000theme_the_posts_navigation(); ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e('Oops, Post Not Found!', 'web3000theme'); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'web3000theme'); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e('This is the error message in the archive.php template.', 'web3000theme'); ?></p>
					</footer>
				</article>

			<?php endif; ?>

		</main>

		<?php //get_sidebar(); 
		?>

	</div>

</div>

<?php get_footer(); ?>