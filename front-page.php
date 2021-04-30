<?php
/**
 * Template Name: Front Page
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

?>
<?php get_header(); ?>

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <?php get_template_part( 'template-parts/content' ); ?>

    <?php endwhile; ?>

<?php
get_footer();
