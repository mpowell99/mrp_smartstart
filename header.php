<?php
/**
 * The header template
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html class="not-ie no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head() ?>
</head>
<body <?php body_class(); ?>>

<header id="header" class="container clearfix">
    <?php
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }

        $navmenu_options = array(
            'theme_location' => 'header-menu',
            'container' => 'div',
            'container_id' => 'main-nav'
        );
        wp_nav_menu( $navmenu_options );
    ?>
</header><!-- end #header -->

<section id="content" class="container clearfix">
