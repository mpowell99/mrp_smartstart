<?php
/**
 * Customized contact page template, with map, address and contact form
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<div class="container clearfix">
		<header class="page-header">
			<h1 class="page-title"><?php echo get_theme_mod( 'contact_title' ); ?></h1>
		</header><!-- end .page-header -->
    </div>

	<section id="map">
		<p class="container">Something went wrong... Try to enable your JavaScript!</p>
	</section><!-- end #map -->

	<div class="container clearfix">
		<div class="one-fourth">
			<h3>Contact Info</h3>

			<?php echo get_theme_mod( 'contact_address' ); ?>
		</div><!-- end .one-fourth -->

		<div class="three-fourth last">
			<h3><?php echo get_theme_mod( 'contact_formhead' ); ?></h3>

            <?php
                if ( have_posts() ) {
                    the_post();
                    the_content();
                }
            ?>

		</div><!-- end .three-fourth.last -->

	</div><!-- end .container -->

<?php get_footer(); ?>
