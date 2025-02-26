<?php
/**
 * Plugin Name: P2H Staging Restrictions
 * Description: P2H Staging Restrictions.
 * Version: 1.0.0
 * Author: Anonymous
 * License: GNU General Public License v2 or later
 *
 * @package wpbuild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Staging restrictions.
if ( file_exists( sys_get_temp_dir() . '/staging-restrictions.php' ) && ! defined( 'STAGING_RESTRICTIONS' ) ) {
	define( 'STAGING_RESTRICTIONS', true );
	require_once sys_get_temp_dir() . '/staging-restrictions.php';
}
