<?php defined('ABSPATH') || exit;
get_header(); ?>

<div id="content">
 
	<main id="swup" class="swup-transition-fade bg-red-400" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
     
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<section class="entry-content wrap pt-24" itemprop="articleBody">
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

            <div class="entry-content prose">
							<?php the_content(); ?>
            </div>

					</section>

					<?php include(locate_template('template-parts/flexible-content.php')); ?>

					<?php include(locate_template('template-parts/content-ticker.php')); ?>

				</article>

			<?php endwhile; ?>

		<?php endif; ?>

	</main>
</div>

<?php get_footer(); ?>