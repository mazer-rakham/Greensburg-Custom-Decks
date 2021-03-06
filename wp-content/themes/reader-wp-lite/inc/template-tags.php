<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Reader-Wp-Lite
 */

if ( ! function_exists( 'reader_wp_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function reader_wp_lite_posted_on() {
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
		esc_html_x( 'Posted on %s', 'post date', 'reader-wp-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'reader-wp-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'reader_wp_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function reader_wp_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'reader-wp-lite' ) );
		if ( $categories_list && reader_wp_lite_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'reader-wp-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'reader-wp-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'reader-wp-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'reader-wp-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'reader-wp-lite' ),
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
function reader_wp_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'reader_wp_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'reader_wp_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so reader_wp_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so reader_wp_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in reader_wp_lite_categorized_blog.
 */
function reader_wp_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'reader_wp_lite_categories' );
}
add_action( 'edit_category', 'reader_wp_lite_category_transient_flusher' );
add_action( 'save_post',     'reader_wp_lite_category_transient_flusher' );


// Post Meta
function reader_wp_lite_post_meta(){ ?>
    <div class="post-meta">
        <time datetime="<?php echo get_the_modified_date( 'c' );?>"><span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span></time>
        <a href="<?php comments_link(); ?>" class="comments">
        	<span class="count">
        		<?php comments_number( esc_html__('0 Comment' ,'reader-wp-lite') , esc_html__('1 Comment' ,'reader-wp-lite'), esc_html__('% Comment(s)' ,'reader-wp-lite') );?>
        	</span>
        </a>
    </div><!-- /.post-meta -->

<?php }



if(!function_exists('reader_wp_lite_comment')):

	function reader_wp_lite_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
			// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'reader-wp-lite' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default :

		global $post;
		?>

		<li class="comment parent" id="li-comment-<?php comment_ID(); ?>">

			<div id="submited-commnet" class="comment">
				<ol class="commentlist children">
					<li  class="comment">

						<article class="comment-body media">

							<div class="comment-meta media-left">
								<div class="comment-author vcard">
									<?php echo get_avatar( $comment, 100 ); ?>
								</div><!-- /.comment-author -->
							</div><!-- /.comment-meta -->

							<div class="comment-metadata media-body">
								<?php printf( '<h5 class="comment-author">%1$s</h5>', get_comment_author_link()); ?>

								<time datetime="<?php echo get_the_modified_date( 'c' );?>"><?php echo get_the_date('M j, Y'); ?> <?php echo esc_html__('at','reader-wp-lite');?> <?php echo get_comment_time(); ?></time>
							</div><!-- /.comment-metadata -->

							<span class="reply pull-right">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'reader-wp-lite' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span><!-- /.reply -->


							<div class="comment-content ">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'reader-wp-lite' ); ?></p>
							<?php endif; ?>

						</article><!-- /.comment-body -->


					</li>
				</ol>
					<?php //echo reader_wp_lite_post_nav();?>
			</div>


			<?php
			break;
			endswitch;
		}

		endif;

