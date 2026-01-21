<?php
/**
 * 404 not found template
 */

get_header(); ?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<div class="container maddos-404">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<div class="maddos-link-container">

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-header nocenter">
					<h1 class="maddos-post-header">404 Not Found</h1>
				</div>
				</div>
				</div>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-content">
					<?php _e( 'That page was not found.', 'maddos' ); ?>
				</div>
				</div>
				</div>

			</div>

		</div>
	</div>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

