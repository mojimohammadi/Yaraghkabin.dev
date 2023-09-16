<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');


class suggestion_posts extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'suggestion';
    }

    public function get_title()
    {
        return __('Suggestion Posts', 'ahura');
    }

    public function get_icon()
    {
        return 'aicon-svg-suggestion-posts';
    }

    public function get_categories()
    {
        return ['ahuraelements'];
    }
    function get_keywords()
    {
        return ['suggestion_posts', 'suggestionposts', esc_html__( 'Suggestion Posts' , 'ahura')];
    }
    function __construct($data=[], $args=null)
    {
        parent::__construct($data, $args);
        $suggestion_posts_css = mw_assets::get_css('elementor.suggestion_posts');
        mw_assets::register_style('suggestion_posts', $suggestion_posts_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('suggestion_posts')];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $categories = get_categories();
        $cats       = array();
        foreach ($categories as $category) {
            $cats[$category->term_id] = $category->name;
        }
        $default = key($cats);
        $this->add_control(
            'catsid',
            [
                'label'    => __('Categories', 'ahura'),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'options'  => $cats,
                'label_block' => true,
                'multiple' => false,
                'default' => $default
            ]
        );

        $this->add_control(
			'post_target',
			[
				'label'   => __( 'Open in new window', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'_blank' => [
						'title' => __( 'Yes', 'ahura' ),
						'icon'  => 'fa fa-check-circle'
					],
					'_self'  => [
						'title' => __( 'No', 'ahura' ),
						'icon'  => 'fa fa-times-circle'
					]
				],
				'default' => '_self',
                'toggle' => false,
			]
		);

        $this->add_control(
			'postcount',
			[
				'label'      => __( 'Number of posts', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 6
			]
		);

        $this->add_control(
            'postorder',
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
			'post_title_color',
			[
				'label'      => __( 'Title Color', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
				[
					'{{WRAPPER}} .suggestion-posts .suggestion-posts-item span' => 'color: {{VALUE}}'
				]
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'post_title_typoghrapghy',
				'label' => __("Title Typography","ahura"),
				'selector' => '{{WRAPPER}} .suggestion-posts .suggestion-posts-item span',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_cover',
                'default' => 'smthumb',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <div class="suggestion-posts">
            <?php $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['postcount'],
                'cat' => $settings['catsid'],
                'order' => $settings['postorder']
            ));
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
            ?>
                <a target="<?php echo $settings['post_target']; ?>" href="<?php the_permalink()?>" class="suggestion-posts-item">
                    <?php the_post_thumbnail($settings['item_cover_size']);?>
                    <span><?php the_title();?></span>
                </a>
            <?php
                endwhile;
            endif;
            ?>
        </div>

<?php
    }
}
