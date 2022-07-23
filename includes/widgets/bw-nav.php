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

/**
 * Elementor title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class BLACK_WIDGETS_Nav extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve nav widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'b_nav';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve nav widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Black Flat Nav', 'blackwidgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve nav widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the nav widget belongs to.
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
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Register link widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Start
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'             => __( 'Select Menu', 'blackwidgets' ),
					'type'              => Controls_Manager::SELECT,
					'options'           => $menus,
					'default'           => array_keys( $menus )[0],
					'save_default'      => true,
					'description'       => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus; The menu should be flat', 'blackwidgets' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'              => Controls_Manager::RAW_HTML,
					'raw'               => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'blackwidgets' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes'   => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		// Select type of the title
		$this->add_control(
			'custom_nav_styles',
			[
				'label' => __( 'Select Type', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style0',
				'options' => [
					'style0'        => __( 'Style 0', 'blackwidgets' ),
					'style1'        => __( 'Style 1', 'blackwidgets' ),
					'style2'		=> __( 'Style 2', 'blackwidgets' ),
					'style3'        => __( 'Style 3', 'blackwidgets' ),
					'style4'        => __( 'Style 4 ', 'blackwidgets' ),
					'style5'        => __( 'Style 5 ', 'blackwidgets' ),
					'style6'        => __( 'Style 6 ', 'blackwidgets' ),
					'style7'        => __( 'Style 7 ', 'blackwidgets' ),
					'style8'        => __( 'Style 8 ', 'blackwidgets' ),
				],
			]
		);

		// $this->add_control(
		// 	'custom_icon_before_nav',
		// 	[
		// 		'label' => __( 'Icon Before Links', 'blackwidgets' ),
		// 		'type' => Controls_Manager::ICONS,
		// 		'default' => [
		// 			'value' => 'eicon eicon-nerd',
		// 			'library' => 'elementor',
		// 		],
		// 	]
		// );


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
				'toggle'    => true,
                'default'   => 'left',
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

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'widget_box_background',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-menu-box',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'widget_box_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-menu-box',
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'widget_box_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-menu-box',
			]
		);

		$this->add_control(
			'widget_box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-menu-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .bw-menu-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .bw-menu-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        // End

		// Start
		// Style section
		$this->start_controls_section(
			'typography1_section',
			[
				'label' => __( 'Link Typography', 'blackwidgets' ),
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

		// Color
		$this->add_control(
			'widget_link_solid_color',
			[
				'label' => __( 'Link Text Color', 'blackwidgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bw-menu-box li a' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography1',
				'label' => __( 'Typography', 'blackwidgets' ),
				// 'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-menu-box li a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_1_hover',
			[
				'label' => __( 'Hover', 'blackwidgets' ),
			]
		);

		// Color
		$this->add_control(
			'widget_link_hover_solid_color',
			[
				'label' => __( 'Link Text Color', 'blackwidgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bw-menu-box li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_hover_typography1',
				'label' => __( 'Typography', 'blackwidgets' ),
				// 'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-menu-box li a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs		

		$this->end_controls_section();
		// End



		// Start
		// Style section
		$this->start_controls_section(
			'shape1_section',
			[
				'label' => __( 'Shape Styles', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'  => [
					'custom_nav_styles' => [
						'style0',
						'style1',
						'style2',
						'style4',
						'style6',
					],
				],
			]
		);

		// Color
		$this->add_control(
			'widget_shape1_solid_color',
			[
				'label' => __( 'Shape 1 Color', 'blackwidgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bw-menu-box li a' => 'background-image: linear-gradient( 180deg , transparent 90%, {{VALUE}} 0);',
				],
				'condition'  => [
					'custom_nav_styles' => [
						'style1',
					],
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'widget_shape_background_hover',
				'label' => __( 'Background', 'blackwidgets' ),
				'types' => [ 'classic', 'gradient' ],
				'condition'  => [
					'custom_nav_styles' => [
						'style0',
						'style2',
						'style4',
						'style6',
					],
				],
				'selector' => '{{WRAPPER}} .bw-nav.style0 a:after,
                               {{WRAPPER}} .bw-nav.style2 a:before,
                               {{WRAPPER}} .bw-nav.style4 a:before,
                               {{WRAPPER}} .bw-nav.style6 a:hover:before',
			]
		);	

		$this->end_controls_section();
		// End

		// Start
		// Style section
		$this->start_controls_section(
			'shape2_section',
			[
				'label' => __( 'Shape Styles', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'  => [
					'custom_nav_styles' => [
						'style3',
					],
				],
			]
		);

		// Color
		$this->add_control(
			'widget_shape3_solid_color',
			[
				'label' => __( 'Shape 3 Color', 'blackwidgets' ),
				'type' => Controls_Manager::COLOR,
				'condition'  => [
					'custom_nav_styles' => [
						'style3',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-nav.style3 a:hover:before' => 'color: {{VALUE}};',
				],
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

		$settings           = $this->get_settings_for_display();

		// Variables
		// $type 	        = isset($settings['widget_type']) 				? $settings['widget_type'] : '';
		$alignment          = isset($settings['widget_alignment'])      ? $settings['widget_alignment']         : '';
        $custom_nav_styles	= isset($settings['custom_nav_styles'])		? $settings['custom_nav_styles']		: '';



        // $befor_nav          = $settings['custom_icon_before_nav']['value'];

		$args = [
			'echo'          => false,
			'menu'          => $settings['menu'],
			'menu_class'    => 'bw-menu-box',
			'menu_id'       => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb'   => '__return_empty_string',
            // 'before'        => '<i class="'.$befor_nav.'"></i>',
			'container'     => '',
		];

		$menu_html = wp_nav_menu( $args );
        
		// Render
        

        echo '<div class="bw-nav ' . $custom_nav_styles . ' ' . $alignment . '">';
            echo $menu_html;
        echo '</div>';

	}

}