<?php defined('ABSPATH') || exit;
wp_redirect(home_url());
exit; ?>

<?php get_header(); ?>

<div id="content">

	<main id="swup" class="swup-transition-fade" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<section class="entry-content wrap" itemprop="articleBody">
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

            <div class="entry-content prose">
						<?php the_content(); 

            wp_link_pages(
              array(
                'before' => '<div>' . __( 'Pages:', 'web3000theme' ),
                'after'  => '</div>',
              )
            ); ?>
            </div>

					</section>

				</article>

			<?php endwhile; ?>

		<?php endif; ?>

	</main>
</div>

<?php get_footer(); ?>