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
class BLACK_WIDGETS_Sentence extends \Elementor\Widget_Base {

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
		return 'b_sentence';
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
		return __( 'Black Sentence', 'blackwidgets' );
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
		return 'bw-ic-ele eicon-heading';
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


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'sentence_type',
			[
				'label' => __( 'Select Type', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bw-t-1',
				'options' => [
					'bw-t-1' 	=> __( 'Text', 'blackwidgets' ),
					'bw-t-2' 	=> __( 'Image', 'blackwidgets' ),
					// 'bw-t-3' 	=> __( 'SVG/Shape', 'blackwidgets' ),
					// 'bw-t-4' 	=> __( 'video', 'blackwidgets' ),
				],
			]
		);

		$repeater->add_control(
			'sentence_title', [
				'label' => __( 'Title', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Make it look amazing ;)' , 'blackwidgets' ),
				'label_block' => true,
				'condition'  => [
					'sentence_type' => [
						'bw-t-1',
					],
				],
			]
		);

		$repeater->add_control(
			'sentence_image',
			[
				'label' => __( 'Choose Image', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'  => [
					'sentence_type' => [
						'bw-t-2',
					],
				],
			]
		);

		$repeater->add_control(
			'sentence_image_width',
			[
				'label' => __( 'Image width', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 10,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-2 img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'sentence_type' => [
						'bw-t-2',
					],
				],
			]
		);

		$repeater->start_controls_tabs('inner_tab'); // Start Tabs

		$repeater->start_controls_tab(
			'normal_style',
			[
				'label' => __( 'Normal', 'blackwidgets' ),
			]
		);


		// Margin
		$repeater->add_responsive_control(
			'widget_box_margin',
			[
				'label' => __( 'Margin', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-1{{CURRENT_ITEM}}, {{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$repeater->add_responsive_control(
			'widget_box_padding',
			[
				'label' => __( 'Padding', 'blackwidgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-1{{CURRENT_ITEM}}, {{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'widget_box_border',
				'label' => __( 'Border', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-sentence .bw-t-1{{CURRENT_ITEM}}, {{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}',
			]
		);

		$repeater->add_control(
			'widget_box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'blackwidgets' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-1{{CURRENT_ITEM}}, {{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'widget_box_box_shadow',
				'label' => __( 'Box Shadow', 'blackwidgets' ),
				'selector' => '{{WRAPPER}} .bw-sentence .bw-t-1{{CURRENT_ITEM}}, {{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}',
			]
		);

		$repeater->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		// Typographht



		









		$repeater->add_control(
			'sentence_image_position',
			[
				'label' => __( 'Position', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' 	=> __( 'Normal', 'blackwidgets' ),
					'absolut' 	=> __( 'Absolut', 'blackwidgets' ),
				],
				'condition'  => [
					'sentence_type' => [
						'bw-t-2',
					],
				],
			]
		);

		// Alignment
		$repeater->add_responsive_control(
			'sentence_image_horizontal_position',
			[
				'label'     => __( 'Horizontal Orientation', 'blackwidgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'blackwidgets' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right'  => [
						'title' => __( 'Right', 'blackwidgets' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'    => true,
				'condition'  => [
					'sentence_image_position' => [
						'absolut',
					],
				],
			]
		);

		// Left
		$repeater->add_control(
			'sentence_image_position_left',
			[
				'label' => __( 'Offset', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
						'step' => 10,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'sentence_image_horizontal_position' => [
						'left',
					],
				],
			]
		);

		// Right
		$repeater->add_control(
			'sentence_image_position_right',
			[
				'label' => __( 'Offset', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
						'step' => 10,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'sentence_image_horizontal_position' => [
						'right',
					],
				],
			]
		);

		// Alignment
		$repeater->add_responsive_control(
			'sentence_image_vertical_position',
			[
				'label'     => __( 'Vertical Orientation', 'blackwidgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'top'   => [
						'title' => __( 'Top', 'blackwidgets' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom'  => [
						'title' => __( 'Bottom', 'blackwidgets' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'toggle'    => true,
				'condition'  => [
					'sentence_image_position' => [
						'absolut',
					],
				],
			]
		);

		// Top
		$repeater->add_control(
			'sentence_image_position_top',
			[
				'label' => __( 'Offset', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
						'step' => 10,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'sentence_image_vertical_position' => [
						'top',
					],
				],
			]
		);

		// Bottom
		$repeater->add_control(
			'sentence_image_position_bottom',
			[
				'label' => __( 'Offset', 'blackwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -2000,
						'max' => 2000,
						'step' => 10,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-sentence .bw-t-2{{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'sentence_image_vertical_position' => [
						'bottom',
					],
				],
			]
		);



		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'hover_style',
			[
				'label' => __( 'Hover', 'blackwidgets' ),
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs(); // End Tabs



		$this->add_control(
			'sentence',
			[
				'label' => __( 'Sentence Repeater', 'blackwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'sentence_title' 	=> __( 'Hello', 'blackwidgets' ),
					],
					[
                        'sentence_title' 	=> __( 'everybody,', 'blackwidgets' ),
					],
					[
                        'sentence_title' 	=> __( 'this is', 'blackwidgets' ),
					],
					[
                        'sentence_title' 	=> __( 'the black sentence.', 'blackwidgets' ),
					],
				],
				'title_field' => '{{{ sentence_title }}}',
			]
		);



		$this->end_controls_section();
		// End

		// Start
		// Content section
		$this->start_controls_section(
			'custom_section',
			[
				'label' => __( 'Custom Content', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'widget_type' => [
						'custom',
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



		$this->end_controls_section();
        // End

		// Start
		// Typography section
		$this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon Style', 'blackwidgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'  => [
					'widget_type' => [
						'custom',
					],
				],
			]
        );


		$this->end_controls_section();

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

		$settings   			= $this->get_settings_for_display();
		// Variables
		$type 	                = isset($settings['sentence_type'])			? $settings['sentence_type']		: '';
    
		$data_id		= 'bw_' . uniqid();
		$script_id		= '#' . $data_id;

		// Render
        // echo '<div class="bw-sentence bw-showcase bw-showcase-type-1">';
		// 	echo '<h1>';
		// 		echo '<span>Example</span>';
		// 		echo '<span>Box</span>';
		// 		echo '<span>Second Text</span>';
		// 	echo '</h1>';
		// echo '</div>';

		// Render
        if ( $settings['sentence'] ) {
			echo '<div class="bw-sentence bw-showcase">';
				echo '<h1 class="bw-sentence-items">';
					foreach (  $settings['sentence'] as $item ) {

						if( $item['sentence_type'] == 'bw-t-1' ) {
							echo '<span class="elementor-repeater-item-' . $item['_id'] . ' '.$item['sentence_type'].'">';
								echo $item['sentence_title'];
							echo '</span>';	
						}

						if( $item['sentence_type'] == 'bw-t-2' ) {
							$position = isset($item['sentence_image_position'])			? $item['sentence_image_position']		: '';
							echo '<span class="elementor-repeater-item-' . $item['_id'] . ' '.$item['sentence_type'].' bw-sentence-'.$position.'">';
								// echo '<img src="' . Group_Control_Image_Size::get_attachment_image_src( $item['sentence_image']['id'], 'thumbnail', $settings ) . '">';
								echo '<img src="' . $item['sentence_image']['url'] . '">';
							echo '</span>';	
						}

	
					}
				echo '</h1>';
			echo '</div>';
		}


	}

}