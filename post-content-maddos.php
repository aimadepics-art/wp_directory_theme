<?php
/**
 * The template for displaying single post content
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>					

<div class="row">

<?php if ( has_post_thumbnail() ) : ?>
	<div class="<?php echo sanitize_html_class( $grid );?>6 maddos-single-left">

		<div class="maddos-link-thumbnail">
			<?php $site_url = function_exists( 'get_field' ) ? get_field( 'site_url', $post->ID ) : null; ?>
			<?php $title = get_the_title( $post->ID ); ?>
			<?php $tn = get_the_post_thumbnail( $post->ID, 'single-thumb', array('class'=>'img-responsive', 'alt'=>$title, 'title'=>$title)); ?>
			<?php if ( $site_url ) : 
				$newtab = ot_get_option( 'postlink_newtab_single', 'on' );
				$nofollow = ot_get_option( 'postlink_nofollow_single', 'off' );

				$metabox_options = function_exists( 'get_field' ) ? get_field('options' ) : array();
				$target = $newtab === 'on' ? maddos_get_target( true ) : maddos_get_target( false );
				$rel = $nofollow === 'on' ? maddos_get_rel( true, $target ) : maddos_get_rel( false, $target );

				printf( '<a href="%s" title="%s" %s %s>%s</a>', $site_url, $title, $target, $rel, $tn );
				$linktext = apply_filters( 'maddos_single_post_linktext', __( 'Click here to visit', 'maddos' ) . ' ' . $title);
				printf( '<a class="maddos-post-linktext" href="%s" title="%s" target="%s" %s>%s</a>', $site_url, $title, '_blank', $rel, $linktext );
			else : 
				printf( "%s", $tn );
			?>
			<?php endif; ?>
		</div>
	</div>

	<div class="<?php echo sanitize_html_class( $grid );?>6 maddos-single-right">
<?php else: ?>
	<div class="<?php echo sanitize_html_class( $grid );?>12">
<?php endif; ?>


		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">
				<?php 
					$header_tag = is_single() ? 'h1' : 'h2';
					$post_header_tag = apply_filters( 'maddos_post_single_title_htag', $header_tag );
					$title = get_the_title();
					printf( '<%s class="maddos-post-title">%s</%s>',
						$header_tag,
						$title,
						$header_tag
					);
				?>
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
					<?php 
					$show_rating = apply_filters( 'maddos_show_ratings', true );
					if ( $show_rating ) the_ratings(); 
					?>
				</div>
			<?php endif; ?>
			<div class="maddos-tags <?php echo sanitize_html_class( $grid );?>12">
				<?php the_tags('Tags: ', ' ');?>
			</div>
		</div>

<?php 
		$post_layout = apply_filters( 'maddos_post_layout', ot_get_option( 'post_layout', 'maddos' ) );
		$class = 'maddos-content-scroll';
?>

		<div class="row">
			<div class="<?php echo sanitize_html_class( $class );?> <?php echo sanitize_html_class( $grid );?>12">
				<?php
					$content = explode( '<p><!--maddossplit--></p>', apply_filters( 'the_content',get_the_content() ) );
					printf( "%s", $content[0] );
					$extra = ! empty( $content[1] ) ? $content[1] : '';
				?>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="<?php echo sanitize_html_class( $grid );?>12">
		<?php if ( ! empty( $extra ) ) : ?>
		<div class="row">
			<div class="maddos-content maddos-split <?php echo sanitize_html_class( $grid );?>12">
				<?php printf( "%s", $extra ); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="row alignright">
				<?php edit_post_link('Edit', '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> ', ''); ?>
				<?php wp_link_pages(); ?>
		</div>
	</div>
</div>

