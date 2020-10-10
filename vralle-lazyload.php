<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://github.com/vralle/vralle-lazyload
 * @package           vralle-lazyload
 *
 * @wordpress-plugin
 * Plugin Name:       vralle.lazyload
 * Plugin URI:        https://github.com/vralle/vralle-lazyload
 * Description:       Brings lazySizes.js to WordPress
 * Version:           1.0.2
 * Author:            V.Ralle
 * Author URI:        https://github.com/vralle
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vralle-lazyload
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/vralle/vralle-lazyload.git
 * Requires WP:       4.9
 * Requires PHP:      5.6
 */

namespace VRalleLazyLoad;

use function add_action;
use function define;
use function plugin_basename;
use function plugin_dir_path;
use function plugin_dir_url;

define( 'VLL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'VLL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'VLL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once VLL_PLUGIN_DIR . 'includes/config.php';
require_once VLL_PLUGIN_DIR . 'includes/settings-helpers.php';
require_once VLL_PLUGIN_DIR . 'public/attrs.php';
require_once VLL_PLUGIN_DIR . 'public/content.php';
require_once VLL_PLUGIN_DIR . 'public/bootstrap.php';
require_once VLL_PLUGIN_DIR . 'admin/class-settings-api.php';
require_once VLL_PLUGIN_DIR . 'admin/class-admin.php';

/**
 * Returns the single instance of Settings_API, creating one if needed.
 *
 * @return Settings_API
 */
function settings_api() {
	return Settings_API::instance();
}

/**
 * Returns the single instance of Admin, creating one if needed.
 *
 * @return Admin
 */
function admin() {
	return Admin::instance();
}

/**
 * Define internationalization
 */
function load_texdomain() {
	load_plugin_textdomain(
		'vralle-lazyload',
		false,
		VLL_PLUGIN_DIR . 'languages'
	);
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\\settings_api' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\\admin' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_texdomain' );
