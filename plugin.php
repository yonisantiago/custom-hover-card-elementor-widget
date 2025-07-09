<?php
/**
 * Plugin Name: Hover Cards
 * Description: A hover cards that shows a list when it is hovered, elementor and elementor pro widget.
 * Version: 0.1 
 * Author: Yoni
 * Author URI: https://github.com/yonisantiago
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function register_custom_widget() {
    require_once plugin_dir_path( __FILE__ ) . 'widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new My_Custom_Widget() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_widget' );
