<?php
/**
 * The default template for displaying content.
 * Used for each post on single or archive pages.
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<a id="top"></a>
<div class="container maddos-content-post">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<div id="post-<?php the_ID();?>" <?php post_class( 'maddos-link-container' );?>>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-header nocenter">

					<?php
					$icon = function_exists( 'get_field' ) ? get_field( 'site_icon', get_the_ID() ) : null ;
					$icon = apply_filters( 'maddos_get_icon', $icon );
					$site_icon = $icon && filter_var( $icon, FILTER_VALIDATE_URL ) ? "<span class='maddos-title-icon'><img width='16' height='16' alt='{$title}' title='{$title}' src='{$icon}' /></span>" : "<span class='maddos-title-icon'>{$icon}</span>";

					$header_tag = is_single() ? 'h2' : 'h3';
					$title = $header_tag === 'h2' ? get_the_title() : sprintf( '<a href="%s">%s</a>', get_permalink(), get_the_title() );
					$cat_name = maddos_get_post_categories( get_the_ID() );
					?>

					<?php printf( '<%s class="maddos-post-header">%s %s<span class="maddos-post-header-category"> - %s <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></span></%s>',
						$header_tag,
						$site_icon,
						$title,
						wp_kses_post( $cat_name ),
						$header_tag
					); ?>
					<div class="maddos-link-header-back">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> <?php _e( 'Back To Home', 'maddos' ); ?></a>
					</div>
				</div>
				</div>
				</div>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-content">

				<?php 
					$post_layout = apply_filters( 'maddos_post_layout', ot_get_option( 'post_layout', 'maddos' ) );
					if ( $post_layout === 'wordpress' ) :
						get_template_part( 'post-content' ); 
					else : 
						get_template_part( 'post-content', 'maddos' ); 

					endif; 
				?>

				</div> <!-- end maddos-link-content -->
				</div>
				</div>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-comments-container">
					<?php comments_template( '', true ); ?>
				</div>
				</div>
				</div>

			</div> <!-- end maddos-link-container -->
		</div>
	</div>
</div>
