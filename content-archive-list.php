<?php
/**
 * The default template for displaying archive list content
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

if ( have_posts() ) :
while ( have_posts() ) : the_post(); 
?>

<div class="container">
<div class="maddos-archive-list">
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

					$header_tag = 'h3';
					$title = get_the_title();
					$cat_name = maddos_get_post_categories( get_the_ID() );
					?>

					<?php printf( '<%s class="maddos-post-header">%s <a href="%s">%s</a> - <span class="maddos-post-header-category">%s</a></span> <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></%s>',
						$header_tag,
						$site_icon,
						get_the_permalink(),
						$title,
						$cat_name,
						$header_tag
					); ?>

				</div>
				</div>
				</div>

				<div class="row">
				<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-link-content">

				<?php 
					get_template_part( 'post-content', 'list' );
				?>

				</div> <!-- end maddos-link-content -->
				</div>
				</div>

			</div> <!-- end maddos-link-container -->
		</div>
	</div>
</div>
</div>

<?php 
endwhile; 
?>

<div class="container">
<?php get_template_part( 'page-nav' ); ?>
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
