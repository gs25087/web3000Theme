<?php if (have_rows('content_partnerLogos')) : ?>
	<section class="wrap">
		<div class="flex">
			<?php while (have_rows('content_partnerLogos')) : the_row(); ?>
				<?php $image = get_sub_field('image'); ?>
				<?php if ($image) : ?>
					<?php lazy_picture($image['ID'], $image['alt'], 'h-10 w-10 aspect-square object-cover p-2') ?>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</section>
<?php endif; ?>