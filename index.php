<?php
/**
 * The main template file for Maddos theme
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<div class="container">
	<?php get_template_part( 'page-nav' ); ?>
	</div>
<?php else : ?>
	<?php get_template_part( '404' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
