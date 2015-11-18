<?php

if ( !function_exists( 'szbl_setup_post' ) ) :

function szbl_setup_post( $post )
{
	global $szbl_org_post;


	if ( isset( $GLOBALS['post'] ) )
	{
		$szbl_org_post = $GLOBALS['post'];
	}

	$GLOBALS['post'] = $post;
	setup_postdata( $post );
}

endif;

if ( !function_exists( 'szbl_reset_post' ) ) :

function szbl_reset_post()
{
	global $szbl_org_post;
	$GLOBALS['post'] = $szbl_org_post;
	szbl_setup_post( $szbl_org_post );
}

endif;