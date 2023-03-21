<?php if (have_rows('flexible_content')) : ?>
  <?php while (have_rows('flexible_content')) : the_row(); ?>

    <?php if (get_row_layout() == 'flexible_content_text') : ?>
      <?php include(locate_template('template-parts/content-text.php')); ?>

    <?php elseif (get_row_layout() == 'flexible_content_slideshow') : ?>
      <?php include(locate_template('template-parts/content-slideshow.php')); ?>

    <?php elseif (get_row_layout() == 'flexible_content_accordion') : ?>
      <?php include(locate_template('template-parts/content-accordion.php')); ?>

    <?php elseif (get_row_layout() == 'flexible_content_partnerLogos') : ?>
      <?php include(locate_template('template-parts/content-partnerLogos.php')); ?>
    <?php endif; ?>

  <?php endwhile; ?>
<?php endif; ?>