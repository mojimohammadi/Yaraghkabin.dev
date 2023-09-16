<?php

namespace ahura\inc\widgets;

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

use Elementor\Controls_Manager;
use ahura\app\mw_assets;

class blog_box_posts extends \Elementor\Widget_Base
{
    /**
     * blog_box_posts constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('blog_box_posts_css', mw_assets::get_css('elementor.blog_box_posts'));
        if (!is_rtl()) {
            mw_assets::register_style('blog_box_posts_ltr_css', mw_assets::get_css('elementor.ltr.blog_box_posts_ltr'));
        }
    }

    public function get_style_depends()
    {
        $styles = [mw_assets::get_handle_name('blog_box_posts_css')];
        if (!is_rtl()) {
            $styles[] = mw_assets::get_handle_name('blog_box_posts_ltr_css');
        }
        return $styles;
    }

    public function get_name()
    {
        return 'blogbox';
    }

    public function get_title()
    {
        return __('Blog Box', 'ahura');
    }

	public function get_icon() {
		return 'aicon-svg-blog-box-posts-1';
	}

    public function get_categories()
    {
        return ['ahuraelements', 'ahura_posts'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $categories = get_categories();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->term_id] = $category->name;
        }
        $default = key($cats);
        $this->add_control(
            'catsid',
            [
                'label' => __('Categories', 'ahura'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => $cats,
                'multiple' => true,
                'default' => $default
            ]
        );

        $this->add_control(
            'box_title',
            [
                'label' => __('Post box title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_title',
            [
                'label' => __('Button text', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __('Button url', 'ahura'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'date',
            [
                'label' => __('Time', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => ['title' => __('Yes', 'ahura'), 'icon' => 'fa fa-check-circle'],
                    'no' => ['title' => __('No', 'ahura'), 'icon' => 'fa fa-times-circle']
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'author',
            [
                'label' => __('Author', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => ['title' => __('Yes', 'ahura'), 'icon' => 'fa fa-check-circle'],
                    'no' => ['title' => __('No', 'ahura'), 'icon' => 'fa fa-times-circle']
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'comments',
            [
                'label' => __('Comments', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => ['title' => __('Yes', 'ahura'), 'icon' => 'fa fa-check-circle'],
                    'no' => ['title' => __('No', 'ahura'), 'icon' => 'fa fa-times-circle']
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => __('Sort', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'DESC',
                'options' => [
                    'ASC' => [
                        'title' => __('Ascending', 'ahura'),
                        'icon' => 'fa fa-arrow-up'
                    ],
                    'DESC' => [
                        'title' => __('Descending', 'ahura'),
                        'icon' => 'fa fa-arrow-down'
                    ],
                ],
                'toggle' => true
            ]
        );

		$this->add_control(
			'excerpt_chars_count',
			[
				'label'   => __( 'Excerpt Characters', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_cover',
                'default' => 'stthumb',
            ]
        );

        $this->end_controls_section();
        /**
		 * 
		 * 
		 * Styles
		 * 
		 *
		 */
		$this->start_controls_section(
			'content_styles',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'box_img_height',
            [
                'label' => esc_html__('Cover Height', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .postbox2 article img' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#66bb6a'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typo',
                'label' => esc_html__('Post Title Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .postbox2post1 h3',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '18'
                        ]
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ],
                ]
            ]
        );

		$this->end_controls_section();
        $this->start_controls_section(
            'box_button_style',
            [
                'label' => __('Button', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_btns_width',
            [
                'label' => esc_html__('Width', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 45,
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .postbox2 .cat-more-link' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#66bb6a'
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'box_styles',
            [
                'label' => __('Box', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_title_typo',
                'label' => esc_html__('Title Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .postbox2 .cat-name',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '24'
                        ]
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ],
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $catsidd = $settings['catsid'];
        $first_cat_id = $catsidd && is_array($catsidd) ? $catsidd[0] : $catsidd;
        $chars_num = isset($settings['excerpt_chars_count']) && intval($settings['excerpt_chars_count']) ? $settings['excerpt_chars_count'] : false;
        ?>
        <div class="postbox2">
            <div class="row p-0 m-0">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <h2 style="border-right-color:<?php echo $settings['title_color']; ?>;color:<?php echo $settings['title_color']; ?>" class="cat-name">
                    <?php
                    if ($settings['box_title']) {
                        echo $settings['box_title'];
                    } else {
                        echo get_cat_name($first_cat_id);
                    } ?>
                </h2>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <a style="background-color:<?php echo $settings['button_color']; ?>;box-shadow:0 5px 20px <?php echo $settings['button_color']; ?>80" class="cat-more-link"
                href="<?php
                if ($settings['button_url']['url']) {
                    echo $settings['button_url']['url'];
                } else {
                    echo get_category_link($first_cat_id);
                } ?>"><?php
                    if ($settings['button_title']) {
                        echo $settings['button_title'];
                    } else {
                        echo __('Show All', 'ahura');
                    } ?>
                </a>
                </div>
            </div>
            <?php $postbox2one = new \WP_Query(array(
                'posts_per_page' => 1,
                'cat' => $settings['catsid'],
                'order' => $settings['post_order']
            ));
        if ($postbox2one->have_posts()) : ?>
                <div class="clear"></div>
                <div class="postbox2post1 row">
                    <?php while ($postbox2one->have_posts()) : $postbox2one->the_post(); ?>
                        <div class="col-md-12">
                            <article>
                                <a class="fimage"
                                   href="<?php the_permalink(); ?>"><?php the_post_thumbnail($settings['item_cover_size']); ?></a>
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></h3></a>
                                <ul class="post-meta">
                                    <?php if ($settings['date'] == 'yes') : ?>
                                        <li><i class="fa fa-clock"></i> <?php echo get_the_date('d F Y'); ?></li>
                                    <?php endif; ?>
                                    <?php if ($settings['author'] == 'yes') : ?>
                                        <li><i class="fa fa-user"></i> <?php the_author(); ?></li>
                                    <?php endif; ?>
                                    <?php if ($settings['comments'] == 'yes') : ?>
                                        <li><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%');
        __('Comments', 'ahura'); ?></li>
                                    <?php endif; ?>
                                </ul>
                                <?php 
									if($chars_num){
                                        echo '<p>' . wp_trim_words(get_the_excerpt(), $chars_num, '...') . '</p>';
									} else {
										the_excerpt();
									}
								?>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php $postbox2more = new \WP_Query(array(
                'offset' => 1,
                'posts_per_page' => 3,
                'cat' => $settings['catsid'],
            ));
        if ($postbox2more->have_posts()) : ?>
                <div class="postbox2post2 row">
                    <?php while ($postbox2more->have_posts()) : $postbox2more->the_post(); ?>
                        <div class="col-md-4">
                            <article>
                                <a class="fimage"
                                   href="<?php the_permalink(); ?>"><?php the_post_thumbnail($settings['item_cover_size']); ?></a>
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h4></a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
    }
}
