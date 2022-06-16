<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_HeroSection_Widget extends \Elementor\Widget_Base {

  /**
	 * Get widget name.
	 *
	 */
	public function get_name() {
		return 'hero_section';
	}

  /**
	 * Get widget title.
	 *
	 */
	public function get_title() {
		return esc_html__('Hero Section', 'hfp');
	}

  public function get_icon() {
		return 'eicon-code';
	}

  public function get_categories() {
		return ['general', 'hfp'];
	}

  public function get_keywords() {
		return ['hero', 'section'];
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
			'content',
			[
				'label' => esc_html__('Content', 'hfp'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __('WE\'LL <span class="__custom-color">BEAT</span> ANY COMPETITOR\'S SAME STOCKED ITEM BY 10% - <span class="__custom-color">GUARANTEED!</span>', 'hfp'),
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__('Background Color', 'hfp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#424749',
				'selectors' => [
					'{{WRAPPER}} .e-hero-section__background-layer' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_image',
			[
				'label' => esc_html__('Choose Image Background', 'hfp'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'text_before_cta_button',
			[
				'label' => esc_html__( 'Text Before CTA Button', 'hfp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Find The Right Product With Our', 'hfp'),
				'placeholder' => esc_html__('Type your text here', 'hfp'),
			]
		);

		$this->add_control(
			'cta_button_text',
			[
				'label' => esc_html__('Button Text', 'hfp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('SOLUTION FINDER', 'hfp'),
				'placeholder' => esc_html__('Type your cta button text here', 'hfp'),
			]
		);

		$this->add_control(
			'cta_button_url',
			[
				'label' => esc_html__('Button Url', 'hfp'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('SOLUTION FINDER', 'hfp'),
				'placeholder' => esc_html__('Type your cta button url here', 'hfp'),
			]
		);

		$this->add_control(
			'content_width',
			[
				'label' => esc_html__('Content Width', 'hfp'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 768,
						'max' => 1400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1079,
				],
				'selectors' => [
					'{{WRAPPER}} .e-hero-section__inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style Section', 'hfp'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .e-hero-section__desc, {{WRAPPER}} .e-hero-section__desc > p',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Content Color', 'hfp'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .e-hero-section__desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('content', 'advanced');

		$background_url = $settings['background_image']['url'];
		?>
		<div class="hfp-widget e-hero-section">
			<div class="e-hero-section__background-layer" style="background-image: url(<?php echo $background_url; ?>);"></div>
			<div class="__decorate __decorate-1"><img src="<?php echo HFP_URI . '/images/texture-1.png' ?>" alt="#"></div>
			<div class="__decorate __decorate-2"><img src="<?php echo HFP_URI . '/images/texture-2.png' ?>" alt="#"></div>
			<div class="e-hero-section__inner">
				<div class="e-hero-section__desc" <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo $settings['content']; ?></div>
				<div class="e-hero-section__extra">	
					<div class="e-hero-section__tag">
						<div class="e-hero-section__tag-item">
							<img src="<?php echo HFP_URI . '/images/20_years.png' ?>" alt="#">
						</div>
						<div class="e-hero-section__tag-item">
							<img src="<?php echo HFP_URI . '/images/100_aussie.png' ?>" alt="#">
						</div>
						<div class="e-hero-section__tag-item">
							<img src="<?php echo HFP_URI . '/images/price.png' ?>" alt="#">
						</div>
						<div class="e-hero-section__tag-item">
							<img src="<?php echo HFP_URI . '/images/ship.png' ?>" alt="#">
						</div>
					</div> <!-- .e-hero-section__tag -->

					<div class="e-hero-section__cta-button">
						<div class="e-hero-section__cta-text"><?php echo $settings['text_before_cta_button'] ?></div>
						<a href="<?php echo $settings['cta_button_url'] ?>" class="btn-custom-cta">
							<span><?php echo $settings['cta_button_text'] ?></span>
						</a>
					</div>
				</div>
			</div>
		</div> <!-- .e-hero-section -->
		<?php
  }
}