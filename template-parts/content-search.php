<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php emwptheme_theme_post_thumbnail(); ?>

    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <?php if ( 'post' == get_post_type() ) : ?>

        <footer class="entry-footer">
            <?php emwptheme_theme_meta(); ?>
        </footer><!-- .entry-footer -->

    <?php endif; ?>

</article><!-- #post-## -->
