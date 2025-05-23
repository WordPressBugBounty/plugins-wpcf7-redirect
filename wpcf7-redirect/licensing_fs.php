<?php

/**
 * Get the path for the admin page
 *
 * @return string Admin page path
 */
function wpcf7_get_freemius_addons_path() {
	return 'admin.php?page=wpcf7r-addons-upsell';
}

/**
 * Check if this the user has a premium license
 *
 * @param string $func The functionality to check premium access for.
 * @return boolean True if user has premium access, false otherwise
 */
function wpcf7r_is_premium_user( $func ) {
	return true;
}

/**
 * Check if the parent plugins is active and loaded
 *
 * @return boolean True if parent plugin is active and loaded
 */
function wpcf7r_is_parent_active_and_loaded() {
	return true;
}

/**
 * Check if the parent plugin is active
 *
 * @return boolean True if parent plugin is active
 */
function wpcf7r_is_parent_active() {
	$active_plugins = get_option( 'active_plugins', array() );

	if ( is_multisite() ) {
		$network_active_plugins = get_site_option( 'active_sitewide_plugins', array() );
		$active_plugins         = array_merge( $active_plugins, array_keys( $network_active_plugins ) );
	}

	foreach ( $active_plugins as $basename ) {
		if ( 0 === strpos( $basename, 'wpcf7-redirect/' ) || 0 === strpos( $basename, 'wpcf7-redirect-premium/' ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Get the Freemius ID for the plugin
 *
 * @return int Freemius ID
 */
function wpcf7_freemius_get_id() {
	return 9546;
}

/**
 * General loading addon function
 *
 * @param string $name The name of the addon to load.
 * @return void
 */
function wpcf7r_load_freemius_addon( $name ) {
	$callback    = $name;
	$loaded_hook = $name . '_loaded';

	add_action(
		'plugins_loaded',
		function () use ( $callback, $loaded_hook ) {
			do_action( $loaded_hook );
		}
	);
}
