<?php
/**
 * The sidebar containing the widget area
 * If no active widgets are in this sidebar, hide it completely.
 */

if ( is_active_sidebar( 'maddos-sidebar-area' ) ) : ?>
	<div id="sidebar-area" class="sidebar-container" role="complementary">
		<?php dynamic_sidebar( 'maddos-sidebar-area' ); ?>
	</div><!-- #tertiary -->
<?php endif; ?>
