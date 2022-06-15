<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_ProductCateMenu_Widget extends \Elementor\Widget_Base {

  /**
	 * Get widget name.
	 *
	 */
	public function get_name() {
		return 'product_cate_menu';
	}

  /**
	 * Get widget title.
	 *
	 */
	public function get_title() {
		return esc_html__('Product Cate Menu', 'hfp');
	}

  public function get_icon() {
		return 'eicon-code';
	}

  public function get_categories() {
		return ['general', 'hfp'];
	}

  public function get_keywords() {
		return ['product menu category'];
	}

  protected function register_controls() {
    $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'hfp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'heading_text',
			[
				'label' => esc_html__('Heading Text', 'hfp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Products', 'hfp'),
				'placeholder' => esc_html__('Type your title here', 'hfp'),
			]
		);

    $this->add_control(
			'product_cats',
			[
				'label' => esc_html__('Product Category', 'hfp'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => hfp_build_widget_option_all_product_cats(),
				'default' => [],
			]
		);

    $this->end_controls_section();
  } 

  protected function render() {
    $settings = $this->get_settings_for_display();
    $terms = [];

    if($settings['product_cats'] && count($settings['product_cats'])) {
      $terms = array_map(function($term_id) {
        return get_term($term_id, 'product_cat');
      }, $settings['product_cats']);
    }
    ?>
    <div class="hfp-widget e-product-cate-menu">
      <div class="e-product-cate-menu__inner">
        <h4 class="hfp-widget__title"><?php echo $settings['heading_text'] ?></h4>
        <ul class="p-term-list">
        <?php if($terms && count($terms) > 0) {
          foreach($terms as $index => $term) { ?>
          <li class="p-term-list__item">
            <a href="<?php echo get_term_link($term, 'product_cat') ?>"><?php echo $term->name ?></a>
          </li> 
        <?php }} ?>
        </ul>
      </div>
    </div>
    <?php 
  }
}
