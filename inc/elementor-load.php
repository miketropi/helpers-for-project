<?php

function hfp_add_elementor_widget_categories($elements_manager) {

	$elements_manager->add_category(
		'hfp',
		[
			'title' => esc_html__('Helpers for Project', 'hfp'),
			'icon' => 'fa fa-plug',
		]
	);
}

add_action('elementor/elements/categories_registered', 'hfp_add_elementor_widget_categories');

/**
 * Register elementor Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function ccs_register_elementor_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hero-section.php' );
	$widgets_manager->register( new \Elementor_HeroSection_Widget() );

	require_once( __DIR__ . '/widgets/product-cate-menu.php' );
	$widgets_manager->register( new \Elementor_ProductCateMenu_Widget() );

}
add_action('elementor/widgets/register', 'ccs_register_elementor_widget');