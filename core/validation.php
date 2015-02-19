<?php
if ( !function_exists( 'is_phone' ) ) :

function is_phone( $number )
{
	return !empty( $number ) && 10 == strlen( preg_replace( '/[^\\d]/', '', $number ) );
}

endif;