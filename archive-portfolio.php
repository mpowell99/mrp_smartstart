<?php
/**
 * An archive page for projects in the portfolio
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header();

// get projects
// we call a new loop, to overwrite the "3 posts per page" default
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => -1,
);
$loop = new WP_Query( $args );
?>

	<header class="page-header">
		<h1 class="page-title"><?php echo get_theme_mod( 'portfolio_title' ); ?></h1>

		<?php
			$portfolio_description = get_theme_mod( 'portfolio_description' );
			if ($portfolio_description) {
				?>
		<h2 class="page-subdescription"><?php echo $portfolio_description; ?></h2>
				<?php
			}
		?>

		<ul id="portfolio-items-filter">
			<li>Showing</li>
			<li><a data-categories="*">All</a></li>
			<?php
				$disciplines = get_terms( array( 'taxonomy' => 'disciplines' ));
				foreach ( $disciplines as $key => $discipline ) {
					echo '
			<li><a data-categories="'.$discipline->slug.'">'.$discipline->name.'</a></li>';
				}
			?>

		</ul><!-- end #portfolio-items-filter -->

	</header><!-- end .page-header -->

	<section id="portfolio-items" class="clearfix">

		<?php
			if ( $loop->have_posts() ) {
				/* Start the Loop */
				while ( $loop->have_posts() ) {
					$loop->the_post();
		?>
		<article class="one-third <?php echo mrp_termlist( 'disciplines', ' ', TRUE ); ?>" data-categories="<?php echo mrp_termlist( 'discipline', ' ', TRUE ); ?>">

			<a href="<?php esc_url ( the_post_thumbnail_url() ); ?>" class="single-image" title="<?php the_title(); ?>">
				<?php esc_url ( the_post_thumbnail( 'portfolio-archive' ) ); ?>
			</a>

			<a href="<?php esc_url ( the_permalink() ); ?>" class="project-meta">
				<h5 class="title"><?php the_title(); ?></h5>
				<span class="categories"><?php echo mrp_termlist( 'disciplines', ' / ' ); ?></span>
			</a>

		</article><!-- end .one-third (Altered) -->
		<?php
				}
			}
		?>
	</section><!-- end #portfolio-tiems -->

<?php get_footer(); ?>
