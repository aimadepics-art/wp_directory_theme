	<?php if ( post_password_required() )
		return;
	?>

	<?php $num_comments = get_comments_number(); ?>

	<a id="comments"></a>

	<?php if ( $num_comments ) : ?>
	<div class="maddos-comments">

		<h2 class="maddos-comments-title">
			<?php echo esc_html( $num_comments ) . ' ';
			echo _n( 'Comment' , 'Comments' , $num_comments, 'maddos' ); ?>
			for <?php the_title(); ?>
		</h2>
		<ul class="maddos-commentlist">
			<?php $comments = get_comments( array( 'post_id' => $post->ID ) ); ?>
			<?php wp_list_comments( array( 
				'style'		=> 'ul',
				'type'		=> 'comment', 
				'callback' 	=> 'maddos_comment' 
			), $comments ); ?>
		</ul>

	</div><!-- /comments -->

	<?php endif; ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="maddos-comment-nav-below" role="navigation">
			<div class="maddos-post-nav-older"><?php previous_comments_link( __( '&laquo; Older<span> Comments</span>', 'maddos' ) ); ?></div>
			<div class="maddos-post-nav-newer"><?php next_comments_link( __( 'Newer<span> Comments</span> &raquo;', 'maddos' ) ); ?></div>
			<div class="maddos-clear"></div>
		</div> <!-- /comment-nav-below -->
	<?php endif; ?>
	

	<?php $comments_args = array(
		'comment_notes_before' => 
			'<p class="maddos-comment-notes">' . __( 'Your email address will not be published.', 'maddos' ) . '</p>',
		'comment_notes_after' => ' ',
		'comment_field' => 
			'<p class="maddos-comment-form-comment"><textarea id="comment" name="comment" cols="70" rows="6" required>' . '</textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' =>
				'<p class="maddos-comment-form-author">' .
				'<input id="author" name="author" type="text" placeholder="' . __('Name','maddos') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />' . '</p>',
			'email' =>
				'<p class="maddos-comment-form-email">' . '<input id="email" name="email" type="text" placeholder="' . __('Email','maddos') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />' . '</p>',
			'url' =>
			'<p class="maddos-comment-form-url">' . '<input id="url" name="url" type="text" placeholder="' . __('Website URL','maddos') . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
			)
		),
		'title_reply' =>
			__( 'Leave a comment about ', 'maddos' ) . get_the_title( $post->ID ) . ':'
	);
	
	comment_form($comments_args);
	
/**
 * Display a maddos comment
 */
function maddos_comment( $comment, $args, $depth ) {
       $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="maddos-comment-intro">
		<?php echo wp_kses_post( get_avatar( $comment, 32 ) ); ?>
                From <cite class='fn'><?php echo wp_kses_post( get_comment_author_link() ); ?></cite>
                on
                <?php printf('%1$s', get_comment_date(), get_comment_time()) ?>:
                <?php edit_comment_link(__('(Edit)', 'maddos'),'  ','') ?>
                (<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>)
            </div>

            <div class="maddos-comment-text">
                <?php if ( $comment->comment_approved === '0' ) : ?>
                        <p><em><?php _e( 'This comment is awaiting moderation.', 'maddos' ) ?></em></p>
                <?php else: ?>
                        <p><?php comment_text(); ?></p>
                <?php endif; ?>
            </div>

<?php
}
?>
