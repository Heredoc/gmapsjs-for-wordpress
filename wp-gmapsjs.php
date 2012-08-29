<?php
/*
Plugin Name: Gmaps.js for Wordpress
Plugin URI: http://nois3lab.it/
Description: Adds awesome maps and features to your site with this enhanced google maps APIS framework.
Author: Marco "junior" Antonutti @ nois3lab
Author URI: http://nois3lab.it/team/marco-jr-antonutti
Version: 0.1
*/
/*hook area*/
add_action('admin_menu', 'gmapsjs_hook_menu');
add_action('wp_enqueue_scripts', 'gmapsjs_enqueue_scripts');
function gmapsjs_hook_menu() {
	add_options_page('Gmaps.js for wordpress', 'Gmaps settings', 'manage_options', 'wp-gmapsjs', 'gmapsjs_settings_page');
}
function gmapsjs_settings_page() {
	include("views/dashboard.php");
}
function gmapsjs_enqueue_scripts() {
	wp_enqueue_script('jquery');
    wp_register_script('gmaps', 'http://maps.google.com/maps/api/js?sensor=true');
    wp_register_script('gmaps-js', plugins_url('gmaps.js',__FILE__));
    wp_enqueue_script('gmaps');
    wp_enqueue_script('gmaps-js');
}    
add_shortcode('gmapsjs', 'gmapsjs_parse_shortcode');
 
function gmapsjs_parse_shortcode($attr, $content = null) {
	//which map has no address?
	if(!isset($attr['address']) || empty($attr['address']))
		return false;
	//define default behaviors and extract $attr array. Get only main options, if they are not null/false then retrieve related options.
	extract( shortcode_atts( array(
		'address'   => '',
		'zoom'      => 12,
		'height'	=> null,
		'width'		=> null,
		'marker'    => false,
		'info_text' => null,
		'route'     => null,
		'draw'      => false
	), $attr ) );

	echo '<div class="gmaps-js" id="maps<?php echo rand(); ?>" data-address="'.$address.'" data-zoom="'.$zoom.'" style="height:'.$height.'; width: '.$width.';"></div>';



}
