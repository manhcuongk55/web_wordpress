<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Verity
 */

if ( ! function_exists( 'verity_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function verity_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( '<span class="author-label">By </span>%s', 'verity' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="byline"> ' . $byline . '</span> <span class="posted-on">' . verity_time_link() . '</span>';
}
endif;

if ( ! function_exists( 'verity_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function verity_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date( 'M j, Y' ),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="date-label screen-reader-text">Posted on </span>%s', 'verity' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

if ( ! function_exists( 'verity_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function verity_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = esc_html__( ', ', 'verity' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( verity_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && verity_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && verity_categorized_blog() ) {
							echo '<span class="cat-links"><span class="categories-label">' . esc_html__( 'Categories: ', 'verity' ) . '</span>' . $categories_list . '</span>';
						}

						if ( $tags_list ) {
							echo '<span class="tags-links"><span class="tags-label">' . esc_html__( 'Tags: ', 'verity' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			verity_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'verity_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function verity_edit_link() {

	$link = edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'verity' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	return $link;
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function verity_categorized_blog() {
	$category_count = get_transient( 'verity_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'verity_categories', $category_count );
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in verity_categorized_blog.
 */
function verity_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'verity_categories' );
}
add_action( 'edit_category', 'verity_category_transient_flusher' );
add_action( 'save_post',     'verity_category_transient_flusher' );


if ( ! function_exists( 'verity_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function verity_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'verity' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'verity' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'verity' ), esc_html__( '1 Comment', 'verity' ), esc_html__( '% Comments', 'verity' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'verity' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


if ( ! function_exists( 'verity_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Verity 1.0
 */
function verity_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		echo '<div class="site-logo">';
		
		the_custom_logo();
		
		echo '</div><!-- .site-logo -->';	
	}
}
endif;


if ( ! function_exists( 'verity_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function verity_comment( $comment, $args, $depth ) {
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'verity' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'verity' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->

			<div class="comment-container">
				<header class="comment-meta entry-meta">
					<?php printf( __( '%s <span class="says screen-reader-text">says:</span>', 'verity' ), sprintf( '<cite class="fn author-name">%s</cite>', get_comment_author_link() ) ); ?>

					<a class="comment-permalink" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%s ago', 'verity' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
					<?php edit_comment_link( esc_html__( 'Edit', 'verity' ), '<span class="edit-link">', '</span>' ); ?>
					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'verity' ); ?></p>
					<?php endif; ?>

				</header><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
			</div><!-- .comment-content -->

		</article><!-- .comment-body -->
	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>

	<?php
	endif;
}
endif; // ends check for verity_comment()

if ( ! function_exists( 'verity_entry_categories' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function verity_entry_categories() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'verity' ) );
        if ( $categories_list && verity_categorized_blog() ) {
            printf( '<div class="entry-meta"><span class="cat-links">%1$s</span></div>', $categories_list );
        }
    }
}
endif;