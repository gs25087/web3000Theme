<?php if (have_rows('content_slideshow')) : ?>

  <section class="wrap 123x" g-component="SwiperComponent">
    <swiper-container class="my-swiper" slides-per-view="2" speed="500" loop="true" pagination="true" navigation="true"> 
    <?php while (have_rows('content_slideshow')) : the_row(); ?>
      <?php $slideshow_image = get_sub_field('slideshow_image'); ?>
      <?php if ($slideshow_image) : ?>
        <swiper-slide>
          <?php lazy_picture($slideshow_image['ID'], $slideshow_image['alt'], 'w-full object-cover ') ?>
        </swiper-slide>
      <?php endif; ?>
    <?php endwhile; ?>
    </swiper-container>
  </section>

<?php endif; ?>  