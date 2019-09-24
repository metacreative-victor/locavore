<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php
	$favicon = get_field( 'favicon', 'option' );

	if( !empty( $favicon ) && !empty( $favicon['url'] ) && !empty( $favicon['mime_type'] ) ) {
		echo '<link rel="shortcut icon" href="' .esc_url( $favicon['url'] ). '" type="' .esc_attr( $favicon['mime_type'] ). '">';
	}
	?>

	<link href="https://fonts.googleapis.com/css?family=Copse|Open+Sans:400,400i,600,600i,700,700i&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

	<?php
	$tracking_code = get_field( 'header_code', 'option' );

	if( !empty( $tracking_code ) ) {
		echo $tracking_code;
	}
	?>
</head>

<body <?php body_class(); ?>>
	<!-- HEADER -->
	<header id="site-header">
		<div class="container-fluid">
			<div class="header-menu">
				<div class="mini-cart">
					<a href="<?php echo wc_get_cart_url(); ?>" class="button-cart"><span class="badge"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
				</div>

				<?php
				if( has_nav_menu('secondary') ) {
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'menu_class' => 'menu menu-secondary',
						'container' => ''
					));
				}
				?>
				
				<?php if (is_user_logged_in()) { ?>
	<a href="<?php echo esc_url( home_url('/') ); ?>my-account/" class="button-primary"><?php _e('Dashboard', 'meta'); ?></a>
<?php } else { ?>
	<a href="<?php echo esc_url( home_url('/') ); ?>my-account/" class="button-primary"><?php _e('Login', 'meta'); ?></a>
<?php } ?>

				
				<a href="<?php echo esc_url( home_url('/') ); ?>sell-your-produce" class="button-primary"><?php _e('Sell Your Produce', 'meta'); ?></a>
			</div>
			<!-- .header-menu -->

			<a href="<?php echo esc_url( home_url('/') ); ?>" class="logo">
				<img src="<?php echo META_THEME_URL; ?>/assets/images/logo.png" alt="logo" width="280" height="41">
			</a>
		</div>
		<!-- .container-fluid -->
	</header>
	<!-- END HEADER -->

	<!-- NAVIGATION -->
	<nav id="site-navigation">
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="hidden" name="post_type" value="product">
			<input type="search" placeholder="<?php echo esc_attr_x( 'Search local produce...', 'placeholder', 'meta' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</form>

		<button type="button" data-toggle="collapse" data-target="#collapse-navigation" class="toggle-navigation collapsed d-lg-none">
			<span></span><span></span><span></span>
		</button>

		<div id="collapse-navigation">
			<?php
			if( has_nav_menu('primary') ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class' => 'menu menu-primary',
					'container' => ''
				));
			}
			?>
		</div>
	</nav>
	<!-- END NAVIGATION -->