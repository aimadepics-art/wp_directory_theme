<?php
/**
 * The page template file for Maddos theme
 */

get_header(); ?>

<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

<div class="container maddos-page">
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="row">
		<div class="<?php echo sanitize_html_class( $grid );?>12">
			<div id="post-<?php the_ID();?>" <?php post_class( 'maddos-link-container' );?>>
               			<div class="maddos-link-header nocenter"><a name="top"></a>
                       			<h1 class="maddos-post-header"><?php the_title();?></h1>
					<?php if ( ! is_home() && ! is_front_page() ) : ?>
						<div class="maddos-link-header-back">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back To Home</a>
						</div>
					<?php endif; ?>
               			</div>


              			<div class="maddos-link-content">
					<?php edit_post_link('Edit', '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> ', ''); ?>
               				<?php the_content();?>
					<?php wp_link_pages(); ?>
				</div>

				<div class="maddos-comments-container">
					<?php comments_template( '', true ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
