<?php
/**
 * Load Elegant Themes Core.
 *
<<<<<<< HEAD
 * @package \ET\Core
 */


if ( defined( 'ET_CORE' ) ) {
	// Core has already been loaded.
=======
 * @package Core
 */

// Stop here if the Core was already loaded.
if ( defined( 'ET_CORE' ) ) {
>>>>>>> bbfbbb9c81f9c36cbaa8e67ea4b62e0932d77aed
	return;
}

define( 'ET_CORE', true );

<<<<<<< HEAD

if ( ! function_exists( '_et_core_find_latest' ) ) :
/**
 * Find the latest version of Core currently available.
 *
 * @since 3.0.60
 *
 * @return string $core_path Absolute path to the latest version of core.
 */
function _et_core_find_latest( $return = 'path' ) {
	static $latest_core_path    = null;
	static $latest_core_version = null;

	if ( 'path' === $return && null !== $latest_core_path ) {
		return $latest_core_path;
	}

	if ( 'version' === $return && null !== $latest_core_version ) {
		return $latest_core_version;
	}

	$this_core_path = _et_core_normalize_path( dirname( __FILE__ ) );
	$content_dir    = _et_core_normalize_path( WP_CONTENT_DIR );

	include $this_core_path . '/_et_core_version.php';

	$latest_core_path    = $this_core_path;
	$latest_core_version = $ET_CORE_VERSION;

	unset( $ET_CORE_VERSION );

	$version_files = glob( "{$content_dir}/{themes,plugins}/*/core/_et_core_version.php", GLOB_BRACE );

	foreach ( (array) $version_files as $version_file ) {
		$version_file = _et_core_normalize_path( $version_file );

		if ( ! is_file( $version_file ) || 0 === strpos( $version_file, $this_core_path ) ) {
			continue;
		}

		include_once $version_file;

		if ( ! isset( $ET_CORE_VERSION ) ) {
			continue;
		}

		$is_greater_than = version_compare( $ET_CORE_VERSION, $latest_core_version, '>' );

		if ( $is_greater_than && _et_core_path_belongs_to_active_product( $version_file ) ) {
			$latest_core_path    = _et_core_normalize_path( dirname( $version_file ) );
			$latest_core_version = $ET_CORE_VERSION;
		}

		unset( $ET_CORE_VERSION );
	}

	if ( 'version' === $return ) {
		return $latest_core_version;
	}

	return $latest_core_path;
}
endif;


if ( ! function_exists( '_et_core_path_belongs_to_active_product' ) ):
/**
 * @private
 * @internal
 */
function _et_core_path_belongs_to_active_product( $path ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';

	$theme_dir = _et_core_normalize_path( get_template_directory() );

	if ( 0 === strpos( $path, $theme_dir ) ) {
		return true;
	}

	if ( false !== strpos( $path, '/divi-builder/' ) ) {
		return is_plugin_active( 'divi-builder/divi-builder.php' );
	}

	if ( false !== strpos( $path, '/bloom/' ) ) {
		return is_plugin_active( 'bloom/bloom.php' );
	}

	if ( false !== strpos( $path, '/monarch/' ) ) {
		return is_plugin_active( 'monarch/monarch.php' );
	}

	return false;
}
endif;


if ( ! function_exists( '_et_core_load_latest' ) ):
function _et_core_load_latest() {
	if ( defined( 'ET_CORE_VERSION' ) ) {
		return;
	}

	$core_path = defined( 'ET_DEBUG' ) ? false : get_site_transient( 'et_core_path' );

	if ( $core_path && file_exists( $core_path . '/_et_core_version.php' ) ) {
		$core_version = get_site_transient( 'et_core_version' );
	} else {
		$core_path    = _et_core_find_latest();
		$core_version = _et_core_find_latest( 'version' );

		set_site_transient( 'et_core_path', $core_path, DAY_IN_SECONDS );
		set_site_transient( 'et_core_version', $core_version, DAY_IN_SECONDS );
	}

	define( 'ET_CORE_VERSION', $core_version );

	require_once $core_path . '/functions.php';
}
endif;


if ( ! function_exists( '_et_core_normalize_path' ) ):
/**
 * @private
 * @internal
 */
function _et_core_normalize_path( $path ) {
	return $path ? str_replace( '\\', '/', $path ) : '';
}
endif;


_et_core_load_latest();
=======
if ( ! function_exists( 'et_core_setup' ) ) :
/**
 * Setup Core.
 *
 * @since 1.0.0
 *
 * @param string $url Url used to load the Core assets.
 *
 * @return bool Always return true.
 */
function et_core_setup( $url ) {
	if ( ! defined( 'ET_CORE_PATH' ) ) {
		define( 'ET_CORE_PATH', trailingslashit( dirname( __FILE__ ) ) );
	}

	if ( ! defined( 'ET_CORE_URL' ) ) {
		define( 'ET_CORE_URL', trailingslashit( $url ) . 'core/' );
	}

	if ( ! defined( 'ET_CORE_TEXTDOMAIN' ) ) {
		define( 'ET_CORE_TEXTDOMAIN', 'et-core' );
	}

	load_theme_textdomain( 'et-core', ET_CORE_PATH . 'languages/' );

	require_once( ET_CORE_PATH . 'components.php' );
	require_once( ET_CORE_PATH . 'functions.php' );
	require_once( ET_CORE_PATH . 'updates_init.php' );

	if ( is_admin() || ! empty( $_GET['et_fb'] ) ) {
		require_once( ET_CORE_PATH . 'admin/includes/assets.php' );

		add_action( 'admin_enqueue_scripts', 'et_core_load_main_styles' );
	}
}
endif;

if ( ! function_exists( 'et_core_load_main_styles' ) ) :
function et_core_load_main_styles( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		return;
	}

	wp_enqueue_style( 'et-core-admin' );
}
endif;
>>>>>>> bbfbbb9c81f9c36cbaa8e67ea4b62e0932d77aed
