<?php
/**
 * Plugin Name: Simple User Avatar
 * Plugin URI: http://pmg.com/
 * Description: Overrides Gravatar and allows you to add user avatars
 * Version: 1.0
 * Text Domain: pmg
 * Author: Emily Fox <emily@pmg.com>
 * Author URI: http://pmg.com/
 * License: GPL-2.0+
 *
 * Copyright 2014 Performance Media Group <http://pmg.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

!defined('ABSPATH') && exit;

define('PMG_SIMPLEUSERAVATAR_URL', plugin_dir_url(__FILE__));

require_once __DIR__.'/inc/Setup.php';
require_once __DIR__.'/inc/AvatarDisplay.php';
require_once __DIR__.'/inc/AvatarUpload.php';
require_once __DIR__.'/inc/functions.php';

add_action('plugins_loaded', 'pmg_simpleuseravatar_load');
