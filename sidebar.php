<?php
/**
 * Sidebar Template
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<aside id='sidebar'>

    <?php
        /* Add a class to the widget list */
        if ( function_exists( 'dynamic_sidebar' ) ) {
            ob_start();
            dynamic_sidebar( 'sidebar-mrp' );
            $sidebar = ob_get_contents();
            ob_end_clean();

            $sidebar_corrected_ul = str_replace( "<ul>", '<ul class="categories">', $sidebar );
            echo $sidebar_corrected_ul;
        }
    ?>

</aside>
