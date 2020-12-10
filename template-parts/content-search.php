<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage emdotnet
 * @since emdotnet 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php emdotnet_theme_post_thumbnail(); ?>

    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <?php if ( 'post' == get_post_type() ) : ?>

        <footer class="entry-footer">
            <?php emdotnet_theme_meta(); ?>
            <?php edit_post_link( __( 'Edit', 'emdotnet' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-footer -->

    <?php else : ?>

        <?php edit_post_link( __( 'Edit', 'emdotnet' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

    <?php endif; ?>

</article><!-- #post-## -->
