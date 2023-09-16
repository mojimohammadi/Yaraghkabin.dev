<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class item_videobox extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	
	public function get_name() {
		return 'item_videobox';
	}

	public function get_title() {
		return __( 'Video Box', 'ahura' );
	}

	public function get_icon() {
		return 'aicon-svg-item-videobox';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['item_videobox', 'itemvideobox', esc_html__( 'Video Box' , 'ahura')];
	}
    
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
		mw_assets::register_style('videobox_widget_style', mw_assets::get_css('elementor.video_box'));
    }
 
    public function get_style_depends() {
		return [ mw_assets::get_handle_name('videobox_widget_style') ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'image_section',
			[
				'label' => __( 'Image', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'item_image',
			[
				'label' => esc_html__( 'Choose Image', 'ahura' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'fit_image',
			[
				'label' => __('Fit image', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'initial',
				'options' => [
					'cover' => [
						'title' => __('yes', 'ahura'),
						'icon' => 'eicon-check'
					],
					'initial' => [
						'title' => __('no', 'ahura'),
						'icon' => 'eicon-close'
					],
				],
				'toggle' => true
			]
		);

        $this->add_control(
			'image_radius',
			[
				'label' => __( 'Image radius', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
			'image_height',
			[
				'label' => __( 'Image height', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 1000,
				'step' => 10,
				'default' => 400,
			]
		);

        $this->add_control(
			'image_position',
			[
				'label' => __( 'Images Position', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'initial',
				'options' => [
					'initial'  => __( 'initial', 'ahura' ),
					'left' => __( 'left', 'ahura' ),
					'right' => __( 'right', 'ahura' ),
					'top' => __( 'top', 'ahura' ),
					'bottom' => __( 'bottom', 'ahura' ),
					'center' => __( 'center', 'ahura' ),
				],
			]
		);

        $this->add_control(
			'image_effect',
			[
				'label' => __( 'Image effect', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 100,
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'button_section',
			[
				'label' => __( 'button', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'btn_link',
			[
				'label' => __( 'Button link', 'ahura' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'ahura' ),
                'dynamic' => ['active' => true],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

        $this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'ahura' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

        $this->end_controls_section();

	}

    protected function render_link_attrs($url_data) {
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

        $elementClass = 'icon_player';
		if ( $settings['hover_animation'] ) {
			$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
		}
		$this->add_render_attribute( 'wrapper', 'class', $elementClass );

		?>
		
        <div class="videbox_content" style="background-image: url(<?php echo $settings['item_image']['url']; ?>);background-size:<?php echo $settings['fit_image']; ?>;height:<?php echo $settings['image_height']; ?>px;background-position:<?php echo $settings['image_position']; ?>;filter: brightness(<?php echo $settings['image_effect']; ?>%); border-radius:<?php echo $settings['image_radius']; ?>px;">
            <a <?php $this->render_link_attrs($settings['btn_link']);?>><div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/play.svg');"></div></a>
        </div>

		<?php
	}

}
