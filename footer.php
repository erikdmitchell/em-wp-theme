<?php
/**
 * The template for the footer
 *
 * @package WordPress
 * @subpackage emwptheme
 * @since emwptheme 0.1.0
 */

?>
        <footer>
            <div class="footer-content">
                <div class="footer-widgets">
                    <div class="footer-widget footer-widget-1"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="footer-widget footer-widget-2"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                </div>
                <div class="copyright"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?> &copy; <?php echo esc_attr( gmdate( 'Y' ) ); ?></div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
