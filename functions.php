<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

/**
 * Set our global variables for theme options.
 *
 * @since emwptheme 0.1.0
 */
if ( ! isset( $emwptheme_theme_options ) ) {
    $emwptheme_theme_options = array( 'option_name' => 'emwptheme_theme_options' );
}

if ( ! isset( $emwptheme_theme_options_tabs ) ) {
    $emwptheme_theme_options_tabs = array();
}

if ( ! isset( $emwptheme_theme_options_hooks ) ) {
    $emwptheme_theme_options_hooks = array();
}

// define some vars.
$theme = wp_get_theme();
define( 'EMWPTHEME_VERSION', $theme->Version );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since emwptheme 0.1.0
 */
if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since emwptheme 0.1.0
 */
function emwptheme_theme_setup() {
    /**
     * Add our theme support options
     */
    $custom_header_args = array(
        'width' => 163,
        'height' => 76,
    );

    $custom_background_args = array(
        'deafult-color' => 'ffffff',
    );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header', $custom_header_args );
    add_theme_support( 'custom-background', $custom_background_args );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'align-wide' );

    /**
     * Add our image size(s)
     */
    add_image_size( 'navbar-logo', 163, 100, true );

    /**
     * Include theme meta page
     * Allows users to hook and filter into the default meta tags in the header
     */
    include_once( get_template_directory() . '/inc/theme-meta.php' );

    // register our navigation area.
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'emwptheme' ),
        )
    );

    /**
     * This theme styles the visual editor to resemble the theme style
     */
    add_editor_style( 'css/editor-style.css' );

}
add_action( 'after_setup_theme', 'emwptheme_theme_setup' );

/**
 * Register widget area.
 *
 * @since emwptheme 0.1.0
 */
function emwptheme_theme_widgets_init() {
    register_sidebar(
        array(
            'name' => 'Footer 1',
            'id' => 'footer-1',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer 2',
            'id' => 'footer-2',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'emwptheme_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since emwptheme 0.1.0
 */
function emwptheme_theme_scripts() {
    global $wp_scripts;

    wp_enqueue_script( 'emwptheme-theme-script', get_template_directory_uri() . '/js/emwptheme-theme.min.js', array( 'jquery' ), EMWPTHEME_VERSION, true );

    if ( is_singular() ) :
        wp_enqueue_script( 'comment-reply' );
    endif;

    /**
     * Load our IE specific scripts for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
     */
    // HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries.
    wp_register_script( 'html5shiv-script', get_template_directory_uri() . '/inc/js/html5shiv.min.js', array(), '3.7.3-pre' );
    wp_register_script( 'respond-script', get_template_directory_uri() . '/inc/js/respond.min.js', array(), '1.4.2' );

    $wp_scripts->add_data( 'html5shiv-script', 'conditional', 'lt IE 9' );
    $wp_scripts->add_data( 'respond-script', 'conditional', 'lt IE 9' );

    // enqueue our main stylesheet.
    wp_enqueue_style( 'emwptheme-style', get_stylesheet_uri(), '', EMWPTHEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'emwptheme_theme_scripts' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since emwptheme 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emwptheme_theme_post_thumbnail( $size = 'full' ) {
    global $post;

    $html = null;
    $attr = array(
        'class' => 'img-responsive',
    );

    if ( post_password_required() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        $html .= '<div class="post-thumbnail">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</div>';
    else :
        $html .= '<a class="post-thumbnail" href="' . get_permalink( $post->ID ) . '">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</a>';
    endif;

    $image = apply_filters( 'emwptheme_theme_post_thumbnail', $html, $size, $attr );

    echo wp_kses_post( $image );
}

/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since emwptheme 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emwptheme_theme_posted_on() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
        echo wp_kses_post( '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'emwptheme' ) . '</span>' );
    }

    // Set up and print post meta information. -- hide date if sticky.
    if ( ! is_sticky() ) :
        echo wp_kses_post( '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><a href="' . get_permalink() . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time></a></span>' );
    endif;

    echo wp_kses_post( '<span class="byline"><span class="glyphicon glyphicon-user"></span><span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . get_the_author() . '</a></span></span>' );
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since emwptheme 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function emwptheme_theme_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), esc_url( $pagenum_link ) );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(
        array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => esc_html_e( '&laquo; Previous', 'emwptheme' ),
            'next_text' => esc_html_e( 'Next &raquo;', 'emwptheme' ),
        )
    );

    if ( $links ) :
        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <div class="pagination loop-pagination">
                <?php echo wp_kses_post( $links ); ?>
            </div><!-- .pagination -->
        </nav><!-- .navigation -->
        <?php
    endif;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since emwptheme 1.0.1
 * @based on twentyfourteen
 *
 * @return void
 */
function emwptheme_theme_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    }

    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php
            if ( is_attachment() ) :
                previous_post_link( __( '<div class="published-in"><span class="meta-nav">Published In:</span> %link</div>', 'emwptheme' ), '%title' );
            else :
                previous_post_link( __( '<div class="prev-post"><span class="meta-nav">Previous Post:</span> %link</div>', 'emwptheme' ), '%title' );
                next_post_link( __( '<div class="next-post"><span class="meta-nav">Next Post:</span> %link</div>', 'emwptheme' ), '%title' );
            endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

/**
 * Display meta description.
 *
 * A custom function to display a meta description for our site pages
 *
 * @access public
 * @return string/bool
 */
function display_meta_description() {
    global $post;

    $title = null;

    if ( isset( $post->post_title ) ) {
        $title = $post->post_title;
    }

    if ( is_single() ) {
        return single_post_title( '', false );
    } else {
        return $title . ' - ' . get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
    }

    return false;
}

/**
 * Navbar.
 *
 * Adds our logo or text based on theme options
 *
 * @access public
 * @return void
 */
function emwptheme_theme_navbar_brand() {
    global $emwptheme_theme_options;

    $text = get_bloginfo( 'name' );

    if ( isset( $emwptheme_theme_options['default']['logo']['text'] ) && '' != $emwptheme_theme_options['default']['logo']['text'] ) {
        $text = $emwptheme_theme_options['default']['logo']['text'];
    }

    // display header image or text.
    if ( get_header_image() ) :
        echo wp_kses_post( '<img src="' . get_header_image() . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="" />' );
    else :
        echo wp_kses_post( '<a class="navbar-brand" href="' . home_url() . '">' . $text . '</a>' );
    endif;
}

/**
 * Bacok to top button
 *
 * @access public
 * @return void
 */
function emwptheme_back_to_top() {
    $html = null;

    $html .= '<a href="#0" class="emwptheme-back-to-top"></a>';

    echo $html;
}
add_action( 'wp_footer', 'emwptheme_back_to_top' );

/**
 * Custom parse args function.
 *
 * Similar to wp_parse_args() just a bit extended to work with multidimensional arrays
 *
 * @access public
 * @param mixed &$a (array).
 * @param mixed $b (array).
 * @return array
 */
function emwptheme_wp_parse_args( &$a, $b ) {
    $a = (array) $a;
    $b = (array) $b;
    $result = $b;
    foreach ( $a as $k => &$v ) {
        if ( is_array( $v ) && isset( $result[ $k ] ) ) {
            $result[ $k ] = emwptheme_wp_parse_args( $v, $result[ $k ] );
        } else {
            $result[ $k ] = $v;
        }
    }
    return $result;
}

/**
 * Get terms lis.
 *
 * @access public
 * @param bool $term (default: false).
 * @return string/bool
 */
function get_terms_list( $term = false ) {
    if ( ! $term ) {
        return false;
    }

    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    );
    $terms = get_terms( $term, $args );
    $html = null;

    if ( ! count( $terms ) ) {
        return false;
    }

    $html .= '<div class="term-wrapper term-' . $term . '">';
        $html .= '<h3 class="title">' . ucwords( $term ) . '</h3>';
        $html .= '<ul class="term-list term-list-' . $term . '">';
    foreach ( $terms as $t ) :
        if ( $t->count ) :
            $html .= '<li id="term-' . $t->term_id . '"><a href="/portfolio#' . $t->slug . '">' . $t->name . '</a></li>';
        else :
            $html .= '<li id="term-' . $t->term_id . '">' . $t->name . '</li>';
        endif;
            endforeach;
        $html .= '</ul>';
    $html .= '</div>';

    return $html;
}

/**
 * Gets the excerpt of a specific post ID or object
 *
 * @param - $post - object/int - the ID or object of the post to get the excerpt of.
 * @param - $length - int - the length of the excerpt in words.
 * @param - $tags - string - the allowed HTML tags. These will not be stripped out.
 * @param - $extra - string - text to append to the end of the excerpt.
 */
function get_post_excerpt_by_id( $post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .' ) {

    if ( is_int( $post ) ) {
        // get the post object of the passed ID.
        $post = get_post( $post );
    } elseif ( ! is_object( $post ) ) {
        return false;
    }

    if ( has_excerpt( $post->ID ) ) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters( 'the_content', $the_excerpt );
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes( strip_tags( $the_excerpt ), $tags );
    $the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
    $excerpt_waste = array_pop( $the_excerpt );
    $the_excerpt = implode( $the_excerpt );
    $the_excerpt .= $extra;

    return apply_filters( 'the_content', $the_excerpt );
}

/**
 * Has categories.
 *
 * @access public
 * @param string $excl (default: '').
 * @return bool
 */
function emwptheme_has_categories( $excl = '' ) {
    global $post;

    $categories = get_the_category( $post->ID );

    if ( ! empty( $categories ) ) :
        $exclude = $excl;
        $exclude = explode( ',', $exclude );

        foreach ( $categories as $key => $cat ) :
            if ( in_array( $cat->cat_ID, $exclude ) ) :
                unset( $categories[ $key ] );
            endif;
        endforeach;

        if ( count( $categories ) >= 1 ) :
            return true;
        endif;
    endif;

    return false;
}

/**
 * Post categories.
 *
 * @access public
 * @param string $spacer (default: ' ').
 * @param string $excl (default: '').
 * @return void
 */
function emwptheme_post_categories( $spacer = ' ', $excl = '' ) {
    global $post;

    $categories = get_the_category( $post->ID );

    if ( ! empty( $categories ) ) :
        $exclude = $excl;
        $exclude = explode( ',', $exclude );
        $thecount = count( get_the_category() ) - count( $exclude );

        foreach ( $categories as $cat ) :
            $html = '';

            if ( ! in_array( $cat->cat_ID, $exclude ) ) {
                $html .= '<a href="' . get_category_link( $cat->cat_ID ) . '" ';
                $html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';

                if ( $thecount > 0 ) {
                    $html .= $spacer;
                }

                $thecount--;

                echo wp_kses_post( $html );
            }
        endforeach;
    endif;
}
