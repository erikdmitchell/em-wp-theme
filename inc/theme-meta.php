<?php
/**
 * emwptheme_theme_meta function.
 *
 * adds default theme meta to header
 * hooks directly after meta robots
 *
 * @access public
 * @return void
 */
function emwptheme_theme_meta() {

    echo apply_filters( 'emwptheme_meta_charset', '<meta charset="' . get_bloginfo( 'charset' ) . '" />' . "\n" );
    echo apply_filters( 'emwptheme_meta_http-equiv', '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n" );
    echo apply_filters( 'emwptheme_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n" );
    echo apply_filters( 'emwptheme_meta_description', '<meta name="description" content="' . display_meta_description() . '">' . "\n" );
    echo apply_filters( 'emwptheme_meta_author', '<meta name="author" content="">' . "\n" );

}
add_action( 'wp_head', 'emwptheme_theme_meta', 1 );

/**
 * emwptheme_disable_seo_meta function.
 *
 * checks for Yoast SEO and removes description meta
 * fires on 0 so that's it's before our meta
 *
 * @access public
 * @return void
 */
function emwptheme_disable_seo_meta() {
    if ( defined( 'WPSEO_VERSION' ) ) :
        add_filter( 'emwptheme_meta_description', 'disable_emwptheme_meta_description', 10, 1 );
    endif;
}
add_action( 'wp_head', 'emwptheme_disable_seo_meta', 0 );

/**
 * disable_emwptheme_meta_description function.
 *
 * simply returns a null value so no description is output
 *
 * @access public
 * @param mixed $meta
 * @return null
 */
function disable_emwptheme_meta_description( $meta ) {
    return null;
}

