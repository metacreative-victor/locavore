<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>
	<div <?php post_class( 'page-container' ); ?>>
		<?php if( has_post_thumbnail() ) { ?>
			<div class="page-photo">
				<?php
				$background = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if( $background[0] ) {
					echo '<div class="page_photo__photo" style="background-image: url(' .esc_url( $background[0] ). ');"></div>';
				}

				$shop_page_id = wc_get_page_id( 'shop' );
				echo '<a href="' .get_permalink( $shop_page_id ). '" class="button-primary">' .__('Let\'s Shop', 'meta'). '</a>';
				?>
			</div>
			<!-- .page-photo -->
		<?php } ?>

		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
		<!-- .container -->
	</div>
	<!-- .page-container -->
<?php endwhile; ?>

<?php get_template_part( 'template-parts/sections/featured-produce' ); ?>

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();