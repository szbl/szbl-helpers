<?php

// Sizeable Core Functionality
foreach ( glob( dirname( __FILE__ ) . '/core/*.php' ) as $file ) include $file;

// Theme Specific Functionality
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) include $file;