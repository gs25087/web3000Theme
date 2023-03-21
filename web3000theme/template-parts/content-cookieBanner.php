<div id="cookie-popup" class="bg-whitebg wrap fixed bottom-0 w-full translate-y-[120%] bg-lightgray opacity-95 transition-transform duration-700 ease-in">
	<div class="eu-cookie-compliance-banner eu-cookie-compliance-banner-info eu-cookie-compliance-banner--categories">
		<div class="popup-content info">
			<div class="flex justify-between py-[0.8rem]">
				<div class=" font-custom"><?php the_field( 'cookie_notice_title', 'option' ); ?></div>
				<div class="cookie-arrow cursor-pointer">
					<?php include(locate_template('template-parts/arrow-down.php')); ?>
				</div> 
			</div>
			<div id="popup-text" class="hidden lg:w-[95%]">
				<div class="cc-text text-icongray pb-[0.88rem] lg:pb-6">
					<?php the_field( 'cookie_notice', 'option' ); ?>
				</div>
			</div>
			<?php $necessary = get_field( 'necessary_label', 'option' ); ?>
			<?php $statistics = get_field( 'statistics_label', 'option' ); ?>
			<?php $marketing = get_field( 'marketing_label', 'option' ); ?>

			<div class="justify-between lg:flex">
				<div id="eu-cookie-compliance-categories" class="eu-cookie-compliance-categories bs-eu-cookie-compliance-processed flex flex-wrap pb-[1.2rem]">
					<?php if ($necessary) : ?>
						<div class="eu-cookie-compliance-category w-1/2 pr-4 pb-[1.33rem] lg:w-auto lg:pb-0">
							<div class="flex items-center pr-4 leading-[1.2]">
								<input type="checkbox" name="cookie-categories" id="cookie-category-necessary" value="necessary" checked="" disabled="" class="peer order-2 hidden">
								<label for="cookie-category-necessary" class="order-3 cursor-pointer"><span class="cc-text"><?= $necessary; ?></span></label>
								<div class="cookie-category-necessary-before order-1 cursor-pointer before:mr-2 before:block before:h-[1em] before:w-[1em] before:cursor-pointer before:bg-closecat before:bg-bgSVG before:bg-no-repeat before:content-[''] peer-checked:before:bg-checkmark"></div>
							</div>
						</div>
					<?php endif;?>
					<?php if ($marketing) : ?>
					<div class="eu-cookie-compliance-category w-1/2 pb-[1.16rem] lg:w-auto lg:pr-4 lg:pb-0">
						<div class="flex items-center pr-4 leading-[1.2]">
							<input type="checkbox" name="cookie-categories" id="cookie-category-marketing" value="marketing" class="peer order-2 hidden">
							<label for="cookie-category-marketing" class="order-3 cursor-pointer"><span class="cc-text"><?= $marketing; ?></span></label>
							<div class="cookie-category-marketing-before order-1 cursor-pointer before:mr-2 before:block before:h-[1em] before:w-[1em] before:cursor-pointer before:bg-closecat before:bg-bgSVG before:bg-no-repeat before:content-[''] peer-checked:before:bg-checkmark"></div>
						</div>				
					</div>
					<?php endif;?> 
					<?php if ($statistics) : ?>
					<div class="eu-cookie-compliance-category w-1/2 lg:w-auto">
						<div class="flex items-center pr-4 leading-[1.2]">
							<input type="checkbox" name="cookie-categories" id="cookie-category-statistics" value="statistics" class="peer order-2 hidden">
							<label for="cookie-category-statistics" class="order-3 cursor-pointer"><span class="cc-text"><?= $statistics; ?></span></label>
							<div class="cookie-category-statistics-before order-1 cursor-pointer before:mr-2 before:block before:h-[1em] before:w-[1em] before:cursor-pointer before:bg-closecat before:bg-bgSVG before:bg-no-repeat before:content-[''] peer-checked:before:bg-checkmark"></div>
						</div>				
					</div>
					<?php endif;?>
				</div>
				<div class="flex  pb-[1.66rem] lg:pb-0">
						<button type="button" class="eu-cookie-compliance-save-preferences-button font-custom pr-[1.66rem] hover:underline lg:w-auto lg:pr-[1.5rem]"><span class="cc-text"><?php the_field( 'accept_label', 'option' ); ?></span></button>
						<button type="button" class="eu-cookie-compliance-reject-preferences-button font-custom hover:underline lg:w-auto"><span class="cc-text"><?php the_field( 'reject_label', 'option' ); ?></span></button>
				</div>
			</div>
		</div>
	</div>
</div>