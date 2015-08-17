<?php
/*
Plugin Name: Sizeable Helpers
Description: Required plugin for Sizeable Interactive themes. Supports core functionality and debugging/troubleshooting.
Author: Sizeable Interactive
Author URI: https://sizeableinteractive.com
Version: 2015.08.17
*/
// Sizeable Core Functionality
foreach ( glob( dirname( __FILE__ ) . '/core/*.php' ) as $file ) include $file;

// Theme Specific Functionality
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) include $file;