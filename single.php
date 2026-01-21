<?php
/**
 * The single post template for theme Maddos
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
		get_template_part( 'inc/related-posts' );
	endwhile;
endif;

get_footer(); 

?>
