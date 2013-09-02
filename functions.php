<?php

/**
* This is Malleable's functions.php file.
* You should make edits and add additional code above this point.
* Only change the functions below if you know what you're doing.
*/

/********************************************************/

/* Constant paths. */
	define( MALLEABLE, get_stylesheet_directory() );
	define( MALLEABLE_URL, get_stylesheet_directory_uri() );

/* For localization. */
	load_theme_textdomain( 'malleable', MALLEABLE );

/* Hybrid News theme settings. */
	$malleable_settings = get_option( 'malleable_theme_settings' );

/* Include admin files. */
	if ( is_admin() )
		require_once( MALLEABLE . '/library/admin/theme-settings.php' );

/* Actions. */
	add_action( 'hybrid_head', 'malleable_front_page_template' );
	add_action( 'wp_head',     'malleable_remove_actions' );
	add_action( 'hybrid_header', 'hybrid_search_form' );
	add_action( 'hybrid_after_page_nav', 'malleable_cat_nav' );
	add_action( 'hybrid_after_container', 'malleable_widget_container', 11 );
	add_action( 'hybrid_after_single','malleable_author_box' );
	add_action( 'hybrid_header', 'malleable_show_address', 11 );
	add_action( 'hybrid_footer', 'malleable_show_address', 11 );

/* Filters. */
	add_filter( 'hybrid_post_meta_boxes', 'malleable_post_meta_boxes' );

/**
 * Removes default Hybrid theme actions
 *
 * @since 0.1
 */
function malleable_remove_actions() {
	remove_action( 'hybrid_after_container', 'hybrid_get_primary' );
	remove_action( 'hybrid_after_container', 'hybrid_get_secondary' );
	remove_action( 'hybrid_before_content', 'hybrid_breadcrumb' );
}

/**
 * Displays the category menu.
 *
 * @since 0.2
 */
function malleable_cat_nav() {

	$args = array(
		'style' => 'list',
		'hide_empty' => true,
		'use_desc_for_title' => false,
		'depth' => 4,
		'hierarchical' => true,
		'echo' => false,	// Leave as is.
		'title_li' => false,	// Leave as is.
	);

	echo "\n\t<div id='cat-navigation'>\n\t\t";

	echo '<div id="cat-nav" class="cat-nav"><ul class="menu sf-menu">' . str_replace( array( "\t", "\n", "\r" ), '', wp_list_categories( $args ) ) . '</ul></div>';

	echo '<div id="feed"><ul>';
	echo '<li class="feed-url"><a href="' . get_bloginfo( 'rss2_url' ) . '" title="' . __('Subscribe to the feed', 'malleable') . '">' . __('Subscribe', 'malleable') . '</a></li>';
	echo '</ul></div>';

	echo "\n\t</div>\n";
}

/**
 * Adds JavaScript and CSS to Front Page page template.
 * Also removes the breadcrumb menu.
 *
 * @since 0.1
 */
function malleable_front_page_template() {
	if ( is_page_template( 'front-page.php' ) ) :
		wp_enqueue_script( 'slider', MALLEABLE_URL . '/library/js/jquery.cycle.js', array( 'jquery' ), 0.1 );
		wp_enqueue_script( 'slider-functions', MALLEABLE_URL . '/library/js/jquery.functions.js', array( 'jquery' ), 0.1 );
		wp_enqueue_style( 'front-page', MALLEABLE_URL . '/front-page.css', false, '0.1', 'screen' );
		remove_action( 'hybrid_before_content', 'hybrid_breadcrumb' );
	endif;
}

/**
 * Wraps the Primary, Secondary, and Tertiary widget sections.
 *
 * @since 0.1
 */
function malleable_widget_container() {
	if ( is_active_sidebar( 'primary' ) || is_active_sidebar( 'secondary' ) || is_active_sidebar( 'tertiary' ) ) :
		echo '<div id="widget-container">';
			hybrid_get_primary();
			hybrid_get_secondary();
		echo '</div>';
	endif;
}

/**
 * Shows an author description after the post.
 * Only shows on single post.
 *
 * @since 0.1
 */
function malleable_author_box() {
	global $hybrid_settings;
?>
	<div class="author-profile vcard">
		<?php echo get_avatar( get_the_author_email(), '96', $hybrid_settings['default_avatar'] ); ?>
		<h4 class="author-name fn n"><?php the_author_posts_link(); ?></h4>
		<p class="author-description author-bio">
			<?php the_author_description(); ?>
		</p>
	</div>
<?php
}

/**
 * Add additional post meta boxes.
 * - Feature image input box.
 *
 * @since 0.1
 */
function malleable_post_meta_boxes( $meta_boxes ) {
	$meta_boxes['medium'] = array( 'name' => 'Medium', 'default' => '', 'title' => __('Medium/Feature:', 'malleable'), 'type' => 'text', 'show_description' => false, 'description' => false );
	return $meta_boxes;
}

function malleable_show_address(){
	global $malleable_settings;	
	if ( $malleable_settings['general_address'] == "yes" ) {
		echo '<div class="address vcard">';
			echo '<div class="fn n org">'. get_bloginfo('title') .'</div>';
			echo '<div class="adr">';		
				echo '<span class="street-address">'. $malleable_settings['general_address_street']. '</span>, ';
				echo '<span class="locality">'.   $malleable_settings['general_address_city']. '</span>, ';
				echo '<span class="region">'.  $malleable_settings['general_address_state']. '</span>, ';
				echo '<span class="postal-code">'.    $malleable_settings['general_address_zip']. '</span> -- ';
				echo '<span class="tel">'.  $malleable_settings['general_address_phone']. '</span>';
			echo '</div>';		
		echo '</div>';
	}
}

?>