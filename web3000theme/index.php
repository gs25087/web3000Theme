<?php defined('ABSPATH') || exit;
get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap">

		<main id="swup" class="swup-transition-fade" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

						<section class="entry-content">
							<h1 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php single_post_title(); ?></a></h1>

							<?php the_content(); ?>

						</section>

					</article>

				<?php endwhile; ?>

        <?php web3000theme_the_posts_navigation(); ?>

			<?php endif; ?>

		</main>

	</div>

</div>

<?php get_footer(); ?>