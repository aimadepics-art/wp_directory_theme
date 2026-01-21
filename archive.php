<?php
/**
 * The main template file for all archive pages.
 */

get_header();

$grid = ot_get_option( 'grid_option', 'col-sm-' );
$layout = apply_filters( 'maddos_archive_layout', ot_get_option( 'archive_layout', 'list' ) );
?>

<div class="container">
	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
		<div class="maddos-link-container">
		<div class="maddos-link-header nocenter">

			<?php
			if ( is_day() ) {
				$h1 = sprintf( __( 'Date: %s Archive', 'maddos' ), get_the_date() );
			}
			else if ( is_month() ) {
				$h1 = sprintf( __( 'Month: %s Archive', 'maddos' ), get_the_date( _x( 'F Y', 'F = Month, Y = Year', 'maddos' ) ) );
			}
			else if ( is_year() ) {
				$h1 = sprintf( __( 'Year: %s Archive', 'maddos' ), get_the_date( _x( 'Y', 'Y = Year', 'maddos' ) ) );
			}
			else if ( is_category() ) {
				$term = get_category( get_query_var( 'cat' ) );
				$cat_icon = $term && function_exists( 'get_field' ) ? get_field('cat_icon', 'category_'.$term->term_id) : null;
				$icon = null;
				if ( filter_var( $cat_icon, FILTER_VALIDATE_URL ) ) : 
					$icon = '<span class="maddos-title-icon"><img alt="' . $term->name . '" title="' . $term->name . '" src="' . $cat_icon . '" /></span>';
				elseif ( $cat_icon ) : 
					$icon = '<span class="maddos-title-icon">' . $cat_icon . '</span>';
				endif;
				$h1 = sprintf( __( '%s %s', 'maddos' ), $icon, single_cat_title( '', false ));

				$description = category_description();
				$description = maddos_taxonomy_description( $description );

			}
			else if ( is_tag() ) {
				$h1 = sprintf( __( '%s Archive', 'maddos' ), single_tag_title( '', false ));
				$description = tag_description();
				$description = maddos_taxonomy_description( $description );
			}
			else if ( is_author() ) {
				$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author) );
				$h1 = sprintf( __( 'Author: %s Archive', 'maddos' ), $curauth->display_name );
			}
			else {
				$h1 = sprintf( __( '%s Archive', 'maddos' ), 'Unknown' );
			}
			?>
                        <?php
				if ( $layout !== 'directory' ) {
                                	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                	if ( $wp_query->max_num_pages != 1 ) $h1 .= ' - page ' . $paged . ' of ' . $wp_query->max_num_pages;
				}
                        ?>
			<h1 class="maddos-archive"><?php printf( "%s", $h1 );?></h1>
			<div class="maddos-link-header-back">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> <?php _e( 'Back To Home', 'maddos' ); ?></a>
			</div>
		</div>
			<?php
			if ( ! empty ( $description ) ) {
				echo '<div class="maddos-taxonomy-description">' . wp_kses_post( $description ) . '</div>';
			}
			?>
		</div>
		</div>


<?php 
	if ( $layout === 'grid' ) {
		get_template_part( 'content-archive', 'grid' );
	}
	else if ( $layout === 'list' ) {
		get_template_part( 'content-archive', 'list' );
	}
	else if ( $layout === 'directory' ) {
		get_template_part( 'page', 'directory' );
	}
?>



	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
