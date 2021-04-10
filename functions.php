<?php

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function ArtpopAMP_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'ArtpopAMP_enqueue_child_styles' );

/*Write here your own functions */


// Indicate that the theme works well in both Standard and Transitional template modes.
add_theme_support( 'amp');

//Don't run scripts on AMP URLs
add_action( 'wp_enqueue_scripts', function() {
    if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
        wp_dequeue_script('artpop-script');
    }
}, 1000 );

// remove non AMP compatible submenu from parent theme to replace with AMP compatible version
 add_action( 'init', 'remove_parent_functions');
    function remove_parent_functions() {
		remove_filter( 'walker_nav_menu_start_el', 'artpop_add_sub_menu_toggles', 10, 4 );
    }


// repace with AMP compatible version

function artpop_add_sub_menu_toggles_amp( $output, $item, $depth, $args ) {
	if ( isset( $args->show_sub_menu_toggles ) && $args->show_sub_menu_toggles && in_array( 'menu-item-has-children', $item->classes, true ) ) {
 		$output = '<li data-amp-bind-class="visible2 ? \'is-open\' : \'is-closed\'" class="menu-item-has-children"><div class="menu-item-wrapper">'.  $output . '<button on="tap:AMP.setState({visible2: !visible2})" class="sub-menu-toggle" aria-expanded="false"><span class="screen-reader-text">' . __( 'Show sub menu', 'artpop' ) . '</span>' . artpop_get_svg( array( 'icon' => 'chevron-down' )  ) . '</button></div>';
	}
	return $output;
	$output .= $indent . '<li data-content="'.$item->title.'"  id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
}
add_filter( 'walker_nav_menu_start_el', 'artpop_add_sub_menu_toggles_amp', 10, 4 );





/**
 * Display the Search Icon - AMP valid function replacement
 */
function artpop_search_popup_amp() {
	if ( get_theme_mod( 'header_show_search_icon', 1 ) ) :
		echo '<div [class]="ampsearch ? \'search-popup active\' : \'search-popup \'" class="search-popup">';
		echo '<button class="search-popup-button search-open" on="tap:AMP.setState({ampsearch: !ampsearch})">' . artpop_get_svg( array( 'icon' => 'search' ) ) . '</button>';
		echo '<div class="search-popup-inner">';
		echo '<button class="search-popup-button search-close" on="tap:AMP.setState({ampsearch: !ampsearch})">' . artpop_get_svg( array( 'icon' => 'x' ) ) . '</button>';
		get_search_form();
		echo '</div></div>';
	endif;
}






 