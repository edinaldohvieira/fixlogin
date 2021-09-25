<?php
/**
 * Plugin Name:     Fix Login
 * Plugin URI:      https://br.wordpress.org/plugins/fixlogin/
 * Description:     Provides a set of basic registration and login shortcode through the front-end of your WordPress site.
 * Author:          edinaldohvieira
 * Author URI:      https://www.linkedin.com/in/edinaldo-h-vieira-38bb291b3
 * License:         GPLv2 or later
 * License URI:     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:     fixlogin
 * Domain Path:     /languages
 * Version:         0.1.0
 * Requires PHP:    7.2.0
 *
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * @package         Fixlogin
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action('wp_enqueue_scripts', "fix1628253046_enqueue_scripts");
function fix1628253046_enqueue_scripts(){
    wp_enqueue_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . '/js/jquery.validate.js', array( 'jquery' )  );
    wp_enqueue_script( 'jquery-mask', plugin_dir_url( __FILE__ ) . '/js/jquery.mask.js', array( 'jquery' )  );
}

include("includes/fix-user-disable-admin-bar-inc.php");
include("includes/fix-user-edit-inc.php");
include("includes/fix-user-login-inc.php");
include("includes/fix-user-logout-inc.php");
include("includes/fix-user-redefine-password-inc.php");
include("includes/fix-user-register-inc.php");
include("includes/fix-user-update-inc.php");
include("includes/fix-user-update-password-inc.php");
include("includes/fix-user-view-inc.php");