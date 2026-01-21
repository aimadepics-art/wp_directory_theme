<?php
/**
 * Template Name: Search Page
 */

get_header(); ?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<div class="container">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
		<div class="maddos-link-container">
		<div class="maddos-link-header nocenter">

			<?php $h1 = __( 'Search results for: ', 'maddos' ) . get_search_query(); ?>
			<h1 class="maddos-search-results"><?php echo esc_html( $h1 );?></h1>
			<div class="maddos-link-header-back">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> <?php _e( 'Back To Home', 'maddos' ); ?></a>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>

<?php
        $layout = apply_filters( 'maddos_search_layout', ot_get_option( 'archive_layout', 'list' ) );
        if ( $layout === 'grid' ) {
                get_template_part( 'content-archive', 'grid' );
        }
        else {
                get_template_part( 'content-archive', 'list' );
        }
?>

<?php get_footer(); ?>
