<?php

namespace ahura\inc\widgets;

use ahura\app\mw_assets;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class item_portfolio extends \Elementor\Widget_Base {

	public function get_name() {
		return 'item_portfolio';
	}
  
	public function get_title() {
		return __( 'Portfolio', 'ahura' );
	}

    public function get_icon() {
		return 'aicon-svg-item-portfolio';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['item_portfolio', 'item_portfolio', esc_html__( 'Portfolio', 'ahura')];
	}

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
		$portfolioCss = mw_assets::get_css('elementor.portfolio');
		$portfolioJs = mw_assets::get_js('elementor.portfolio');
		mw_assets::register_style('portfolio_widget_style', $portfolioCss);
		mw_assets::register_script('portfolio_widget_script', $portfolioJs, ['elementor-frontend']);
    }
 
    public function get_style_depends() {
        return [ mw_assets::get_handle_name('portfolio_widget_style') ];
    }
  
    public function get_script_depends() {
        return [ mw_assets::get_handle_name('portfolio_widget_script') ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'header_all_title',
			[
				'label' => __("ALL label", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("All", 'ahura')
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'ahura' ),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'list_gallery',
			[
				'label' => __( 'Add Images', 'ahura' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'ahura' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Item 1', 'ahura' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'ahura'),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => __('Title typography', 'ahura'),
				'selector' => '{{WRAPPER}} .portfolio ul.header li',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20'
						]
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ]
				]
			]
		);

		$this->add_control(
			'images_col',
			[
				'label' => __( 'Images column', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'6'  => __( '2', 'ahura' ),
					'4' => __( '3', 'ahura' ),
					'3' => __( '4', 'ahura' ),
					'2' => __( '6', 'ahura' ),
				],
			]
		);

		$this->add_control(
            'title_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Title color', 'ahura'),
                'default' => '#333',
                'selectors' =>
                [
                    '{{WRAPPER}} .portfolio ul.header li' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_control(
            'title_backcolor',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Title background color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .portfolio ul.header li' => 'background-color: {{VALUE}}'
                ]
            ]
        );

		$this->add_control(
            'title_hover_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Title hover color', 'ahura'),
                'default' => '#333',
                'selectors' =>
                [
                    '{{WRAPPER}} .portfolio ul.header li:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_control(
            'title_hover_backcolor',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Title hover background color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .portfolio ul.header li:hover' => 'background-color: {{VALUE}}'
                ]
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
						'icon' => 'far fa-check'
					],
					'initial' => [
						'title' => __('no', 'ahura'),
						'icon' => 'fa fa-close'
					],
				],
				'toggle' => true
			]
		);

		$this->add_control(
			'image_height',
			[
				'label' => __( 'Image height', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 700,
				'step' => 10,
				'default' => 300,
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
            'title_section',
            [
                'label' => __('title', 'ahura'),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'show_title',
			[
				'label' => __('Show title', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'no',
				'options' => [
					'yes' => [
						'title' => __('yes', 'ahura'),
						'icon' => 'far fa-check'
					],
					'no' => [
						'title' => __('no', 'ahura'),
						'icon' => 'fa fa-close'
					],
				],
				'toggle' => true
			]
		);

		$this->add_control(
            'img_title_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Image title color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .portfolio .img-title' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'img_title_typography',
                'label' => __('Image title typography', 'ahura'),
				'selector' => '{{WRAPPER}} .portfolio .img-title',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20'
						]
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
	$settings = $this->get_settings_for_display();

	if($settings['list']){
    ?>
	<section class="portfolio text-center animated fadeInUp">
        <div class="container">
			<div class="row justify-content-center">
				<ul class="header d-flex">
					<li class="active" data-class="all"><?php echo $settings['header_all_title']; ?></li>
					<?php foreach ( $settings['list'] as $item ): ?>
					<li class="elementor-repeater-item-<?php echo !empty($item['_id']) ? $item['_id'] : uniqid(); ?>"  data-class="<?php echo md5($item['list_title']) ?>">
                        <?php echo $item['list_title'] ?>
                    </li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="row">
			<?php
			foreach ($settings['list'] as $item) {
                if (empty($item['list_gallery'])){
                    $args = array(
                        'post_type'=> 'attachment',
                        'posts_per_page'=> 8,
                    );
                    $attachments = get_posts($args);
                    if($attachments){
                        foreach ($attachments as $attachment){
                            $item['list_gallery'][] = [
                                    'id' => $attachment->ID,
                                    'url' => wp_get_attachment_url($attachment->ID),
                            ];
                        }
                    }
                }
				foreach ($item['list_gallery'] as $image ) { ?>
                    <div class="col-md-<?php echo $settings['images_col'] ?> images animated" data-class="<?php echo md5($item['list_title']) ?>">
						<a href="<?php echo $image['url'] ?>">
                            <div class="portfolio-box" style="filter: brightness(<?php echo $settings['image_effect'] ?>%);background-size:<?php echo $settings['fit_image'] ?>;height:<?php echo $settings['image_height'] ?>px;width:100%;background-image:url(<?php echo $image['url'] ?>)" ></div>
                        </a>
						<?php if($settings['show_title'] === 'yes') { ?>
                            <span class="img-title"><?php echo get_the_title(attachment_url_to_postid( $image['url'] )) ?></span>
						<?php } ?>
                    </div>
				<?php }
			} 
			?>
			</div>
        </div>
    </section>

	<?php
	}
	
    }

}
