		
<?php 
$grid = ot_get_option( 'grid_option', 'col-sm-' ); 
$prev = get_previous_posts_link('&larr; Previous Page');
$next = get_next_posts_link('Next Page &rarr;'); 

if ( $prev || $next ) :
?>

	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<?php if (function_exists('wp_pagenavi') ) : ?>
				<?php wp_pagenavi( '<nav class="wp-pagenavi">', '</nav>' ); ?>
			<?php else : ?>
			<div class="maddos-nav">
                        	<div class="maddos-nav-prev"><?php echo wp_kses_post( $prev ); ?></div>
                        	<div class="maddos-nav-next"><?php echo wp_kses_post( $next ); ?></div>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php endif; ?>
