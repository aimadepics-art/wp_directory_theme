<?php
/**
 * The template for displaying post content on archive pages
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>
<?php
	$flow = ot_get_option( 'archive_flow', 'review' ); 
	$href = $flow == 'review' ? get_permalink() : get_field( 'site_url', $post->ID );

	if ( empty( $href ) )
		$href = get_permalink();	// in case site_url is empty, default to WordPress

	$href = apply_filters( 'maddos_archive_link', $href, $post->ID );

	$newtab = ot_get_option( 'postlink_newtab_single', 'on' );
	$nofollow = ot_get_option( 'postlink_nofollow_single', 'off' );

	$target = $newtab === 'on' ? maddos_get_target( true ) : maddos_get_target( false );
	$rel = $nofollow === 'on' ? maddos_get_rel( true, $target ) : maddos_get_rel( false, $target );

	$title = get_the_title( $post->ID );
	$thumb_size = wp_is_mobile() ? 'single-thumb' : 'hover-thumb'; 
	$tn = get_the_post_thumbnail( $post->ID, $thumb_size, array('class'=>'img-responsive maddos-grid-thumbnail', 'alt'=>$title, 'title'=>$title) );

	$post_title_tag = apply_filters( 'maddos_post_archive_title_htag', 'h2' );
?>

	<div id="post-<?php the_ID();?>" <?php post_class( $grid . '3 maddos-post-grid-entry' );?>>

		<div class='maddos-post-grid-header'>
			<?php printf( '<%s class="maddos-post-title"><a href="%s" title="%s" %s %s>%s</a></%s>', 
				$post_title_tag,
				$href,
				$title,
				$target,
				$rel,
				$title,
				$post_title_tag
			); ?>
		</div>

		<div class='maddos-grid-container'>
			<?php printf( '<a href="%s" title="%s" %s %s>%s</a>', 
				$href,
				$title,
				$target,
				$rel,
				$tn
			); ?>
		<p>
		<?php echo wp_kses_post( get_the_excerpt() );?>
		</p>
		</div>
	</div>
