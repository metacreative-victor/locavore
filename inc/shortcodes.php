<?php
add_shortcode( 'page_files', 'shortcode_page_files' );
function shortcode_page_files( $params ) {
	extract( shortcode_atts( array(
    ), $params ) );

	if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    if( have_rows('page_files', $post_id) ) {
        $output = '<ul class="menu page-files">';
        while( have_rows('page_files', $post_id) ) {
            the_row();
            $file = get_sub_field('file');
            $file_url = get_sub_field('file_url');
            $f_title = '';
            $f_url = '';
            if( !empty( $file['url'] ) && !empty( $file['title'] ) ) {
                $f_title = $file['title'];
                $f_url = $file['url'];
            } elseif( !empty( $file_url['url'] ) && !empty( $file_url['title'] ) ) {
                $f_title = $file_url['title'];
                $f_url = $file_url['url'];
            }

            if( !empty( $f_url ) && !empty( $f_title ) ) {
                $output .= '<li><a href="' .esc_url( $f_url ). '" target="_blank">' .$f_title. '</a></li>';
            }
        }
        $output .= '</ul>';

        return $output;
    }
}