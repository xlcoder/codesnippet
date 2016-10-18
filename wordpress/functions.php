/*
 *init them
 * @function 
 */

//clean theme header load
function hookScriptAndCss()
{
  wp_enqueue_style( 'example-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );
  wp_enqueue_script('example-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );
}

add_action("wp_enqueue_script", "hookScriptAndCss")

function headerCleanup() 
{
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // remove emojis
    remove_action( 'wp_print_styles', 'print_emoji_styles' );   // remove emojis
    remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}

add_action('after_setup_theme', 'headerCleanup');

//Modify excerpt length and more style
function custom_excerpt_more( $more ) {
    return "";
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

function custom_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Remove Admin bar
add_filter('show_admin_bar', 'remove_admin_bar'); 
