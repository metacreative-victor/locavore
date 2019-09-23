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
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3406.114106368962!2d116.09283541455126!3d-31.38341708141512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2bcd3fa40b04406f%3A0x8deb9ef479667b07!2sNorthern%20Valleys%20Locavore%20Store!5e0!3m2!1sen!2s!4v1568899763265!5m2!1sen!2s" width="340" height="225" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				<!--<div id="map_canvas"></div>-->
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
				<p>&copy; <?php echo date('Y'); ?> Northern Valley Locavore Store. <a href="<?php echo get_permalink(335);?>">Privacy Policy</a>.</p>
			</div>
			<div class="col-md-6 text-right">
				<a href="#">Website by <a href="http://metacreative.com.au/" target="_blank">Meta Creative</a></a>
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

<?php
$google_maps_api = get_field( 'google_maps_api', 'option' );
$latitude = get_field( 'latitude', 'option' );
$longitude = get_field( 'longitude', 'option' );

if( !empty( $google_maps_api ) && !empty( $latitude ) && !empty( $longitude ) ) :
?>
<!-- GOOGLE MAPS -->
<script>
function initMap() {
    var isDraggable = window.innerWidth > 767 ? true : false;

    // Google Maps loader
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 16,
            center: new google.maps.LatLng( '<?php echo $latitude; ?>', '<?php echo $longitude; ?>' ),
            mapTypeId: google.maps.MapTypeId.ROADMAP,

            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true,
            navigationControl: false,
            mapTypeControl: true,
            scaleControl: true,
            draggable: isDraggable,
            styles: []
        });

        // create markers in google maps
        marker = new google.maps.Marker({
            position: new google.maps.LatLng( '<?php echo $latitude; ?>', '<?php echo $longitude; ?>' ),
            map: map
        });
    }
}
</script>
<script src="//maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api; ?>&callback=initMap" async="" defer="defer"></script>
<!-- END GOOGLE MAPS -->
<?php endif; ?>
</body>
</html>