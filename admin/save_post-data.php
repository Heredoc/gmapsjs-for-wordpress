<?php
if(isset($_POST['placement'])):
	extract($_POST);
	$generic_settings = array();
	$generic_settings['placement'] = $placement;
	//CSV post types allowed
	$generic_settings['allowed_post_types'] = implode(",",$post_types);
	update_option('gmapsjs_generic_settings', $generic_settings);
endif;

?>