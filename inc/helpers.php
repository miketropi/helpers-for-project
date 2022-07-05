<?php
/**
 * Helpers
 *
 */

function hfp_get_all_product_cats() {
  $orderby = 'name';
  $order = 'asc';
  $hide_empty = false;
  $cat_args = [
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
  ];

  return get_terms('product_cat', $cat_args);
}

function hfp_build_widget_option_all_product_cats() {
  $terms = hfp_get_all_product_cats();
  $o = [];

  if($terms) {
    foreach($terms as $k => $t) {
      $o[$t->term_id] = $t->name;
    }
  }

  return $o;
}

function hfp_icon($name = '') {
  $icons = require(HFP_DIR . '/inc/svg.php');
  return isset($icons[$name]) ? $icons[$name] : '';
}

// add_action('init', function() {
//   var_dump(array_map(function($item) {
//     return [
//       'key' => $item->term_id,
//       'value' => $item->name,
//     ];
//   }, hfp_get_all_product_cats()));
// });
