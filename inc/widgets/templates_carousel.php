<?php
namespace ahura\inc\widgets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

use Elementor\Controls_Manager;
use ahura\app\mw_assets;

class templates_carousel extends \Elementor\Widget_Base {
    /**
     * templates_carousel constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('templates_carousel_css', mw_assets::get_css('elementor.templates_carousel'));
        mw_assets::register_style('swipercss',mw_assets::get_css('swiper-bundle-min'));
    }

    public function get_style_depends()
    {
        return [mw_assets::get_handle_name('swipercss'), mw_assets::get_handle_name('templates_carousel_css')];
    }

	public function get_name() {
		return 'templates_carousel';
	}

	public function get_title() {
		return __('Templates Carousel', 'ahura');
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return ['ahuraelements'];
	}

	function get_keywords()
	{
		return ['templates_carousel', 'templatescarousel', esc_html__('Templates Carousel' , 'ahura')];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'ahura'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'important_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__('You can create templates from elementor saved templates or ahura builder page.', 'ahura'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

        $repeater =  new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'ahura'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $temps_cls = new \ahura\app\elementor\Ahura_Elementor_Builder();
        $temps = $temps_cls->getTemplates(['section_builder', 'elementor_library']);
        
        $options = [];

        if($temps){
            foreach($temps as $temp){
                $options[$temp->ID] = $temp->post_title;
            }
        }

        $repeater->add_control(
            'item_template',
            [
                'label' => esc_html__('Template', 'ahura'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => $options,
            ]
        );

        $this->add_control(
			'items',
			[
				'label' => esc_html__('Items', 'ahura'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{item_title}}}',
			]
		);
		
		$this->end_controls_section();
        $this->start_controls_section(
			'settings_section',
			[
				'label' => __('Settings', 'ahura'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Slides per view', 'ahura'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                ],
                'default' => 4,
                'mobile_default' => 1,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Arrows', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
			'auto_play',
			[
				'label' => esc_html__('Auto Play', 'ahura'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'yes', 'ahura' ),
				'label_off' => esc_html__( 'no', 'ahura' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'auto_play_speed',
			[
				'label' => esc_html__('Auto Play Speed', 'ahura'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 1000,
                'condition' => [
                    'auto_play' => 'yes'
                ]
			]
		);

        $this->add_control(
            'infinite_loop',
            [
                'label' => esc_html__('Infinite Loop', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ahura'),
                'label_off' => esc_html__('No', 'ahura'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

        $items = $settings['items'];
        $builder = new \ahura\app\elementor\Ahura_Elementor_Builder();

        $has_navigate = ($settings['show_arrows'] == 'yes');

        if($items):
		?>
        <div class="swiper swiper-templates-carousel templates-carousel">
            <div class="swiper-wrapper">
                <?php if ($items) {
                    foreach ($items as $item) { ?>
                        <div class="swiper-slide elementor-repeater-item-<?php echo $item['_id']; ?>">
                            <div class="template-carousel-content">
                                <?php echo $builder->setContentID($item['item_template'])->build(true, true); ?>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <?php if($has_navigate): ?>
            <div class="templates-carousel-paginate-button templates-carousel-button-prev"><i class="fa fa-chevron-left"></i></div>
            <div class="templates-carousel-paginate-button templates-carousel-button-next"><i class="fa fa-chevron-right"></i></div>
            <?php endif; ?>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($){
            var cc_swiper = new Swiper('.swiper-templates-carousel', {
                loop: <?php echo $settings['infinite_loop'] == 'yes' ? 'true' : 'false' ?>,
                slidesPerView: <?php echo (isset($settings['slides_per_view_mobile']) && intval($settings['slides_per_view_mobile'])) ? $settings['slides_per_view_mobile'] : 1 ?>,
                observeParents: true,
                spaceBetween: 60,
                <?php if($has_navigate): ?>
                navigation: {
                    nextEl: '.templates-carousel-button-next',
                    prevEl: '.templates-carousel-button-prev',
                },
                <?php endif; ?>
                <?php if($settings['auto_play'] == 'yes'): ?>
                autoplay: {
                    delay: <?php echo (intval($settings['auto_play_speed'])) ? $settings['auto_play_speed'] : 8000 ?>,
                    disableOnInteraction: false,
                },
                <?php endif; ?>
                breakpoints: {
                    640: {
                        slidesPerView: <?php echo (isset($settings['slides_per_view_mobile']) && intval($settings['slides_per_view_mobile'])) ? $settings['slides_per_view_mobile'] : 1 ?>,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: <?php echo (isset($settings['slides_per_view_tablet']) && intval($settings['slides_per_view_tablet'])) ? $settings['slides_per_view_tablet'] : 2 ?>,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: <?php echo (isset($settings['slides_per_view']) && intval($settings['slides_per_view'])) ? $settings['slides_per_view'] : 4 ?>,
                        spaceBetween: 20,
                    },
                },
            });
        });
        </script>
		<?php
        endif;
	}
}
