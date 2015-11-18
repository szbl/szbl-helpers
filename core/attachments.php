<?php

if ( !function_exists( 'szbl_get_image_attachments' ) ) : 

/**
 * Returns all image attachments 
 */
function szbl_get_image_attachments( $post_id = false, $args = array() )
{
	if ( !$post_id )
		$post_id = get_the_ID();

	extract(shortcode_atts(array(

		// return object->image with URL to <img> source 
		'with_src' => false,

		// the WordPress Image size
		'image_size' => 'full',

		'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
		'orderby' => 'menu_order',
		'order' => 'asc',
		'posts_per_page' => 999,
		'post__not_in' => array()

	), $args));

	$params = array(
		'post_parent' => $post_id,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => $post_mime_type,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $posts_per_page
	);

	if ( is_array( $post__not_in ) && count( $post__not_in ) > 0 )
	{
		$params['post__not_in'] = $post__not_in;
	}

	$img = get_posts( $params );

	if ( $with_src )
	{
		foreach ( $img as $k => $v )
		{
			$img[ $k ]->image = wp_get_attachment_image_src( $v->ID, $image_size );
		}
	}

	return $img;
}

endif; 

if ( !function_exists( 'szbl_get_thumbnail_url' ) ) :

/**
 * Returns URL of post thumbnail at specified image size.
 */
function szbl_get_thumbnail_url( $ID = false, $size = 'full' )
{
	if ( !$ID )
		$ID = get_the_ID();

	$img = wp_get_attachment_image_src( get_post_thumbnail_ID( $ID ), $size );

	return $img[0];
}

endif; 