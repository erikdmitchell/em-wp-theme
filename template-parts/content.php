<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search. -- Currently page.php and index.php
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php emwptheme_theme_post_thumbnail(); ?>
    <header class="entry-header">
        <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
        endif;
        ?>

        <div class="entry-meta">
            <?php
            if ( 'post' == get_post_type() ) {
                emwptheme_theme_posted_on();
            }

            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
                ?>
                    <span class="comments-link"></span><?php comments_popup_link( __( 'Leave a comment', 'emwptheme' ), __( '1 Comment', 'emwptheme' ), __( '% Comments', 'emwptheme' ) ); ?></span>
                <?php
                endif;

                edit_post_link( __( 'Edit', 'emwptheme' ), '<span class="edit-link">', '</span>' );
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php
            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'emwptheme' ) );
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'emwptheme' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )
            );
        ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <div class="entry-meta">
        <?php if ( has_tag() ) : ?>
            <div class="tags-list">
                <div class="tags-title">Tags</div>
                
                <?php the_tags( '<div class="tag-links">', ' ', '</div>' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( emwptheme_has_categories() ) : ?>
            <div class="categories-list">
                <div class="categories-title">Categories</div>
            
                <div class="categories-link">
                    <?php emwptheme_post_categories( ' ', 1 ); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
                        
</article><!-- #post-## -->
