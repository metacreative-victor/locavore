<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<section id="subscribe" class="page-section">
    <p class="subscribe-text"><?php _e('Keep up-to-date with the latest fresh produce', 'meta'); ?></p>
    <?php echo do_shortcode( '[gravityforms id="2" title="false" description="false" ajax="true"]' ); ?>
</section>
<!-- #subscribe -->