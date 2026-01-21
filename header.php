<?php
/**
 * The Header template for theme Maddos
 */
?>
<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

	<?php $grid = ot_get_option( 'grid_option', 'col-sm-' ); ?>

	<?php $infobar = apply_filters( 'maddos_infobar', ot_get_option( 'infobar_text' ) ); if ( $infobar ) : ?>
		<div class="maddos-infobar">
			<?php echo wp_kses_post( $infobar ); ?>
		</div>
	<?php endif; ?>

	<div class="container maddos-header-container">
	<div class="maddos-header">


		<?php $menu = apply_filters( 'maddos_header_menu', wp_nav_menu( array( 'theme_location' => 'header-menu', 'depth' => 2, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'header-collapse', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker(), 'echo' => false ) ), 'header-menu' ); ?>
		<?php if ( $menu ) : ?>

		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">
				<div class="maddos-menu clearfix">

				
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo wp_kses_post( $menu ); ?>
				</div>
			</div>
		</div>

		<?php endif; ?>

		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">
				<?php if ( apply_filters( 'maddos_show_searchform', ot_get_option( 'header_show_searchform', 'on' ) ) === 'on' ) : ?>
					<div class="maddos-search">
					<?php get_search_form(); ?>
					</div>
				<?php endif; ?>

				<?php $header_img_html = get_header_image_tag( array( 'class' => 'img-responsive' ) ); if ( $header_img_html ) : ?>
				<?php $link_header_img_to_home = ot_get_option( 'link_header_image', 'off' ); ?>
				<?php if ( $link_header_img_to_home === 'on' ) $header_img_html = '<a href="' . esc_url( home_url( '/' ) ) . '">' . $header_img_html . '</a>'; ?>
				<div class="maddos-header-image">
					<?php echo wp_kses_post( $header_img_html ) ; ?>

				</div>
				<?php endif; ?>

				<?php 
				$show_content_header = ot_get_option( 'show_header_content', 'on' ); 
				if ( $show_content_header === 'on' ) : 
					$title_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
					$desc_tag = ( is_home() || is_front_page() ) ? 'h2' : 'div';
					$title_tag = apply_filters( 'maddos_header_title_htag', $title_tag );
					$desc_tag = apply_filters( 'maddos_header_desc_htag', $desc_tag );

					$content_class = $header_img_html ? "maddos-header-overlay" : "maddos-header-content";
				?>
					<div class="<?php echo sanitize_html_class( $content_class );?>">
					<<?php echo esc_html( $title_tag );?> id="maddos-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></<?php echo esc_html( $title_tag );?>>
					<<?php echo esc_html( $desc_tag );?> id="maddos-site-desc"><?php bloginfo( 'description' ); ?></<?php echo esc_html( $desc_tag );?>>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php $headline = apply_filters( 'maddos_headline_text', ot_get_option( 'headline_text', '' ) ); if ( $headline ) : ?>
		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">
					<div class="maddos-headline"><?php echo wp_kses_post( $headline );?></div>
			</div>
		</div>
		<?php endif; ?>

		<?php 
		$show_sidebar = is_active_sidebar( 'maddos-header-area' );
		$show_sidebar = apply_filters( 'maddos_dynamic_sidebar_header', $show_sidebar, 'maddos-header-area' ); 
		if ( $show_sidebar ) : 
		?>
		<div class="row">
			<div class="<?php echo sanitize_html_class( $grid );?>12">
				<?php get_sidebar('header'); ?>
			</div>
		</div>
		<?php endif; ?>

        </div>
        </div>
