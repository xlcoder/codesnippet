/*
 *init them
 * @function 
 */

function hookScriptAndCss()
{
  wp_enqueue_style( 'example-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );
  wp_enqueue_script('example-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );
}

add_action("wp_enqueue_script", "hookScriptAndCss")

function headerCleanup() 
{
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // remove emojis
    remove_action( 'wp_print_styles', 'print_emoji_styles' );   // remove emojis
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // remove the / and previous post links
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove the REST API link
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // remove oEmbed discovery links
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 ); // remove the REST API link from HTTP Headers
    remove_action( 'wp_head', 'wp_oembed_add_host_js' ); // remove oEmbed-specific javascript from front-end / back-end
    remove_action('rest_api_init', 'wp_oembed_register_route'); // remove the oEmbed REST API route
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10); // don't filter oEmbed results
}

add_action('after_setup_theme', 'headerCleanup');



