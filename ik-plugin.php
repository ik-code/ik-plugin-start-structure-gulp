<?php
/**
 * Plugin Name: IK Plugin
 * Plugin URI: http://wp.medi-com.info/ik-plugin
 * Description: My AAAmazing Custom Plugin
 * Version: 1.0.0
 * Author: Ihor Khaletskyi
 * Author URI: http://wp.medi-com.info
 * License: GPL2.0 or later
 * Text Domain: ik-plugin
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/


function activate_ik_plugin(){
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_ik_plugin');


function deactivate_ik_plugin(){
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_ik_plugin');


defined('ABSPATH') or die ('Hey, what are you doing here? You silly human!');


if(file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' )){
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


if ( class_exists( 'Inc\\Init')){
    Inc\Init::register_services();
}

