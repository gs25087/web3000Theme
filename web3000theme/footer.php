<?php defined('ABSPATH') || exit; ?>

  <footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

    <div class="inner-footer wrap">

      <span class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></span>

      <nav role="navigation">
        <?php wp_nav_menu(array(
          'container' => 'div',
          'container_class' => 'footer-links',
          'menu' => __('Footer Links', 'web3000Theme'),
          'menu_class' => 'nav footer-nav',
          'theme_location' => 'menu-2',

        )); ?>
      </nav>

      <?php include(locate_template('template-parts/social-media.php')); ?>

    </div>

  </footer>

</div> <?php // #page ?>

<?php include(locate_template('template-parts/content-cookieBanner.php')); ?>

<?php wp_footer(); ?>

<script id="__bs_script__">//<![CDATA[
  (function() {
    try {
      var script = document.createElement('script');
      if ('async') {
        script.async = true;
      }
      script.src = 'https://HOST:3000/browser-sync/browser-sync-client.js?v=2.28.3'.replace("HOST", location.hostname);
      if (document.body) {
        document.body.appendChild(script);
      }
    } catch (e) {
      console.error("Browsersync: could not append script tag", e);
    }
  })()
//]]></script>
 
</body>
</html>
