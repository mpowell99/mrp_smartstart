<?php
/**
 * The footer template
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

?>

</section><!-- end #content -->

<footer id="footer" class="clearfix">

	<div class="container">

		<div class="three-fourth">

			<nav id="footer-nav" class="clearfix">

				<ul>
					<li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Our Team</a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
					<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>">Portfolio</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
				</ul>

			</nav><!-- end #footer-nav -->

			<ul class="contact-info">
				<li class="address">012 Some Street. New York, NY, 12345. USA</li>
				<li class="phone">(123) 456-7890</li>
				<li class="email"><a href="mailto:contact@companyname.com">contact@companyname.com</a></li>
			</ul><!-- end .contact-info -->

		</div><!-- end .three-fourth -->

		<div class="one-fourth last">

			<span class="title">Stay connected</span>

			<ul class="social-links">
				<li class="twitter"><a href="#">Twitter</a></li>
				<li class="facebook"><a href="#">Facebook</a></li>
				<li class="digg"><a href="#">Digg</a></li>
				<li class="vimeo"><a href="#">Vimeo</a></li>
				<li class="youtube"><a href="#">YouTube</a></li>
				<li class="skype"><a href="#">Skype</a></li>
			</ul><!-- end .social-links -->

		</div><!-- end .one-fourth.last -->

	</div><!-- end .container -->

</footer><!-- end #footer -->

<footer id="footer-bottom" class="clearfix">

	<div class="container">

		<ul>
			<li>SmartStart &copy; 2012</li>
			<li><a href="#">Legal Notice</a></li>
			<li><a href="#">Terms</a></li>
		</ul>

	</div><!-- end .container -->

</footer><!-- end #footer-bottom -->
<?php wp_footer(); ?>
</body>
</html>
