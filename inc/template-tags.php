<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hayley
 */

if ( ! function_exists( 'hayley_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hayley_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	$posted_on = sprintf(

	/* translators: %s is the date */
		esc_html_x( 'Posted on %s', 'post date', 'hayley' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	$byline = sprintf(

	/* translators: %s the author of the post*/
		esc_html_x( 'by %s', 'post author', 'hayley' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . esc_html( $posted_on, 'hayley' ) . '</span><span class="byline"> ' . esc_html( $byline, 'hayley' ) . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hayley_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hayley_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', 'hayley' ) );
		if ( $categories_list && hayley_categorized_blog() ) {
		/* translators: used between list items, there is a space after the comma */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hayley' ) . '</span>', esc_html( $categories_list ) ); // WPCS: XSS OK.
		}

		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'hayley' ) );
		if ( $tags_list ) {
		/* translators: used between list items, there is a space after the comma */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hayley' ) . '</span>', esc_html( $tags_list ) ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'hayley' ), esc_html__( '1 Comment', 'hayley' ), esc_html__( '% Comments', 'hayley' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'hayley' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hayley_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hayley_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hayley_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hayley_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hayley_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hayley_categorized_blog.
 */
function hayley_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hayley_categories' );
}
add_action( 'edit_category', 'hayley_category_transient_flusher' );
add_action( 'save_post',     'hayley_category_transient_flusher' );
