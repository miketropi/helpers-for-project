<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_CardGrid_Widget extends \Elementor\Widget_Base {

  /**
	 * Get widget name.
	 *
	 */
	public function get_name() {
		return 'card_grid';
	}

  /**
	 * Get widget title.
	 *
	 */
	public function get_title() {
		return esc_html__('Card Grid', 'hfp');
	}

  public function get_icon() {
		return 'eicon-code';
	}

  public function get_categories() {
		return ['general', 'hfp'];
	}

  public function get_keywords() {
		return ['product category grid'];
	}

  protected function register_controls() {
    $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'hfp'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'card_title', [
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title here' , 'fhp' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'card_sub_title', [
				'label' => esc_html__('Sub Title', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sub title here' , 'fhp'),
			]
		);

		$repeater->add_control(
			'card_image', [
				'label' => esc_html__('Image', 'fhp'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'card_url', [
				'label' => esc_html__('Url', 'fhp'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Card List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'card_title' => esc_html__( 'Title #1', 'plugin-name' ),
						'card_sub_title' => esc_html__('Sub Title #1', 'hfp'),
						'card_image' => \Elementor\Utils::get_placeholder_image_src(),
						'card_url' => '#',
					],
					[
						'card_title' => esc_html__('Title #2', 'plugin-name'),
						'card_sub_title' => esc_html__('Sub Title #2', 'hfp'),
						'card_image' => \Elementor\Utils::get_placeholder_image_src(),
						'card_url' => '#',
					],
					[
						'card_title' => esc_html__('Title #3', 'plugin-name'),
						'card_sub_title' => esc_html__('Sub Title #3', 'hfp'),
						'card_image' => \Elementor\Utils::get_placeholder_image_src(),
						'card_url' => '#',
					],
				],
				'title_field' => '{{{ card_title }}}',
			]
		);

    $this->end_controls_section();
  } 

  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="hfp-widget e-card-grid">
      <div class="e-card-grid__inner">
				<?php if(count($settings['list'])) {
					foreach($settings['list'] as $index => $card) { ?>
				<div class="e-card-grid__item">
					<a href="<?php echo $card['card_url']; ?>">
						<div class="e-card-grid__name"><?php echo $card['card_title']; ?></div>
						<div class="e-card-grid__image">
							<img src="<?php echo $card['card_image']['url'] ?>" alt="#<?php echo $card['card_title']; ?>">
							<div class="e-card-grid__sub-title"><?php echo $card['card_sub_title']; ?></div>
						</div>
					</a>
				</div> <!-- .e-card-grid__item -->
				<?php	} } ?>
      </div>
    </div> <!-- .e-card-grid -->
    <?php 
  }
}
