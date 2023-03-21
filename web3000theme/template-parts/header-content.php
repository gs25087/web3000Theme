<header class="header relative bg-white" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	<div class="inner-header">
		<div class="fixed z-30 flex w-full bg-white lg:justify-between ">
			<div itemscope itemtype="http://schema.org/Organization" class="wrap">
			<a class="block w-24" href="<?php echo home_url(); ?>" rel="nofollow">
				<?php if (get_field('logo_image', 'option')) { ?>
					<img src="<?php echo esc_url(get_field('logo_image', 'option')['url']); ?>" alt="<?php bloginfo('name'); ?>" />
				<?php } else { bloginfo('name'); }?> 
			</a>
			</div>  
			<nav class="nav-desktop wrap hidden lg:block" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement"  aria-label="<?php esc_attr_e( 'Main Navigation', 'web3000theme' ); ?>">
				<div class="nav-inner">
					<?php wp_nav_menu(array(
						'container' => false,
						'container_class' => 'flex ',
						'menu' => __('Main Menu', 'web3000Theme'),
						'menu_class' => 'flex',
						'theme_location' => 'menu-1',
					)); ?>
				</div>
			</nav>
		</div>
		<hamburger-element></hamburger-element>
		<nav class="nav-mobile wrap fixed left-0 h-screen w-full bg-white" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Main Navigation', 'web3000theme' ); ?>">

			<div class="nav-inner">
				<?php wp_nav_menu(array(
					'container' => false,
					'container_class' => '',
					'menu' => __('Main Menu', 'web3000Theme'),
					'menu_class' => 'mt-[5.75rem]',
					'theme_location' => 'menu-1',
				)); ?>
			</div>
		</nav>
	</div>
</header>