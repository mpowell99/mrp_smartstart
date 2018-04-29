<?php
/**
 * The landing page of the website. Displays:
 *   a) Slogan
 *   b) Featured Projects
 *   c) Non-featured Projects Carousel
 *   d) Blog Entries Carousel
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<h2 class="slogan align-center"><?php echo get_theme_mod('site_slogan'); ?></h2>

	<section id="features-slider" class="ss-slider">
        <?php
            // get featured projects
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 4,
				'posts_limits' => 4,
				'meta_key' => 'mrp_isfeatured',
				'meta_value' => 'on',
            );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
                $i = 0;
                while ( $loop->have_posts() ) {
                    $i++;
                    $loop->the_post(); ?>

		<article class="slide">
            <?php the_post_thumbnail( 'feature-slider', array( 'class'=>'slide-bg-image' ) ); ?>

			<div class="slide-button">
				<span class="dropcap"><?php echo $i; ?></span>
				<h5><?php the_title(); ?></h5>
			</div>

			<div class="slide-content">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<p><a class="button" href="<?php the_permalink(); ?>">Read More</a></p>
			</div>
        </article>

        <?php
                }
            }
        ?>
	</section><!-- end #features-slider -->

	<h6 class="section-title">Latest Projects</h6>

	<ul class="projects-carousel clearfix">
        <?php
            // get non-featured projects
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
				'meta_key' => 'mrp_isfeatured',
				'meta_compare' => 'NOT EXISTS',
            );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
                $i = 0;
                while ( $loop->have_posts() ) {
                    $i++;
                    $loop->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'portfolio-thumb' ); ?>
				<h5 class="title"><?php the_title(); ?></h5>
				<span class="categories"><?php echo mrp_termlist( 'disciplines', ' / ' ); ?></span>
			</a>
		</li>
        <?php
                }
            }
        ?>
	</ul><!-- end .projects-carousel -->

	<h6 class="section-title">Latest Articles from Our Blog</h6>

	<ul class="post-carousel">
        <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
            );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
                $i = 0;
                while ( $loop->have_posts() ) {
                    $i++;
                    $loop->the_post(); ?>

		<li>
			<a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'portfolio-thumb' ); ?>
			</a>

			<div class="entry-meta">
				<a href="<?php the_permalink(); ?>">
					<span class="post-format">Permalink</span>
				</a>

				<span class="date"><?php the_date( "M d, Y" ); ?></span>
			</div><!-- end .entry-meta -->

			<div class="entry-body">
				<a href="<?php the_permalink(); ?>">
					<h5 class="title"><?php the_title(); ?></h5>
				</a>
                <?php the_excerpt(); ?>
			</div><!-- end .entry-body -->
		</li>
        <?php
                }
            }
        ?>
	</ul><!-- end .post-carousel -->

<?php get_footer(); ?>
