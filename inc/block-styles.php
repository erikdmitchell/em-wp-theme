<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package EMWPT_Blocks
 * @since 1.0.0
 */

if ( function_exists( 'register_block_style' ) ) {
    /**
     * Register block styles.
     *
     * @since 0.1
     *
     * @return void
     */
    function twenty_twenty_one_register_block_styles() {
        // Columns: Overlap.
        register_block_style(
            'core/columns',
            array(
                'name'  => 'twentytwentyone-columns-overlap',
                'label' => esc_html__( 'Overlap', 'emwpt-blocks' ),
            )
        );

        // Cover: Borders.
        register_block_style(
            'core/cover',
            array(
                'name'  => 'twentytwentyone-border',
                'label' => esc_html__( 'Borders', 'emwpt-blocks' ),
            )
        );

        // Image: Borders.
        register_block_style(
            'core/image',
            array(
                'name'  => 'twentytwentyone-border',
                'label' => esc_html__( 'Borders', 'emwpt-blocks' ),
            )
        );

        // Image: Frame.
        register_block_style(
            'core/image',
            array(
                'name'  => 'twentytwentyone-image-frame',
                'label' => esc_html__( 'Frame', 'emwpt-blocks' ),
            )
        );

        // Latest Posts: Dividers.
        register_block_style(
            'core/latest-posts',
            array(
                'name'  => 'twentytwentyone-latest-posts-dividers',
                'label' => esc_html__( 'Dividers', 'emwpt-blocks' ),
            )
        );

        // Latest Posts: Borders.
        register_block_style(
            'core/latest-posts',
            array(
                'name'  => 'twentytwentyone-latest-posts-borders',
                'label' => esc_html__( 'Borders', 'emwpt-blocks' ),
            )
        );

        // Media & Text: Borders.
        register_block_style(
            'core/media-text',
            array(
                'name'  => 'twentytwentyone-border',
                'label' => esc_html__( 'Borders', 'emwpt-blocks' ),
            )
        );

        // Separator: Thick.
        register_block_style(
            'core/separator',
            array(
                'name'  => 'twentytwentyone-separator-thick',
                'label' => esc_html__( 'Thick', 'emwpt-blocks' ),
            )
        );
    }
    add_action( 'init', 'twenty_twenty_one_register_block_styles' );
}
