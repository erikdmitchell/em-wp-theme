<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */
?>
<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <h1 class="page-title"><?php _e( 'Not Found', 'emwptheme' ); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <h2><?php _e( "This is somewhat embarrassing, isn't it?", 'emwptheme' ); ?></h2>
        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'emwptheme' ); ?></p>

        <?php get_search_form(); ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->

<?php
get_footer();
