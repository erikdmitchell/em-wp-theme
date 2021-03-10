<?php
/**
 * Theme meta functions.
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

/**
 * Theme meta function.
 *
 * Adds default theme meta to header
 * Hooks directly after meta robots
 *
 * @access public
 * @return void
 */
function emwptheme_theme_meta() {

    echo wp_kses_post( apply_filters( 'emwptheme_meta_charset', '<meta charset="' . get_bloginfo( 'charset' ) . '" />' . "\n" ) );
    echo wp_kses_post( apply_filters( 'emwptheme_meta_http-equiv', '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n" ) );
    echo wp_kses_post( apply_filters( 'emwptheme_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n" ) );
    echo wp_kses_post( apply_filters( 'emwptheme_meta_description', '<meta name="description" content="' . display_meta_description() . '">' . "\n" ) );
    echo wp_kses_post( apply_filters( 'emwptheme_meta_author', '<meta name="author" content="">' . "\n" );

}
add_action( 'wp_head', 'emwptheme_theme_meta', 1 );

/**
 * Disable Yoast SEO meta.
 *
 * Checks for Yoast SEO and removes description meta
 * Fires on 0 so that's it's before our meta
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
 * Disable theme meta description.
 *
 * Simply returns a null value so no description is output
 *
 * @access public
 * @param mixed $meta
 * @return null
 */
function disable_emwptheme_meta_description( $meta ) {
    return null;
}

