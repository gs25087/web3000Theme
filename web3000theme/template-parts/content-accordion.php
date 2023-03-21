<?php if (have_rows('content_accordion')) : ?>
  <section class="entry-content wrap py-16" itemprop="articleBody">	
    <accordion-element>
      <?php while (have_rows('content_accordion')) : the_row(); ?>
          <?php $heading = get_sub_field('accordion_item_heading'); ?>
          <?php $content = get_sub_field('accordion_item_content'); ?>    
          <div class="accordion__item__heading font-bold border cursor-pointer border-black p-4" data-index="<?= get_row_index(); ?>">
              <?php echo $heading; ?>
            </div>
            <div class="accordion__item__content bg-white max-h-0 transition-all ease-in-out overflow-y-hidden duration-500" data-index="<?= get_row_index(); ?>">
              <div class="h-4"></div>
              <?php echo $content; ?>
              <div class="h-4"></div>
          </div>
      <?php endwhile; ?>
    </accordion-element>
  </section>
<?php endif; ?>