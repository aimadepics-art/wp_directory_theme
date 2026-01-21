<?php
/**
 * The template for displaying the Maddos footer
 */
?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<footer>

<div class="container">

	<?php 
	$show_sidebar = is_active_sidebar( 'maddos-footer-area' );
	$show_sidebar = apply_filters( 'maddos_dynamic_sidebar_footer', $show_sidebar, 'maddos-footer-area' ); 
	if ( $show_sidebar ) : 
	?>

	<div class="maddos-footer">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<?php get_sidebar('footer'); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php $menu = apply_filters( 'maddos_footer_menu', wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 2, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'footer-collapse', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker(), 'echo' => false ) ), 'footer-menu' ); ?>
	<?php if ( $menu ) : ?>

	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<div class="maddos-menu clearfix">


			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo wp_kses_post( $menu ); ?>
			</div>
		</div>

	<?php endif; ?>

	</div>
	</div>

</div>

</footer>

<?php $copy = ot_get_option('copyright_text'); if ( $copy ) : ?>
	<div class="maddos-copyright">
		<?php echo wp_kses_post( $copy ); ?>
	</div><!-- .copyright -->
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
