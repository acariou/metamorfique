<?php
/**
* Plugin Name: Latest Post
* Plugin URI: https://www.your-plugins-site.com/
* Description: Show the latest published post.
* Version: 0.1
* Author: your-name
* Author URI: https://www.your-site.com/
**/

// register the shortcode
add_shortcode('latest_post', 'latest_post_shortcode');
 
// define the shortcode function
function latest_post_shortcode() {
 
    // check if the transient is set, and if not, get the latest post, and set the transient
    if ( false === ( $latest_post = get_transient( 'latest_post' ) ) ) {
        $latest_post = get_posts()[0];
        set_transient( 'latest_post', $latest_post, WEEK_IN_SECONDS );
    }
 
    // return the title of the latest post
    return $latest_post->post_title;
}

// add action hook to remove transient on post save
add_action('save_post', 'latest_post_transient');
 
// define the function to remove transient
function latest_post_transient() {
    delete_transient('latest_post');
}