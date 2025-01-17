<?php
namespace Elementor;
namespace BLACK_WIDGETS_Modernaweb\Includes\Widgets;
namespace Black_Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Color;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

/**
 * Elementor title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class BLACK_WIDGETS_Box extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'b_box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Black Box', 'blackwidgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'black_widgets' ];
	}

	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Start
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Select type of the title
		$this->add_control(
			'widget_type',
			[
				'label' => __( 'Select Type', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bw-style-1',
				'options' => [
					'bw-style-1' => __( 'Type 1', 'blackwidgets' ),
					'bw-style-2' => __( 'Type 2', 'blackwidgets' ),
				],
				'description' => __( 'We created some skin before, you can use these or no! make a new custom type.', 'blackwidgets' ),
			]
		);

		$this->add_control(
			'divider_0',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Link?
		$this->add_control(
			'box_link',
			[
				'label' => __( 'Box Link', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => __( 'No', 'blackwidgets' ),
					'yes' => __( 'Yes', 'blackwidgets' ),
                ],
			]
		);

		$this->add_control(
			'box_link_url',
			[
				'label' => __( 'Link', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'blackwidgets' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
                ],
				'condition'  => [
					'box_link' => [
						'yes',
					],
				],
			]
        );

		$this->add_control(
			'divider_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'full',
			]
        );

		$this->add_control(
			'divider_2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Type title
		$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Clean & Solid', 'blackwidgets' ),
				'placeholder' => __( 'Type your title here', 'blackwidgets' ),
				'description' => __( 'You can use all other HTML tags into the title field e.g. code, mark, abbr, blockquote and  ...', 'blackwidgets' ),
			]
		);

		// Select tag
		$this->add_control(
			'widget_html_tag_title',
			[
				'label' => __( 'HTML Tag', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'div' => __( 'div', 'blackwidgets' ),
					'h1' => __( 'H1', 'blackwidgets' ),
					'h2' => __( 'H2', 'blackwidgets' ),
					'h3' => __( 'H3', 'blackwidgets' ),
					'h4' => __( 'H4', 'blackwidgets' ),
					'h5' => __( 'H5', 'blackwidgets' ),
					'h6' => __( 'H6', 'blackwidgets' ),
					'p' => __( 'p', 'blackwidgets' ),
					'span' => __( 'span', 'blackwidgets' ),
				],
				'description' => __( 'Choose an HTML tag, it can help you to SEO and beautifully of the UI design with follow the structure of your website.', 'blackwidgets' ),
			]
		);

		$this->add_control(
			'divider_3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Type subtitle
		$this->add_control(
			'widget_subtitle',
			[
				'label' => __( 'Subtitle', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'blackwidgets' ),
				'default' => __( 'Development, Design, and E-Commerce', 'blackwidgets' ),
				'description' => __( 'You can use all other HTML tags into the title field e.g. code, mark, abbr, blockquote and  ...', 'blackwidgets' ),
			]
		);

		// Select tag
		$this->add_control(
			'widget_html_tag_subtitle',
			[
				'label' => __( 'HTML Tag', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'p',
				'options' => [
					'div' => __( 'div', 'blackwidgets' ),
					'h1' => __( 'H1', 'blackwidgets' ),
					'h2' => __( 'H2', 'blackwidgets' ),
					'h3' => __( 'H3', 'blackwidgets' ),
					'h4' => __( 'H4', 'blackwidgets' ),
					'h5' => __( 'H5', 'blackwidgets' ),
					'h6' => __( 'H6', 'blackwidgets' ),
					'p' => __( 'p', 'blackwidgets' ),
					'span' => __( 'span', 'blackwidgets' ),
				],
				'description' => __( 'Choose an HTML tag, it can help you to SEO and beautifully of the UI design with follow the structure of your website.', 'blackwidgets' ),
			]
		);

		$this->add_control(
			'divider_4',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Alignment
		$this->add_responsive_control(
			'widget_alignment',
			[
				'label'     => __( 'Text Alignment', 'blackwidgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'blackwidgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'blackwidgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'blackwidgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'condition'  => [
					'widget_type' => [
						'bw-style-1',
					],
				],
			]
		);

		$this->end_controls_section();
		// End

		// Start
		// Style section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Box Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Style Subtitle Tabs
		$this->start_controls_tabs('black_widget_1_tab');
		$this->start_controls_tab(
			'tab_1_normal',
			[
				'label' => __( 'Normal', 'blackwidgets' ),
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'widget_box_background',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-hover-box',
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'widget_box_margin',
			[
				'label' => __( 'Margin', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'widget_box_padding',
			[
				'label' => __( 'Padding', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'widget_box_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box',
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'widget_box_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box',
			]
		);

		$this->add_responsive_control(
			'widget_box_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_1_hover',
			[
				'label' => __( 'Hover', 'blackwidgets' ),
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'widget_hover_box_background',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .bw-hover-box:hover',
			]
		);

		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'widget_hover_box_margin',
			[
				'label' => __( 'Margin', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'widget_hover_box_padding',
			[
				'label' => __( 'Padding', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr4',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'widget_hover_box_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box:hover',
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'widget_hover_box_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box:hover',
			]
		);

		$this->add_responsive_control(
			'widget_hover_box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->end_controls_section();


		// Start
		// Style section
		$this->start_controls_section(
			'transform_section',
			[
				'label' => __( '2D & 3D Normal Transfrom Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Enable Image Movement Animate
		$this->add_control(
			'transform_normal_option',
			[
				'label' 		=> __( 'Transfrom Style', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Enable', 'blackwidgets' ),
				'label_off' 	=> __( 'Disable', 'blackwidgets' ),
				'return_value' 	=> 'normal_transform',
				'default' 		=> 'off',
			]
		);

		// Style Subtitle Tabs
		$this->start_controls_tabs('transform_tabs', [
			'condition' 	=> [
				'transform_normal_option' 	=> [
					'normal_transform',
				],
			],
		]);
		$this->start_controls_tab(
			'transform_tab_move',
			[
				'label' => __( 'Move', 'blackwidgets' ),
			]
		);

		// Start normal tab content

		$this->add_responsive_control(
			'move_normal_x',
			[
				'label' => __( 'Move on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram X - do not leave empty!', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'move_normal_y',
			[
				'label' => __( 'Move on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram Y - do not leave empty!', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'move_normal_z',
			[
				'label' => __( 'Move on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram Z - do not leave empty!', 'blackwidgets' ),
			]
		);

		// end normal tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_scale',
			[
				'label' => __( 'Scale', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'scale_normal_x',
			[
				'label' => __( 'Scale on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'set 1.1 to scale on left and right - do not set 0', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'scale_normal_y',
			[
				'label' => __( 'Scale on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'set 1.1 to scale on top and bottom - do not set 0', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'scale_normal_z',
			[
				'label' => __( 'Scale on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'perspective',
			[
				'label' => __( 'Self Perspective ◊', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ps' ],
				'range' => [
					'px' => [
						'min' => -3000,
						'max' => 3000,
						'step' => 50,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'perspective_child',
			[
				'label' => __( 'Children Perspective ◊', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ps' ],
				'range' => [
					'px' => [
						'min' => -3000,
						'max' => 3000,
						'step' => 50,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_rotate',
			[
				'label' => __( 'Rotate', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'rotate_normal_x',
			[
				'label' => __( 'Rotate on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'rotate_normal_y',
			[
				'label' => __( 'Rotate on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'rotate_normal_z',
			[
				'label' => __( 'Rotate on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_skew',
			[
				'label' => __( 'Skew', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'skew_normal_x',
			[
				'label' => __( 'Skew on → X ▱', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'skew_normal_y',
			[
				'label' => __( 'Skew on ↑ Y ▱', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->end_controls_section();
		// End


		// Start
		// Style section
		$this->start_controls_section(
			'image_pro_cursor_animate',
			[
				'label' => __( 'Cursor & Hover Animate', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Select type of the title
		$this->add_control(
			'widget_cursor',
			[
				'label' => __( 'Select Cursor Style', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'auto' 			=> __( 'auto', 'blackwidgets' ),
					'default' 		=> __( 'default', 'blackwidgets' ),
					'none' 			=> __( 'none', 'blackwidgets' ),
					'pointer' 		=> __( 'pointer', 'blackwidgets' ),
					'not-Allowed' 	=> __( 'not-Allowed', 'blackwidgets' ),
					'wait' 			=> __( 'wait', 'blackwidgets' ),
					'progress' 		=> __( 'progress', 'blackwidgets' ),
					'help' 			=> __( 'help', 'blackwidgets' ),
					'context-menu' 	=> __( 'context-menu', 'blackwidgets' ),
					'cell' 			=> __( 'cell', 'blackwidgets' ),
					'crosshair' 	=> __( 'crosshair', 'blackwidgets' ),
					'text' 			=> __( 'text', 'blackwidgets' ),
					'wetical-text' 	=> __( 'wetical-text', 'blackwidgets' ),
					'grab' 			=> __( 'grab', 'blackwidgets' ),
					'grabbing' 		=> __( 'grabbing', 'blackwidgets' ),
					'alias' 		=> __( 'alias', 'blackwidgets' ),
					'copy' 			=> __( 'copy', 'blackwidgets' ),
					'move' 			=> __( 'move', 'blackwidgets' ),
					'zoom-in'		=> __( 'zoom-in', 'blackwidgets' ),
					'zoom-out' 		=> __( 'zoom-out', 'blackwidgets' ),
					'col-resize' 	=> __( 'col-resize', 'blackwidgets' ),
					'row-resize' 	=> __( 'row-resize', 'blackwidgets' ),
					'nesw-resize' 	=> __( 'nesw-resize', 'blackwidgets' ),
					'newse-resize' 	=> __( 'newse-resize', 'blackwidgets' ),
					'ew-resize' 	=> __( 'ew-resize', 'blackwidgets' ),
					'ns-resize' 	=> __( 'ns-resize', 'blackwidgets' ),
					'n-resize' 		=> __( 'n-resize', 'blackwidgets' ),
					'w-resize' 		=> __( 'w-resize', 'blackwidgets' ),
					's-resize' 		=> __( 's-resize', 'blackwidgets' ),
					'e-resize' 		=> __( 'e-resize', 'blackwidgets' ),
					'nw-resize' 	=> __( 'nw-resize', 'blackwidgets' ),
					'ne-resize' 	=> __( 'ne-resize', 'blackwidgets' ),
					'sw-resize' 	=> __( 'sw-resize', 'blackwidgets' ),
					'se-resize'		=> __( 'se-resize', 'blackwidgets' ),
				],
				'description' => __( 'It just work with scroll down and does not work on first section. it works once', 'blackwidgets' ),
			]
		);

		$this->add_control(
			'image_pro_anime',
			[
				'label' => __( 'Type Custom Animate', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'all 0.23s ease', 'blackwidgets' ),
			]
		);

		$this->end_controls_section();
		// End


		// Start
		// Style section
		$this->start_controls_section(
			'transform_section_hover',
			[
				'label' => __( '2D & 3D Hover Transfrom Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Enable Image Movement Animate
		$this->add_control(
			'transform_hover_option',
			[
				'label' 		=> __( 'Transfrom Style', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Enable', 'blackwidgets' ),
				'label_off' 	=> __( 'Disable', 'blackwidgets' ),
				'return_value' 	=> 'hover_transform',
				'default' 		=> 'off',
			]
		);

		// Style Subtitle Tabs
		$this->start_controls_tabs('transform_hover_tabs', [
			'condition' 	=> [
				'transform_hover_option' 	=> [
					'hover_transform',
				],
			],
		]);
		$this->start_controls_tab(
			'transform_tab_move_hover',
			[
				'label' => __( 'Move', 'blackwidgets' ),
			]
		);

		// Start normal tab content

		$this->add_responsive_control(
			'move_hover_x',
			[
				'label' => __( 'Move on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram X - do not leave empty!', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'move_hover_y',
			[
				'label' => __( 'Move on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram Y - do not leave empty!', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'move_hover_z',
			[
				'label' => __( 'Move on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'movement on the diagram Z - do not leave empty!', 'blackwidgets' ),
			]
		);

		// end normal tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_scale_hover',
			[
				'label' => __( 'Scale', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'scale_hover_x',
			[
				'label' => __( 'Scale on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'set 1.1 to scale on left and right - do not set 0', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'scale_hover_y',
			[
				'label' => __( 'Scale on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'set 1.1 to scale on top and bottom - do not set 0', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'scale_hover_z',
			[
				'label' => __( 'Scale on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 1,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'perspective_hover',
			[
				'label' => __( 'Self Perspective ◊', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ps' ],
				'range' => [
					'px' => [
						'min' => -3000,
						'max' => 3000,
						'step' => 50,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		$this->add_responsive_control(
			'perspective_child_hover',
			[
				'label' => __( 'Children Perspective ◊', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ps' ],
				'range' => [
					'px' => [
						'min' => -3000,
						'max' => 3000,
						'step' => 50,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'If you want to use scale Z or 3D Scale, you should set perspective size', 'blackwidgets' ),
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_rotate_hover',
			[
				'label' => __( 'Rotate', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'rotate_hover_x',
			[
				'label' => __( 'Rotate on → X', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'rotate_hover_y',
			[
				'label' => __( 'Rotate on ↑ Y', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'rotate_hover_z',
			[
				'label' => __( 'Rotate on ↙ Z', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->start_controls_tab(
			'transform_tab_skew_hover',
			[
				'label' => __( 'Skew', 'blackwidgets' ),
			]
		);

		// Start hover tab content

		$this->add_responsive_control(
			'skew_hover_x',
			[
				'label' => __( 'Skew on → X ▱', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		$this->add_responsive_control(
			'skew_hover_y',
			[
				'label' => __( 'Skew on ↑ Y ▱', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default'  => [
					'unit' => 'deg',
					'size' => 0,
				]
			]
		);

		// end hover tab content

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->end_controls_section();
		// End


		// Start
		// Style section
		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Style Subtitle Tabs
		$this->start_controls_tabs('black_widget_2_tab');
		$this->start_controls_tab(
			'img_tab_1_normal',
			[
				'label' => __( 'Normal', 'blackwidgets' ),
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_style_background',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image',
			]
		);

		$this->add_control(
			'hr5',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'image_style_margin',
			[
				'label' => __( 'Margin', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'image_style_padding',
			[
				'label' => __( 'Padding', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr6',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_style_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image',
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_style_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image',
			]
		);

		$this->add_control(
			'image_style_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filter',
				'selector' => 
					'{{WRAPPER}} .bw-hover-box .bw-featured-image'
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'img_tab_1_hover',
			[
				'label' => __( 'Hover', 'blackwidgets' ),
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_style_hover_box_background',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image:hover',
			]
		);

		$this->add_control(
			'hr7',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'image_style_hover_box_margin',
			[
				'label' => __( 'Margin', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'image_style_hover_box_padding',
			[
				'label' => __( 'Padding', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr8',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_style_hover_box_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image:hover',
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_style_hover_box_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-hover-box .bw-featured-image:hover',
			]
		);

		$this->add_control(
			'image_style_hover_box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-hover-box .bw-featured-image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filter_hover',
				'selector' => 
					'{{WRAPPER}} .bw-hover-box .bw-featured-image:hover'
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'elementor-animation-',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->end_controls_section();
		// End
		// Start
		// Style section
		$this->start_controls_section(
			'style2_link_section',
			[
				'label' => __( 'Overlay Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'  => [
					'widget_type' => [
						'bw-style-2',
					],
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg_color',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .bw-hover-box.bw-style-2 a:after',
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg_hover_color',
				'label' => __( 'Background Hover', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .bw-hover-box.bw-style-2 a:hover:after',
			]
		);

		$this->end_controls_section();
		// End












	}

	/**
	 * Render title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings   	= $this->get_settings_for_display();

		// Transform Option
		$normal_transform			= isset($settings['transform_normal_option'])			? $settings['transform_normal_option']				: '';
		$hover_transform			= isset($settings['transform_hover_option'])			? $settings['transform_hover_option']				: '';
		//Transform Styles
		$move_normal_x				= isset($settings['move_normal_x'])						? $settings['move_normal_x']						: '0px';
		$move_normal_y				= isset($settings['move_normal_y'])						? $settings['move_normal_y']						: '0px';
		$move_normal_z				= isset($settings['move_normal_z'])						? $settings['move_normal_z']						: '0px';
		$scale_normal_x				= isset($settings['scale_normal_x'])					? $settings['scale_normal_x']						: '1';
		$scale_normal_y				= isset($settings['scale_normal_y'])					? $settings['scale_normal_y']						: '1';
		$scale_normal_z				= isset($settings['scale_normal_z'])					? $settings['scale_normal_z']						: '1';
		$rotate_normal_x			= isset($settings['rotate_normal_x'])					? $settings['rotate_normal_x']						: '0deg';
		$rotate_normal_y			= isset($settings['rotate_normal_y'])					? $settings['rotate_normal_y']						: '0deg';
		$rotate_normal_z			= isset($settings['rotate_normal_z'])					? $settings['rotate_normal_z']						: '0deg';
		$skew_normal_x				= isset($settings['skew_normal_x'])						? $settings['skew_normal_x']						: '0deg';
		$skew_normal_y				= isset($settings['skew_normal_y'])						? $settings['skew_normal_y']						: '0deg';
		$perspective				= isset($settings['perspective'])						? $settings['perspective']							: '0px';
		$perspective_child			= isset($settings['perspective_child'])					? $settings['perspective_child']					: '0px';
		// Cursor and Animate
		$cursor						= isset($settings['widget_cursor'])						? $settings['widget_cursor']						: 'auto';
		$animate					= isset($settings['image_pro_anime'])					? $settings['image_pro_anime']						: 'all 0.3s ease';
		//Transform Styles	
		$move_hover_x				= isset($settings['move_hover_x'])						? $settings['move_hover_x']							: '0px';
		$move_hover_y				= isset($settings['move_hover_y'])						? $settings['move_hover_y']							: '0px';
		$move_hover_z				= isset($settings['move_hover_z'])						? $settings['move_hover_z']							: '0px';
		$scale_hover_x				= isset($settings['scale_hover_x'])						? $settings['scale_hover_x']						: '1';
		$scale_hover_y				= isset($settings['scale_hover_y'])						? $settings['scale_hover_y']						: '1';
		$scale_hover_z				= isset($settings['scale_hover_z'])						? $settings['scale_hover_z']						: '1';
		$rotate_hover_x				= isset($settings['rotate_hover_x'])					? $settings['rotate_hover_x']						: '0deg';
		$rotate_hover_y				= isset($settings['rotate_hover_y'])					? $settings['rotate_hover_y']						: '0deg';
		$rotate_hover_z				= isset($settings['rotate_hover_z'])					? $settings['rotate_hover_z']						: '0deg';
		$skew_hover_x				= isset($settings['skew_hover_x'])						? $settings['skew_hover_x']							: '0deg';
		$skew_hover_y				= isset($settings['skew_hover_y'])						? $settings['skew_hover_y']							: '0deg';
		$perspective_hover			= isset($settings['perspective_hover'])					? $settings['perspective_hover']					: '0px';
		$perspective_child_hover	= isset($settings['perspective_child_hover'])			? $settings['perspective_child_hover']				: '0px';
		//ID Settings
		$data_id                	= 'bw_' . uniqid();
		//Transform Normal Styles 
		// Normal Move 
		$translatex 				= isset( $move_normal_x["size"] ) 						? $move_normal_x["size"] . $move_normal_x["unit"] : '';
		$translatey 				= isset( $move_normal_y["size"] ) 						? $move_normal_y["size"] . $move_normal_y["unit"] : '';
		$translatez 				= isset( $move_normal_z["size"] ) 						? $move_normal_z["size"] . $move_normal_z["unit"] : '';
		$translate3d 				= 'translate3d(' . $translatex . ', ' . $translatey . ', ' . $translatez . ')';
		// Normal Scale 
		$scalex 					= isset( $scale_normal_x["size"] ) 						? $scale_normal_x["size"] : '';
		$scaley 					= isset( $scale_normal_y["size"] ) 						? $scale_normal_y["size"] : '';
		$scalez 					= isset( $scale_normal_z["size"] ) 						? $scale_normal_z["size"] : '';
		$scale3dx 					= isset( $scale_normal_z["size"] ) 						? '-webkit-transform-style: preserve-3d; transform-style: preserve-3d;' : '';
		$scale3d 					= 'scale3d(' . $scalex . ', ' . $scaley . ', ' . $scalez . ')';
		// Normal Rotate
		$rotatex 					= isset( $rotate_normal_x["size"] ) 					? 'rotateX(' . $rotate_normal_x["size"] . $rotate_normal_x["unit"] . ')' : '';
		$rotatey 					= isset( $rotate_normal_y["size"] ) 					? 'rotateY(' . $rotate_normal_y["size"] . $rotate_normal_y["unit"] . ')' : '';
		$rotatez 					= isset( $rotate_normal_z["size"] ) 					? 'rotateZ(' . $rotate_normal_z["size"] . $rotate_normal_z["unit"] . ')' : '';
		// Normal Skew
		$skewx 						= isset( $skew_normal_x["size"] ) 						? $skew_normal_x["size"] . $skew_normal_x["unit"] : '';
		$skewy 						= isset( $skew_normal_y["size"] ) 						? $skew_normal_y["size"] . $skew_normal_y["unit"] : '';
		$skew 						= 'skew(' . $skewx . ', ' . $skewy . ')';
		// Normal Self perspective
		$perspective 				=  isset( $perspective["size"] ) 						? 'perspective:' . $perspective["size"] . $perspective["unit"] . '; -webkit-perspective:' . $perspective["size"] . $perspective["unit"] . ';': '';
		// Normal Child perspective
		$perspective_child 			=  isset( $perspective_child["size"] ) 					? 'perspective(' . $perspective_child["size"] . $perspective_child["unit"] . ')': '';
		//Transform Hover Styles 
		//Hover Move
		$translatex_hover			= isset( $move_hover_x["size"] ) 						? $move_hover_x["size"] . $move_hover_x["unit"] : '';
		$translatey_hover			= isset( $move_hover_y["size"] ) 						? $move_hover_y["size"] . $move_hover_y["unit"] : '';
		$translatez_hover			= isset( $move_hover_z["size"] ) 						? $move_hover_z["size"] . $move_hover_z["unit"] : '';
		$translate3d_hover			= 'translate3d(' . $translatex_hover . ', ' . $translatey_hover . ', ' . $translatez_hover . ')';
		// Hover Scale
		$scalex_hover 				= isset( $scale_hover_x["size"] ) 						? $scale_hover_x["size"] : '';
		$scaley_hover 				= isset( $scale_hover_y["size"] ) 						? $scale_hover_y["size"] : '';
		$scalez_hover 				= isset( $scale_hover_z["size"] ) 						? $scale_hover_z["size"] : '';
		$scale3dx_hover 			= isset( $scale_hover_z["size"] ) 						?'-webkit-transform-style: preserve-3d; transform-style: preserve-3d;' : '';
		$scale3d_hover 				= 'scale3d(' . $scalex_hover . ', ' . $scaley_hover . ', ' . $scalez_hover . ')';
		// Hover Rotate
		$rotatex_hover 				= isset( $rotate_hover_x["size"] ) 						? 'rotateX(' . $rotate_hover_x["size"] . $rotate_hover_x["unit"] . ')' : '';
		$rotatey_hover 				= isset( $rotate_hover_y["size"] ) 						? 'rotateY(' . $rotate_hover_y["size"] . $rotate_hover_y["unit"] . ')' : '';
		$rotatez_hover 				= isset( $rotate_hover_z["size"] ) 						? 'rotateZ(' . $rotate_hover_z["size"] . $rotate_hover_z["unit"] . ')' : '';
		// Hover Skew
		$skewx_hover 				= isset( $skew_hover_x["size"] ) 						? $skew_hover_x["size"] . $skew_hover_x["unit"] : '';
		$skewy_hover 				= isset( $skew_hover_y["size"] ) 						? $skew_hover_y["size"] . $skew_hover_y["unit"] : '';
		$skew_hover 				= 'skew(' . $skewx_hover . ', ' . $skewy_hover . ')';
		// Hover Self perspective
		$perspective_hover 			= isset( $perspective_hover["size"] ) 					? 'perspective:' . $perspective_hover["size"] . $perspective_hover["unit"] . '; -webkit-perspective:' . $perspective_hover["size"] . $perspective_hover["unit"] . ';' : '';
		// Hover Child perspective
		$perspective_child_hover	= isset( $perspective_child_hover["size"] ) 			? 'perspective(' . $perspective_child_hover["size"] . $perspective_child_hover["unit"] . ')' : '';
		// Create a Custom CSS for Normal and Hover Styles
		$normal_transform_style 	= ($normal_transform == 'normal_transform') 			? "#$data_id { -webkit-transition: $animate; -o-transition: $animate; transition: $animate; $perspective transform: $perspective_child $skew $rotatex $rotatey $rotatez $scale3d $translate3d; -webkit-transform: $perspective_child $skew $rotatex $rotatey $rotatez $scale3d $translate3d; $scale3dx }" : '';
		$hover_transform_style 		= ($hover_transform == 'hover_transform') 				? "#$data_id:hover { $perspective_hover transform: $perspective_child_hover $skew_hover $rotatex_hover $rotatey_hover $rotatez_hover $scale3d_hover $translate3d_hover; -webkit-transform: $perspective_child_hover $skew_hover $rotatex_hover $rotatey_hover $rotatez_hover $scale3d_hover $translate3d_hover; $scale3dx_hover }" : '';
		//Return all of the styles
		echo "<style> $normal_transform_style $hover_transform_style</style>";

		// Variables
		$type 			= isset($settings['widget_type']) 									? $settings['widget_type'] 												: '';
		$alignment 		= isset($settings['widget_alignment']) 								? $settings['widget_alignment'] 										: '';
		$title 			= isset($settings['widget_title']) 									? $settings['widget_title'] 											: '';
		$subtitle 		= isset($settings['widget_subtitle']) 								? $settings['widget_subtitle'] 											: '';
		$title_tag 		= isset($settings['widget_html_tag_title']) 						? $settings['widget_html_tag_title'] 									: '';
		$subtitle_tag   = isset($settings['widget_html_tag_subtitle']) 						? $settings['widget_html_tag_subtitle'] 								: '';
        $image_URL		= isset( $settings['image']['url']) 								? $settings['image']['url'] 											: '';
		$box_link		= isset($settings['box_link']) 										? $settings['box_link'] 												: '';
		// $img_url		= isset($settings['image_link_url'])								? $settings['image_link_url']											: '';
		$target			= isset($settings['image_link_url']['is_external']) 				? 'target="_blank"' 													: '';
        $nofollow		= isset($settings['image_link_url']['nofollow']) 					? ' rel="nofollow"' 													: '';



		
		// Render
		if ( $type == 'bw-style-1' ) {
			echo '<div class="bw-hover-box bw-cursor-' . $cursor .' ' . $type . '" id="'. $data_id .'">';
				if ( isset($box_link) && $box_link == 'yes' ) { echo '<a href="' . $settings['box_link_url']['url'] . '"' . $target . $nofollow . ' class="bw-image-link">'; }
					echo '<div class="bw-featured-image bw-hover-1">';
							echo '<img src="' . Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'thumbnail', $settings ) . '" class="bw-img-tag bw-cursor-' . $cursor .' ' . $settings['hover_animation'] . '">';
					echo '</div>';
					echo '<div class="bw-content-box bw-' . $alignment . '">';
						echo '<' . $title_tag . ' class="bw-title">' . $title . '</' . $title_tag . '>';
						echo '<' . $subtitle_tag . ' class="bw-description"> ' . $subtitle . '</' . $subtitle_tag . '>';
					echo '</div>';
				if ( isset($box_link) && $box_link == 'yes' ){ echo '</a>'; }
			echo '</div>';
		} else if ( $type == 'bw-style-2' ) {
			echo '<div class="bw-hover-box bw-cursor-' . $cursor .' ' . $type . '" id="'. $data_id .'">';
			// echo '<div class="mw-portfolio-img">';
				// echo '<a href="https://modernaweb.net/dsgn/" target="_blank" class="mw-portfolio-link">';
		if ( isset($box_link) && $box_link == 'yes') { echo '<a href="' . $settings['box_link_url']['url'] . '"' . $target . $nofollow . ' class="bw-hero">'; }
				// echo '<img src="https://res.cloudinary.com/modernaweb/images/f_auto,q_auto/v1616775327/portfolio-desgn/portfolio-desgn.png" class="mw-portfolio-hero">';
					echo '<img src="' . Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'thumbnail', $settings ) . '" class="bw-img-tag bw-cursor-' . $cursor .' ' . $settings['hover_animation'] . '">';
					echo '<div class="bw-title-box">';
						echo '<span class="bw-typography">';
							echo '<' . $title_tag . ' class="bw-title">' . $title . '</' . $title_tag . '>';
							echo '<' . $subtitle_tag . ' class="bw-description"> ' . $subtitle . '</' . $subtitle_tag . '>';
						echo '</span>';
					echo '</div>';
		if ( isset($box_link) && $box_link == 'yes' ){ echo '</a>'; }
				// echo '</a>';
			echo '</div>';
		} else if ( $type == 'bw-style-6' ) {

		} else {
			echo '';
		}




	}

}