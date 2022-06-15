<?php 
/**
 * Plugin Name: Helpers for Project
 * Description: ...
 * Plugin URI: #
 * Author: #
 * Version: 1.0
 * Author URI: #Beplus
 *
 * Text Domain: hfp
 */

{
  /**
   * Define
   */
  define('HFP_VER', '1.0.0');
  define('HFP_URI', plugin_dir_url(__FILE__));
  define('HFP_DIR', plugin_dir_path(__FILE__));
}

{
  /**
   * Inc
   */
  require(HFP_DIR . '/inc/static.php');
  require(HFP_DIR . '/inc/helpers.php');
  require(HFP_DIR . '/inc/hooks.php');
  require(HFP_DIR . '/inc/ajax.php');
}