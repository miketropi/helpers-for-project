<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_ProductsGrid_Widget extends \Elementor\Widget_Base {

  /**
	 * Get widget name.
	 *
	 */
	public function get_name() {
		return 'products_grid';
	}

  /**
	 * Get widget title.
	 *
	 */
	public function get_title() {
		return esc_html__('Products Grid', 'hfp');
	}

  public function get_icon() {
		return 'eicon-code';
	}

  public function get_categories() {
		return ['general', 'hfp'];
	}

  public function get_keywords() {
		return ['products grid'];
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
			'number_items',
			[
				'label' => esc_html__('Number', 'hfp'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
			]
		);

    $this->end_controls_section();
  } 

  protected function render() {
    $settings = $this->get_settings_for_display();
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => (int) $settings['number_items'],
      'post_status' => 'publish',
      'tax_query' => array(
          array(
              'taxonomy' => 'product_visibility',
              'field' => 'name',
              'terms' => 'featured',
              'operator' => 'IN'
          ),
      ),
    );
    $featured_product = new WP_Query($args);
    ?>
    <div class="hfp-widget e-products-grid woocommerce">
      <div class="e-products-grid__inner">
        <?php if ($featured_product->have_posts()) : ?>
          <?php while ($featured_product->have_posts()) : $featured_product->the_post(); ?>
          <?php 
          $product = wc_get_product($featured_product->post->ID);
          $post_thumbnail_id = get_post_thumbnail_id();
          $product_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, $size = 'shop-feature');
          $product_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
          $average = $product->get_average_rating();
          
          $p_image = (($product_thumbnail && isset($product_thumbnail[0])) ? $product_thumbnail[0] : wc_placeholder_img_src());
          ?>
          <div class="e-products-grid__item">
            <img src="<?php echo $p_image; ?>" alt="<?php echo $product_thumbnail_alt; ?>">
            <h2 class="woocommerce-loop-product__title">
              <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </h2>
            <div class="prod-star-rating">
								<span class="prod-star prod-star-df"></span>
								<span class="prod-star prod-star-active" style="width:<?= (($average / 5) * 100) ?>%"><span></span></span>
							</div>
            <?php if (!$product->get_short_description()) return; ?>
              <div itemprop="description" class="product-description">
                <?php echo apply_filters('woocommerce_short_description', $product->get_short_description()) ?>
              </div>
              <?php
              if ($product->is_type('variable')) {
                $product_variations = $product->get_available_variations();
                $variation_product_id = $product_variations [0]['variation_id'];
                $variation_product = new WC_Product_Variation($variation_product_id);
                ?>
                <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><?php echo $variation_product->regular_price; ?></span></span></a>
              <?php } else { ?>
              <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><?php echo $product->get_regular_price(); ?></span></span></a>
            <?php } ?>
            <a href="<?php the_permalink(); ?>" class="btn-product-detail">View Product</a> 
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
    <?php 
  }
}
