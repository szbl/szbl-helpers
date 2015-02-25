<?php
/*
Returns an array in alpha order of 
*/
function szbl_get_hierarchical_terms( $taxonomy, $params = array(), $two_dimensional = false )
{
	$args = shortcode_atts(array(
		'orderby' => 'slug',
		'order' => 'asc',
		'hide_empty' => false,
		'hierarchical' => true,
		'search' => ''
	), $params);

	$terms = get_terms( $taxonomy, $args );

	$master = array();
	$children = array();
	foreach ( $terms as $term )
	{
		if ( $term->parent )
		{
			if ( !isset( $children[ $term->parent ] ) ) 
			{
				$children[ $term->parent ] = array();
			}
			$children[ $term->parent ][] = $term;
		}
		else
		{
			$master[ $term->term_id ] = array( 'term' => $term, 'children' => array() );
		}
	}

	$return = array();

	foreach ( $children as $id => $x )
	{
		if ( isset( $children[ $id ] ) ) 
		{
			$master[ $id ]['children'] = $children[ $id ];
		}
		if ( !isset( $master[ $id ]['term'] ) )
		{
			$master[ $id ]['term'] = get_term_by( 'id', $id, $taxonomy );	
		}
	}

	if ( !$two_dimensional )
	{
		$return = array();
		foreach ( $master as $id => $data )
		{
			$return[] = $data['term'];
			if ( count( $data['children'] ) > 0 )
			{
				foreach ( $data['children'] as $child )
				{
					$return[] = $child;
				}
			}
		}
		$master = $return;
	}

	return $master;
}

/*
Return list of terms without linking
*/
function szbl_the_terms_text( $taxonomy, $before = '', $after = '', $sep = '' )
{
	$terms = get_the_terms( get_the_ID(), $taxonomy, '', ', ', '' );

	$output = array();

	foreach ( $terms as $term )
	{
		$output[] = $term->name;
	}

	$output = implode( $sep, $output );
	echo $before . $output . $after;
}