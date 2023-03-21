<div class="social-media">
  <?php if (have_rows('social_media', 'option')) : ?>
    <?php while (have_rows('social_media', 'option')) : the_row(); ?>
      <a class="social-media__icon" target="_blank" href="<?php the_sub_field('social_link'); ?>">
        <?php $icon = get_sub_field('social_icon'); ?>
        <?php if ($icon) : ?>
          <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php the_sub_field('social_name'); ?> icon" />
        <?php else : ?>
          <?php the_sub_field('social_name'); ?>
        <?php endif; ?>
      </a>
    <?php endwhile; ?>
  <?php endif; ?>
</div>