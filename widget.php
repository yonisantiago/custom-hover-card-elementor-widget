<?php

// Exit if accessed directly 
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class My_Custom_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'my_custom_hover_cards_widget';
    }

    public function get_title() {
        return __( 'My Custom Hover Card Widget', 'my-custom-hover-cards-widget' );
    }

    public function get_icon() {
        return 'eicon-table-of-contents';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function _register_controls() {

        // Heading Section with styling
        $this->start_controls_section(
            'heading_section',
            [
                'label' => __( 'Heading', 'my-custom-hover-cards-widget' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_part1',
            [
                'label' => __( 'Heading Line 1', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Auto', 'my-custom-hover-cards-widget' ),
            ]
        );

        $this->add_control(
            'heading_part2',
            [
                'label' => __( 'Heading Line 2', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Accidents', 'my-custom-hover-cards-widget' ),
            ]
        );

        // Heading style controls
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __( 'Heading Typography', 'my-custom-hover-cards-widget' ),
                'selector' => '{{WRAPPER}} .hover-card h2',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Heading Color', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hover-card h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // List Items Section with repeater
        $this->start_controls_section(
            'list_section',
            [
                'label' => __( 'List Items', 'my-custom-hover-cards-widget' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_text',
            [
                'label' => __( 'Text', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List item', 'my-custom-hover-cards-widget' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_url',
            [
                'label' => __( 'URL', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'my-custom-hover-cards-widget' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => __( 'List Items', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'list_text' => 'List item 1', 'list_url' => ['url' => ''] ],
                    [ 'list_text' => 'List item 2', 'list_url' => ['url' => ''] ],
                    [ 'list_text' => 'List item 3', 'list_url' => ['url' => ''] ],
                ],
                'title_field' => '{{{ list_text }}}',
            ]
        );

        // Bullet icon/image control
        $this->add_control(
            'bullet_type',
            [
                'label' => __( 'Bullet Type', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default Circle', 'my-custom-hover-cards-widget' ),
                    'image' => __( 'Image / SVG', 'my-custom-hover-cards-widget' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'bullet_image',
            [
                'label' => __( 'Bullet Image', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'bullet_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'bullet_color',
            [
                'label' => __( 'Bullet Color', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff0',
                'condition' => [
                    'bullet_type' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hover-card .hover-list li::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bullet_size',
            [
                'label' => __( 'Bullet Size (px)', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 12,
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 30,
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Card and Background image
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Card Style', 'my-custom-hover-cards-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Background Image', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'background_position',
            [
                'label' => __( 'Background Position', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'left top' => 'Left Top',
                    'left center' => 'Left Center',
                    'left bottom' => 'Left Bottom',
                    'center top' => 'Center Top',
                    'center center' => 'Center Center',
                    'center bottom' => 'Center Bottom',
                    'right top' => 'Right Top',
                    'right center' => 'Right Center',
                    'right bottom' => 'Right Bottom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_repeat',
            [
                'label' => __( 'Background Repeat', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no-repeat',
                'options' => [
                    'no-repeat' => 'No Repeat',
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat Horizontally',
                    'repeat-y' => 'Repeat Vertically',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'background-repeat: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_size',
            [
                'label' => __( 'Background Size', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'auto' => 'Auto',
                    'cover' => 'Cover',
                    'contain' => 'Contain',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_width',
            [
                'label' => __( 'Card Width', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [ 'min' => 100, 'max' => 1200 ],
                    '%' => [ 'min' => 10, 'max' => 100 ],
                    'vw' => [ 'min' => 10, 'max' => 100 ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_height',
            [
                'label' => __( 'Card Height', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [ 'min' => 200, 'max' => 1000 ],
                    'vh' => [ 'min' => 10, 'max' => 100 ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label' => __( 'Card Padding', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_margin',
            [
                'label' => __( 'Card Margin', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Overlay colors
        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Card Overlay Color', 'my-custom-hover-cards-widget' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(35, 63, 149, 0.8)',
                'selectors' => [
                    '{{WRAPPER}} .card::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
    'hover_overlay_color',
    [
        'label' => __( 'Hover Card Overlay Color', 'my-custom-hover-cards-widget' ),
        'type' => Controls_Manager::COLOR,
        'default' => 'transparent',
        'selectors' => [
            '{{WRAPPER}} .card:hover .hover-card' => 'background-color: {{VALUE}}',
        ],
    ]
);


        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $image_url = $settings['image']['url'];
        $bullet_type = $settings['bullet_type'];
        $bullet_image_url = isset($settings['bullet_image']['url']) ? $settings['bullet_image']['url'] : '';
        $bullet_size = $settings['bullet_size']['size'];

        ?>
        <div class="card" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">

            <div class="hover-card">
                <h2>
                    <span class="hover-heading-part1"><?php echo esc_html( $settings['heading_part1'] ); ?></span><br>
                    <span class="hover-heading-part2"><?php echo esc_html( $settings['heading_part2'] ); ?></span>
                </h2>

                <ul class="hover-list">
                    <?php foreach ( $settings['list_items'] as $item ) :
                        $url = $item['list_url']['url'];
                        $is_external = $item['list_url']['is_external'] ? ' target="_blank" rel="noopener noreferrer"' : '';
                        $nofollow = $item['list_url']['nofollow'] ? ' rel="nofollow"' : '';
                    ?>
                    <li>
                        <?php if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>"<?php echo $is_external . $nofollow; ?>>
                                <?php echo esc_html( $item['list_text'] ); ?>
                            </a>
                        <?php else : ?>
                            <?php echo esc_html( $item['list_text'] ); ?>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <style>
            .card {
                position: relative;
                max-width: 1000px; /* default max width, overwritten by control */
                background-size: cover;
                background-position: center center; /* default, overwritten by control */
                background-repeat: no-repeat;
                display: flex;
                align-items: flex-end;
                padding: 0;
                overflow: hidden;
                font-family: 'Segoe UI', sans-serif;
                width: <?php echo esc_attr($settings['card_width']['size']) . $settings['card_width']['unit']; ?>;
                height: <?php echo esc_attr($settings['card_height']['size']) . $settings['card_height']['unit']; ?>;
                padding: <?php echo esc_attr($settings['card_padding']['top']) . $settings['card_padding']['unit'] . ' ' .
                               esc_attr($settings['card_padding']['right']) . $settings['card_padding']['unit'] . ' ' .
                               esc_attr($settings['card_padding']['bottom']) . $settings['card_padding']['unit'] . ' ' .
                               esc_attr($settings['card_padding']['left']) . $settings['card_padding']['unit']; ?>;
                margin: <?php echo esc_attr($settings['card_margin']['top']) . $settings['card_margin']['unit'] . ' ' .
                               esc_attr($settings['card_margin']['right']) . $settings['card_margin']['unit'] . ' ' .
                               esc_attr($settings['card_margin']['bottom']) . $settings['card_margin']['unit'] . ' ' .
                               esc_attr($settings['card_margin']['left']) . $settings['card_margin']['unit']; ?>;
                background-position: <?php echo esc_attr($settings['background_position']); ?>;
                background-repeat: <?php echo esc_attr($settings['background_repeat']); ?>;
                background-size: <?php echo esc_attr($settings['background_size']); ?>;
            }

            .card::before {
                content: "";
                position: absolute;
                inset: 0;
                background-color: <?php echo esc_attr($settings['overlay_color']); ?>;
                z-index: 1;
            }

            .hover-card {
                position: relative;
                z-index: 2;
                background-color: transparent;
                color: white;
                padding: 25px;
                width: 100%;
                transition: max-height 0.4s ease;
                max-height: 120px;
                overflow: hidden;
             
            }
				.card:hover .hover-card {
					background-color: <?php echo esc_attr($settings['hover_overlay_color']); ?>; /* hover overlay color applied only on hover */
				}
            .hover-card h2 {
                margin: 0;
                font-size: <?php echo esc_attr($settings['heading_typography']['font_size'] ?? '32px'); ?>;
                line-height: 1.2;
                color: <?php echo esc_attr($settings['heading_color']); ?>;
            }

            .hover-card .hover-list {
                margin-top: 20px;
                padding-left: 0;
                list-style: none;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .hover-card .hover-list li {
                margin-bottom: 10px;
                padding-left: 25px;
                position: relative;
                font-size: 16px;
            }

            <?php if ( $bullet_type === 'default' ) : ?>
            .hover-card .hover-list li::before {
                content: "";
                position: absolute;
                left: 0;
                top: 6px;
                width: <?php echo esc_attr($bullet_size); ?>px;
                height: <?php echo esc_attr($bullet_size); ?>px;
                background-color: <?php echo esc_attr($settings['bullet_color']); ?>;
                border-radius: 50%;
            }
            <?php else: ?>
            .hover-card .hover-list li::before {
                content: none;
            }
            .hover-card .hover-list li {
                padding-left: <?php echo esc_attr($bullet_size + 15); ?>px;
            }
            .hover-card .hover-list li > a::before,
            .hover-card .hover-list li::before {
                content: url('<?php echo esc_url($bullet_image_url); ?>');
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: <?php echo esc_attr($bullet_size); ?>px;
                height: <?php echo esc_attr($bullet_size); ?>px;
            }
            <?php endif; ?>

            .card:hover .hover-card {
                max-height: 500px;
                /* background-color controlled by selector */
            }

            .card:hover .hover-card .hover-list {
                opacity: 1;
            }
				
            /* Link styling */
            .hover-card .hover-list li a {
                color: inherit;
                text-decoration: underline;
            }
            .hover-card .hover-list li a:hover {
                text-decoration: none;
            }
        </style>

        <?php
    }
}