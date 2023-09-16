<?php
function ahura_breadcrumb($seperator = '') {
	$delimiter = !empty($seperator) ? $seperator : '<span class="separator"></span>';
	$home      = __('Home', 'ahura');
	$before    = '<span class="current-crumb">';
	$after     = '</span>';
	$homeLink = get_bloginfo( 'url' );
	if (!is_home() && !is_front_page() || is_paged()) {
		global $post;
		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
		if (is_category()) {
			global $wp_query;
			$cat_obj   = $wp_query->get_queried_object();
			$thisCat   = $cat_obj->term_id;
			$thisCat   = get_category( $thisCat );
			$parentCat = get_category( $thisCat->parent );
			if ( $thisCat->parent != 0 ) {
				echo(get_category_parents( $parentCat, true, ' ' . $delimiter . ' ' ));
			}
			echo $before . __('Archive by category', 'ahura') .' "' . single_cat_title( '', false ) . '"' . $after;
		} elseif (is_day()) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'd' ) . $after;
		} elseif (is_month()) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'F' ) . $after;
		} elseif (is_year()) {
			echo $before . get_the_time( 'Y' ) . $after;
		} elseif (is_single() && ! is_attachment()) {
			if (get_post_type() != 'post') {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
				echo $before . get_the_title() . $after;
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post') {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;
		} elseif (is_attachment()) {
			$parent = get_post( $post->post_parent );
			$cat    = get_the_category( $parent->ID );
			$cat    = $cat[0];
			echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
			echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif (is_page() && ! $post->post_parent) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_post( $parent_id );
				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb ) {
				echo $crumb . ' ' . $delimiter . ' ';
			}
			echo $before . get_the_title() . $after;
		} elseif (is_search()) {
			echo $before . __('Search results for', 'ahura') . ' "' . get_search_query() . '"' . $after;
		} elseif (is_tag())  {
			echo $before . __('Post tags', 'ahura') . ' "' . single_tag_title('', false) . '"' . $after;
		} elseif (is_author()) {
			$author    = get_queried_object();
			$author_id = $author->ID;
			echo $before . __('Content written by', 'ahura') . ' ' . get_the_author_meta('display_name', $author_id) . $after;
		} elseif (is_404()) {
			echo $before . __('404 Error', 'ahura') . $after;
		}
		if (get_query_var('paged')) {
			$isset = is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author();
			if ($isset) {
				echo ' (';
			}
			echo __('Page', 'ahura') . ' ' . ' ' . get_query_var( 'paged' );
			if ($isset) {
				echo ')';
			}
		}
	} else {
		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	}
}