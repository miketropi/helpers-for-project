<?php
/**
 * Static
 */

function hfp_enqueue_scripts() {
  wp_enqueue_style('hfp-style', HFP_URI . '/dist/css/helpers-for-project.bundle.css', false, HFP_VER);
  wp_enqueue_script('hfp-script', HFP_URI . '/dist/helpers-for-project.bundle.js', ['jquery'], HFP_VER, true);

  wp_localize_script('hfp-script', 'HFP_PHP', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'lang' => [],
  ]);
}

add_action('wp_enqueue_scripts', 'hfp_enqueue_scripts');