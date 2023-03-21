<?php /*
 Template Name: Custom Page Template
 */
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="swup" class="swup-transition-fade" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php $args = array('post_type' => 'custom_type_still', 'posts_per_page' => 1000);
			$loop = new WP_Query($args);
			if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();  ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<section class="entry-content cf" itemprop="articleBody">
							<?php if (has_post_thumbnail()) {
								the_post_thumbnail();
							} ?>
							<h1 class="post-title"><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</section>

					</article>

				<?php endwhile;
			else : ?>

				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
					</section>
				</article>

			<?php endif; ?>

		</main>

		<?php //get_sidebar(); 
		?>

	</div>

</div>


<?php get_footer(); ?>