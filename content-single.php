<?php
/**
 * The default template for displaying content
 * Used for single posts.
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<a id="top"></a>
<div class="container maddos-content-single">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<div id="post-<?php the_ID();?>" <?php post_class( 'maddos-link-container' );?>>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-header nocenter">

					<?php
					$icon = function_exists( 'get_field' ) ? get_field( 'site_icon', $post->ID ) : null ;
					$icon = apply_filters( 'maddos_get_icon', $icon );
					$site_icon = $icon && filter_var( $icon, FILTER_VALIDATE_URL ) ? "<span class='maddos-title-icon'><img width='16' height='16' alt='{$title}' title='{$title}' src='{$icon}' /></span>" : "<span class='maddos-title-icon'>{$icon}</span>";

					$categories = get_the_category();
					$catNames = array();
					foreach ( $categories as $category ) {
        					if ( isset( $category->cat_name ) ) $catNames[] = $category->cat_name;
					}
					if ( ! empty( $catNames ) ) {
        					$cat_name = implode( ',', $catNames );
					}
					$cat_name = apply_filters( 'maddos-post-single-category', $cat_name, get_the_ID() );
					?>

					<h1 class="maddos-post-header"><?php printf( "%s", $site_icon );?> <?php the_title();?><span class="maddos-post-header-category"> - <?php echo esc_html( $cat_name );?> <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></span></h1>
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
