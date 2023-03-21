<?php defined( 'ABSPATH' ) || exit;
//wp_redirect( home_url() ); exit; ?>
<?php wp_redirect(wp_get_attachment_url(), 301); exit;?>