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
		$href = get_permalink();        // in case site_url is empty, default to WordPress

	$href = apply_filters( 'maddos_archive_link', $href, $post->ID );

	$newtab = ot_get_option( 'postlink_newtab_single', 'on' );
	$nofollow = ot_get_option( 'postlink_nofollow_single', 'off' );

	$target = $newtab === 'on' ? maddos_get_target( true ) : maddos_get_target( false );
	$rel = $nofollow === 'on' ? maddos_get_rel( true, $target ) : maddos_get_rel( false, $target );

	$title = get_the_title( $post->ID );
	$thumbsize = wp_is_mobile() ? 'single-thumb' : 'hover-thumb';
	$tn = get_the_post_thumbnail( $post->ID, $thumbsize, array('class'=>'img-responsive', 'alt'=>$title, 'title'=>$title));
	$post_title_tag = apply_filters( 'maddos_post_archive_title_htag', 'h2' );
?>

<div class="row">

<?php if ( has_post_thumbnail() ) : ?>
	<div class="<?php echo sanitize_html_class( $grid );?>3">

		<div class="maddos-link-thumbnail">
			<div class="maddos-link-thumb">
				<?php printf( '<a href="%s" title="%s" %s %s>%s</a>', $href, $title, $target, $rel, $tn ); ?>
			</div>
		</div>
	</div>

	<div class="<?php echo sanitize_html_class( $grid );?>9 maddos-post-list-entry">
<?php else: ?>
        <div class="<?php echo sanitize_html_class( $grid );?>12 maddos-post-list-entry">
<?php endif; ?>

		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">

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
		</div>

		<div class="row maddos-post-meta">
			<?php if(function_exists('the_views')) : ?>
				<div class="<?php echo sanitize_html_class( $grid );?>12">
 					<?php the_views(true, '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> '); ?>
				</div>
			<?php endif; ?>

			<?php if ( comments_open() ) : ?>
				<div class="<?php echo sanitize_html_class( $grid );?>12">
					<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
					<?php comments_popup_link( __( 'No comments', 'maddos' ), __( 'One comment', 'maddos' ), __( '% comments', 'maddos' ), 'maddos-comments-popup', '' ); ?>
				</div>
			<?php endif; ?>

			<?php if(function_exists('the_ratings')) : ?>
				<div class="<?php echo sanitize_html_class( $grid );?>12">
					<?php the_ratings(); ?>
				</div>
			<?php endif; ?>

		</div>

		<div class="row">
			<div class="maddos-content <?php echo sanitize_html_class( $grid );?>12">
				<?php echo wp_kses_post( get_the_excerpt() );?>
				<?php edit_post_link('Edit', '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> ', ''); ?>
			</div>
		</div>

	</div>
</div>

