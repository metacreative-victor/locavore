<?php
$facebook_url = get_field( 'facebook_url', 'option' );
$instagram_url = get_field( 'instagram_url', 'option' );
$pinterest_url = get_field( 'pinterest_url', 'option' );
?>
<!-- FOOTER -->
<footer id="site-footer">
    <div class="container">
        <div class="row">
			<div class="col-md-4">
				<div class="map-canvas">
					<img src="http://metastage.com.au/nvls/wp-content/uploads/2019/09/map-photo.png" alt="map">
				</div>
			</div>
			<div class="col-md-5">
				<?php if( !empty( $facebook_url ) || !empty( $instagram_url ) || !empty( $pinterest_url ) ) { ?>
					<ul class="socials">
						<li><span><?php _e('Follow us', 'meta'); ?></span></li>
						<?php
						if( !empty( $facebook_url ) ) {
							echo '<li><a href="' .esc_url( $facebook_url ). '" class="facebook"></a></li>';
						}
						
						if( !empty( $instagram_url ) ) {
							echo '<li><a href="' .esc_url( $instagram_url ). '" class="instagram"></a></li>';
						}
						
						if( !empty( $pinterest_url ) ) {
							echo '<li><a href="' .esc_url( $pinterest_url ). '" class="pinterest"></a></li>';
						}
						?>
					</ul>
				<?php } ?>

				<?php
				if( is_active_sidebar('footer-1') ) {
					dynamic_sidebar('footer-1');
				}
				?>
			</div>
			<div class="col-md-3 text-right">
				<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="button-primary"><?php _e('Let’s Shop', 'meta'); ?></a>
				<br><br>
				<?php
				if( is_active_sidebar('footer-2') ) {
					dynamic_sidebar('footer-2');
				}
				?>
			</div>
		</div>
		<!-- .row -->
		<div class="row copyright">
			<div class="col-md-6">
				<p>&copy; <?php echo date('Y'); ?> Northern Valley Locavore Store. <a href="#">Privacy Policy</a>.</p>
			</div>
			<div class="col-md-6 text-right">
				<a href="#">Website by <a href="http://metacreative.com.au/" target="_blanl">Meta Creative</a></a>
			</div>
		</div>
	</div>
	<!-- .container -->
</footer>
<!-- END FOOTER -->

<!-- MODAL -->
<div class="modal fade" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
				<div id="quick-view-content"></div>
			</div>
			<!-- .modal-body -->
		</div>
	</div>
</div>
<!-- END MODAL -->

<?php
wp_footer();

$tracking_code = get_field( 'footer_code', 'option' );

if( !empty( $tracking_code ) ) {
    echo $tracking_code;
}
?>
</body>
</html>