<?php

/**
* Returns an array of the theme settings
* Add all options to a single array
* This makes one entry in the database
*
* @since 0.1
*/
function malleable_theme_settings() {
	$settings_arr = array(
		'general_address' => false,
		'general_address_street' => false,
		'general_address_city' => false,
		'general_address_state' => false,
		'general_address_zip' => false,
		'general_address_phone' => false,
				
		'feature_category' => false,
		'feature_num_posts' => false,
		'excerpt_category' => false,
		'excerpt_num_posts' => false,
		'headlines_category' => array(),
		'headlines_num_posts' => false,
	);

	return apply_filters('malleable_settings_args', $settings_arr);
}

/**
* Handles the theme settings
*
* @since 0.1
*/
function malleable_theme_page() {

	/*
	* Variables to be used throughout the settings page
	*/
	$theme_name = __('Malleable','malleable');
	$settings_page_title = __('Malleable Theme Settings','malleable');
	$hidden_field_name = 'malleable_submit_hidden';

	/*
	* Get the theme settings and add them to the database
	*/
	$settings_arr = malleable_theme_settings();
	add_option('malleable_theme_settings', $settings_arr);

	/*
	* Set form data IDs the same as settings keys
	*/
	$settings_keys = array_keys($settings_arr);
	foreach($settings_keys as $key) :
		$data[$key] = $key;
	endforeach;

	/*
	* Get existing options from the database
	*/
	$settings = get_option('malleable_theme_settings');

	foreach($settings_arr as $key => $value) :
		$val[$key] = $settings[$key];
	endforeach;
	
	/*
	* If the form has been set
	* Loop through the values
	* Set the option in the database
	*/
	if($_POST[$hidden_field_name] == 'Y') :

		foreach($settings_arr as $key => $value) :
			$settings[$key] = $val[$key] = $_POST[$data[$key]];
		endforeach;

		update_option('malleable_theme_settings', $settings);

		/*
		* Open main div for the theme settings
		*/
		echo '<div class="wrap">';
		echo '<h2>' . $settings_page_title . '</h2>';
		echo '<div class="updated" style="margin:15px 0;">';
		echo '<p><strong>' . __('Settings saved.','malleable') . '</strong></p>';
		echo '</div>';

	else :
		echo '<div class="wrap">';
		echo '<h2>' . $settings_page_title . '</h2>';

	endif;

	/*
	* Load the theme settings form
	*/
	include(MALLEABLE . '/library/admin/theme-settings-xhtml.php');
}

?>