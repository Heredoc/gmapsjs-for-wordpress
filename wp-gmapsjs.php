<?php
/*
Plugin Name: Gmaps.js for Wordpress
Plugin URI: http://nois3lab.it/
Description: Adds awesome maps and features to your site with this enhanced google maps APIS framework.
Author: Marco "junior" Antonutti @ nois3lab
Author URI: http://nois3lab.it/team/marco-jr-antonutti
Version: 0.1
*/
/**define database**/
define('GMAPSJS_DB', '0.02');
/*hook area*/
add_action('admin_menu', 'gmapsjs_hook_menu');
add_action('plugins_loaded', 'gmapsjs_admin_init');
add_action('wp_enqueue_scripts', 'gmapsjs_enqueue_scripts');
function gmapsjs_hook_menu() {
	add_options_page('Gmaps.js for wordpress', 'Gmaps settings', 'manage_options', 'wp-gmapsjs', 'gmapsjs_settings_page');
}
function gmapsjs_settings_page() {
	include("views/dashboard.php");
}
function gmapsjs_admin_init() {
	$db_ver = get_option('gmapsjs_db_ver');
	if($db_ver != GMAPSJS_DB || $db_ver == null) 
		gmapsjs_setup();


}
function gmapsjs_setup() {
	 global $wpdb;
	$sql = "CREATE TABLE ".$wpdb->prefix."gmaps_address (
	  ID int(11) NOT NULL AUTO_INCREMENT,
	  address varchar(100) NOT NULL,
	  lat varchar(30) NOT NULL,
	  lon varchar(30) NOT NULL,
	  updated datetime NOT NULL,
	  PRIMARY KEY(ID)
	);";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	update_option('gmapsjs_db_ver', '0.02');
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
		'route'     => 'none',
		'draw'      => false
	), $attr ) );
	$datadress = gmapsjs_getLatLon($address);
	$lat = $datadress['lat'];
	$lon = $datadress['lon'];
	echo '<div class="gmaps-js" id="maps'.rand().'" data-latitude="'.$lat.'" data-longitude="'.$lon.'" data-zoom="'.$zoom.'" data-route="'.$route.'" style="height:'.$height.'; width: '.$width.';"></div>';
}

function gmapsjs_getLatLon($address) {
	global $wpdb;
	$mylink = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gmaps_address WHERE address = '$address'", ARRAY_A);
	if($mylink != null)
		return $mylink;
	else
		$results = gmapsjs_geocoding($address);

	return $results;
}

function gmapsjs_geocoding($addresz) {
	global $wpdb;

	$address = str_replace(" ", "+", $addresz);
	$body = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false');
	if(!$body)
		return false;

	$geobj = json_decode($body);
	if($geobj->status != "OK")
		return false;

	$data = array();
	$data['lat'] = $geobj->results[0]->geometry->location->lat;
	$data['lon'] = $geobj->results[0]->geometry->location->lng;
	$wpdb->insert($wpdb->prefix.'gmaps_address', 
	array( 
		'address' => $addresz,
		'lat'     => $data['lat'], 
		'lon'     => $data['lon'],
		'updated' => current_time('mysql', 0),
	));
	return $data;
}
