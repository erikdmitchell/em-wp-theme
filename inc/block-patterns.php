<?php
/**
 * Block Patterns
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_pattern/
 * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/
 *
 * @package EMWPT_Blocks
 * @since 0.1
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

    register_block_pattern_category(
        'emwpt-blocks',
        array( 'label' => esc_html__( 'EMWPT Blocks', 'emwpt-blocks' ) )
    );
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {

    register_block_pattern(
        'emwpt-blocks/contact-information',
        array(
            'title'       => esc_html__( 'Contact Information', 'emwpt-blocks' ),
            'categories'  => array( 'emwpt-blocks' ),
            'description' => esc_html_x( 'A block with 3 columns that display contact information and social media links.', 'Block pattern description', 'emwpt-blocks' ),
            'content'     => '<!-- wp:columns {"align":"wide"} --><div class="wp-block-columns alignwide"><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p><a href="mailto:#">' . esc_html__( 'example@example.com', 'emwpt-blocks' ) . '<br></a>' . esc_html__( '123-456-7890', 'emwpt-blocks' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">' . esc_html__( '123 Main Street', 'emwpt-blocks' ) . '<br>' . esc_html__( 'Cambridge, MA, 02139', 'emwpt-blocks' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:social-links {"align":"right"} --><ul class="wp-block-social-links alignright"><!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /--><!-- wp:social-link {"url":"https://www.facebook.com/WordPress/","service":"facebook"} /--><!-- wp:social-link {"url":"https://twitter.com/WordPress","service":"twitter"} /--><!-- wp:social-link {"service":"instagram"} /--><!-- wp:social-link {"service":"linkedin"} /--><!-- wp:social-link {"service":"youtube"} /--><!-- wp:social-link {"url":"https://www.youtube.com/wordpress","service":"youtube"} /--></ul><!-- /wp:social-links --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:paragraph --><p></p><!-- /wp:paragraph -->',
        )
    );
}
