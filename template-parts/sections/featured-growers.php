<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<section id="featured-growers" class="page-section">
    <div class="container">
        <h2 class="section-heading text-center"><?php _e('Featured Growers', 'meta'); ?></h2>
        <div class="row">
			<?php 
				query_posts(array( 
					'post_type' => 'grower',
					'showposts' => 2,
					'orderby' => rand
				) );  
			?>
			<?php while (have_posts()) : the_post(); ?>
			<div class="col-lg-6">
				<div class="post-item inline">
					<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
					<div class="post-item__photo" style="background-image: url('<?php echo $featured_img_url;?>');"></div>
					<div class="post-item__text">
						<p class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
						<p class="description"><?php echo get_the_excerpt(); ?></p>
						<a href="<?php the_permalink() ?>" class="button-primary">View</a>
					</div>
				</div>
			</div>
			<?php endwhile;?>
			
			<?php wp_reset_query() ?>
        </div>
        <!-- .row -->
    </div>
</section>
<!-- #featured-growers -->