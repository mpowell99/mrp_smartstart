<?php
/**
 * An archive page for team members
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header();

// get team members
?>

	<header class="page-header">
		<h1 class="page-title align-left"><?php echo get_theme_mod( 'team_title' ); ?></h1>
		<hr />
		<?php
			$team_description = get_theme_mod( 'team_description' );
			if ( $team_description ) {
				?>
		<h2 class="page-subdescription"><?php echo $team_description; ?></h2>
				<?php
			}
		?>
	</header><!-- end .page-header -->


	<?php
		if ( have_posts() ) {
			/* Start the Loop */
			while ( have_posts() ) {
				the_post();
	?>
	<div class="team-member one-fourth">
		<img src="<?php esc_url( the_post_thumbnail_url() ); ?>" alt="" class="photo">
		<div class="content">
			<h4 class="name"><?php the_title(); ?></h4>
            <?php
                $the_position = get_post_meta( get_the_ID(), 'position', TRUE );
                if ($the_position) {
                    echo '
			<span class="job-title">'.$the_position.'</span>';
                }
                echo the_excerpt();
            ?>
		</div><!-- end .content -->
		<ul class="social-links">
			<?php
				$social_arr = array(
					'twitter' => 'Twitter',
					'facebook' => 'Facebook',
					'skype' => 'Skype',
					'linkedin' => 'LinkedIn',
					'googleplus' => 'Google+',
					'email' => 'E-Mail',
				);
				foreach( $social_arr as $social_key => $social_val ) {
					$social_link = get_post_meta( get_the_ID(), $social_key, TRUE );
					if ( $social_link ) {
						echo '<li class="'.$social_key.'"><a href="'.esc_url( $social_link ).'">'.$social_val.'</a></li>';
                        /*
						echo '<li class="'.$social_key.'"><a href="';
                        echo esc_url( $social_link );
                        echo '">'.$social_val.'</a></li>';
                        */
					}
				}
			?>
		</ul><!-- end .social-links -->

	</div><!-- end .team-member.one-fourth -->
	<?php
			}
        }
	?>

<?php get_footer();
