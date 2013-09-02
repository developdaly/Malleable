<?php

// Include files
	include(MALLEABLE. '/library/admin/theme-settings-admin.php');

// Add actions
	add_action('admin_menu', 'malleable_add_pages');

/**
* Gets all theme admin menu pages
*
* @since 0.1
*/
function malleable_add_pages() {
	add_theme_page(__('Malleable Settings','hybrid'), __('Malleable','hybrid'), 10, 'malleable.php', malleable_theme_page);
}

?>