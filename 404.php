<?php get_header(); ?>

<div class="page-container">
	<div class="container">
		<div class="entry-content">
			<h3><?php _e( 'Oops! That page can&rsquo;t be found.', 'meta' ); ?></h3>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'meta' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
	<!-- .container -->
</div>
<!-- .page-container -->

<?php
get_footer();