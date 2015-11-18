<?php
if ( !function_exists( 'szbl_numbers_only' ) ) :

function szbl_numbers_only( $val ) 
{
	$number = preg_replace( '/[^\\d]/', '', $val );
	return $number;
}

endif;