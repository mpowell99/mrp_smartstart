<?php
/**
 * Template for Single Project in Portfolio
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<article class="single-project">

		<header class="page-header">

			<h1 class="page-title align-left"><?php echo get_theme_mod( 'portfolio_title' ); ?></h1>

			<a href="<?php echo esc_url( home_url('/portfolio/') ); ?>" class="button no-bg medium align-right">
				All Projects <img src="<?php echo esc_url ( MRP_THEME_URI . '/assets/img/icon-grid.png'); ?>" alt="" class="icon">
			</a>

			<hr />

			<h2 class="project-title">Single Project / <?php the_title(); ?></h2>

			<ul class="portfolio-pagination">
				<li class="prev"><?php previous_post_link( '%link', '<span class="arrow left">&raquo;</span> Previous' ); ?></li>
				<li class="next"><?php next_post_link( '%link', 'Next <span class="arrow">&raquo;</span>' ); ?></li>
			</ul><!-- end .portfolio-pagination -->

		</header><!-- end .page-header -->

		<div id="main">
			<div class="image-gallery-slider">
				<ul>
                    <?php
                        $media = get_attached_media( 'image' );
                        foreach ( $media as $key => $img_obj ) {
                            $img_info = wp_get_attachment_image_src( $img_obj->ID, 'portfolio-large' );
                            echo '
        					<li>
        						<a href="'.esc_url( $img_info[0] ).'" class="single-image" title="'.get_the_title().'" rel="single-project">
        							<img src="'.$img_info[0].'" alt="'.get_the_title().'">
        						</a>
        					</li>';
                        }
                    ?>
				</ul>

			</div><!-- end .image-gallery-slider -->

		</div><!-- end #main -->

		<div id="sidebar">

			<h4>Overview</h4>

            <?php the_post(); the_content(); ?>

			<h4>Things We Did</h4>

			<ul class="check">
                <?php
	                $skills = get_the_terms( get_the_ID(), 'skills' );
    				foreach ( $skills as $key => $skill ) {
    					echo '
             <li>'.$skill->name.'</li>';
                    }
                ?>
			</ul>

			<?php
				$the_website = get_post_meta( get_the_ID(), 'website', TRUE);
				if ($the_website) {
					?>
			<p>
				<a href="<?php echo esc_url( $the_website ); ?>" class="button">Launch Website</a>
			</p>
					<?php
				}
			?>

		</div><!-- end #sidebar -->

	</article><!-- end .single-project -->

<?php
get_footer();
?>
