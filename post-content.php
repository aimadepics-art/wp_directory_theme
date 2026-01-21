<?php
/**
 * The template for displaying product review plugin
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<div class="row maddos-post-meta">

	<div class="row">
	<div class="<?php echo sanitize_html_class( $grid );?>12">
		<div class="maddos-content <?php echo sanitize_html_class( $grid );?>12">
			<?php the_content();?>
			<?php wp_link_pages(); ?>
		</div>
	</div>
	</div>

	<div class="row">
	<div class="<?php echo sanitize_html_class( $grid );?>12">

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

	<div class="maddos-tags <?php echo sanitize_html_class( $grid );?>12">
		<?php the_tags('Tags: ', ' ');?>
	</div>

	</div>
	</div>

</div>

