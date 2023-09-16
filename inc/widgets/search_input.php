<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class search_input extends \Elementor\Widget_Base {

	public function get_name() {
		return 'search_input';
	}

	public function get_title() {
		return __( 'Search Input', 'ahura' );
	}

	public function get_icon() {
		return 'aicon-svg-search-input';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['search_input', 'searchinput', esc_html__( 'Search Input' , 'ahura')];
	}
	function __construct($data=[], $args=null)
	{
		parent::__construct($data, $args);
		$search_input_css = mw_assets::get_css('elementor.search_input');
		mw_assets::register_style('search_input', $search_input_css);
	}
	function get_style_depends()
	{
		return [mw_assets::get_handle_name('search_input')];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
		$this->add_control(
			'button_text',
			[
				'label'    => __( 'Button Text', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::TEXT,
				'default' => __("Search", 'ahura')
			]
		);

		$this->add_control(
			'input_placeholder',
			[
				'label'   => __( 'Placeholder', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __('e.g. Best burger in this city', 'ahura')
			]
		);
        
		$this->add_control(
			'button_background',
			[
				'label'   => __( 'Button Background Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#61ce70',
				'selectors' => [
					"{{WRAPPER}} .search_elem_btn" => 'background-color: {{VALUE}} !important'
				]
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'   => __( 'Button color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					"{{WRAPPER}} .search_elem_btn" => 'color: {{VALUE}}'
				]
			]
		);

		
		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $btn_text = $settings['button_text'];
		$place_holder = $settings['input_placeholder'];
        ?>
        <div class="search_elem">
            <form action="<?php echo home_url()?>">
                <input type="text" name="s" placeholder="<?php echo $place_holder; ?>" />
                <button type="submit" class="search_elem_btn"><?php echo $btn_text?></button>
            </form>
        </div>
        <?php
	}

}
