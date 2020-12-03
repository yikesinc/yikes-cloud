<?php
/**
 * Bootstrap Navwalker
 *
 * @package YIKES Starter
 */

/**
 * Bootstrap pagination
 *
 * @param array $args pagination arguments.
 */
function wp_bootstrap_pagination( $args = array() ) {

	$defaults = array(
		'range'           => 4,
		'custom_query'    => false,
		'previous_string' => __( 'Previous', 'text-domain' ),
		'next_string'     => __( 'Next', 'text-domain' ),
		'before_output'   => '<nav aria-label="Post Pages navigation" role="navigation"><ul class="pagination justify-content-center">',
		'after_output'    => '</ul></nav>',
	);

	$args = wp_parse_args(
		$args,
		apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
	);

	$args['range'] = (int) $args['range'] - 1;
	if ( ! $args['custom_query'] ) {
		$args['custom_query'] = @$GLOBALS['wp_query'];
	}
	$count = (int) $args['custom_query']->max_num_pages;
	$page  = intval( get_query_var( 'paged' ) );
	$ceil  = ceil( $args['range'] / 2 );

	if ( $count <= 1 ) {
		return false;
	}

	if ( ! $page ) {
		$page = 1;
	}

	if ( $count > $args['range'] ) {
		if ( $page <= $args['range'] ) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ( $page >= ( $count - $ceil ) ) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ( $page >= $args['range'] && $page < ( $count - $ceil ) ) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}

	$echo     = '';
	$previous = intval( $page ) - 1;
	$previous = esc_attr( get_pagenum_link( $previous ) );

	$firstpage = esc_attr( get_pagenum_link( 1 ) );
	if ( $firstpage && ( 1 !== $page ) ) {
		$echo .= '<li class="page-item first mr-auto"><a href="' . $firstpage . '" class="page-link"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> ' . __( 'First', 'text-domain' ) . '</a></li>';
	}

	if ( $previous && ( 1 !== $page ) ) {
		$echo .= '<li class="page-item previous"><a href="' . $previous . '" title="' . __( 'previous', 'text-domain' ) . '" class="page-link"><i class="fa fa-chevron-left" aria-hidden="true"></i> ' . $args['previous_string'] . '</a></li>';
	}

	if ( ! empty( $min ) && ! empty( $max ) ) {
		for ( $i = $min; $i <= $max; $i++ ) {
			if ( $page === $i ) {
				$echo .= '<li class="page-item active"><span class="active page-link">' . $i . '</span></li>';
			} else {
				$echo .= sprintf( '<li class="page-item"><a href="%s" class="page-link">%d</a></li>', esc_attr( get_pagenum_link( $i ) ), $i );
			}
		}
	}

	$next = intval( $page ) + 1;
	$next = esc_attr( get_pagenum_link( $next ) );
	if ( $next && ( $count !== $page ) ) {
		$echo .= '<li class="page-item next"><a href="' . $next . '" title="' . __( 'next', 'text-domain' ) . '" class="page-link">' . $args['next_string'] . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>';
	}

	$lastpage = esc_attr( get_pagenum_link( $count ) );
	if ( $lastpage ) {
		$echo .= '<li class="page-item last ml-auto"><a href="' . $lastpage . '" class="page-link">' . __( 'Last', 'text-domain' ) . ' <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';
	}

	if ( isset( $echo ) ) {
		echo $args['before_output'] . $echo . $args['after_output'];
	}
}
