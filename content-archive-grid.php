<?php
/**
 * The default template for displaying archive grid content
 * Used for index/categories/search, etc.
 */

$grid = ot_get_option( 'grid_option', 'col-sm-' ); 

// set up our custom query:
$orderby = apply_filters( 'maddos_archive_orderby', ot_get_option( 'post_order', 'date' ) );
$order = apply_filters( 'maddos_archive_order', ot_get_option( 'post_order_direction', 'DESC' ) );

if ( $orderby === 'alexaRank' ) {
	$orderby = 'none';
}

$args = array( 'orderby' => $orderby, 'order' => $order );

$paged = get_query_var( 'paged', 1 );
if ( $paged ) {
	$args['paged'] = $paged;
}

$search = get_search_query();
if ( ! empty( $search ) ) {
	$args['s'] = $search;
}

if ( is_category() ) {
	$cat = get_category( get_query_var( 'cat' ) );
	if ( isset( $cat->term_id ) ) {
		$args['cat'] = $cat->term_id;
	}
}
else if ( is_tag() ) {
	$tag = get_query_var( 'tag_id' );
	if ( ! empty( $tag ) ) {
		$args['tag_id'] = $tag;
	}
}


$args = apply_filters( 'maddos_archive_posts', $args );

if ( function_exists( 'maddos_debug_msg' ) ) maddos_debug_msg( "Maddos archive posts args for WP_Query: " . print_r($args,true));

$wp_query = new WP_Query( $args );

if ( function_exists( 'maddos_debug_msg' ) ) maddos_debug_msg( "Maddos archive posts found overall total of {$wp_query->found_posts} results from WP_Query" );
if ( function_exists( 'maddos_debug_msg' ) ) maddos_debug_msg( "Maddos archive posts results from WP_Query: post IDs " . implode( ',', wp_list_pluck( $wp_query->posts, 'ID' ) ) );
//if ( function_exists( 'maddos_debug_msg' ) ) maddos_debug_msg( "Maddos archive posts results from WP_Query: " . print_r( $wp_query,true ) );

if ( have_posts() ) :
$col = 0;
$max_per_row = 4;
?>

<div class="container">
<div class="maddos-archive-grid">

<?php while ( have_posts() ) : the_post(); $col++; ?>

	<?php if ( $col % $max_per_row === 1 ) : ?>
	<div class="row">
	<?php endif; ?>

	<?php 
		get_template_part( 'post-content', 'grid' );
	?>

	<?php if ( $col % $max_per_row === 0 ) : ?>
	</div>
	<?php endif; ?>
<?php endwhile; ?>


	<?php if ( $col % $max_per_row !== 0 ) : ?>
	</div>
	<?php endif; ?>

<?php get_template_part( 'page-nav' ); ?>

</div>
</div>

<?php 
else:
?>
<div class="container">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<p><?php _e( '<h4>No results were found.</h4>', 'maddos' ); ?></p>
		</div>
	</div>
</div>
<?php
endif;
?>
