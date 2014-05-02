		</div>
		</div>
		<footer class="site-footer" role="contentinfo">
			<div class="site-footer-component">
				<h3>Subscribed yet?</h3>
				<p class="site-footer-text">Get new blog posts delivered to your inbox by typing your email address into the box below. Or <a href="/feed/">use the feed URL</a>.</p>
				<?php $status = isset( $_REQUEST['subscribe'] ) ? $_REQUEST['subscribe'] : false; ?>
				<?php if ( $status == 'invalid_email' ) : ?>
					<p class="site-footer-text">You’ve entered an invalid email address, please try again.</p>
				<?php elseif ( $status == 'success' ) : ?>
					<p class="site-footer-text">Thank you for subscribing! &hearts; Please check your email to confirm.</p>
				<?php else : ?>
					<form class="subscribe-form" method="POST">
						<input type="hidden" name="my-form-action" value="subscribe" />
						<input type="email" class="subscribe-form-input" name="my-email" onblur="if (this.value == '') {this.value = 'Type your email address';}" onfocus="if (this.value == 'Type your email address') {this.value = '';}" value="Type your email address" placeholder="Type your email address" />
						<button class="subscribe-form-submit" type="submit">Go!</button>
					</form>
				<?php endif; ?>
				<p class="site-footer-text">If you wanna say hi, <a href="/contact/">holla@</a> is the way to go.</p>
			</div>
			<div class="site-footer-component">
				<h3>The Manifesto</h3>
				<p class="site-footer-text">Because I believe in a lot of things (like magic), and because everyone is a friend unless proven otherwise, and because laser guns are cool, I wrote <a href="/lzrgun-manifesto/">The LZRGUN Manifesto</a> to illustrate more of my personality rather than a <a href="/about/">typical biography</a>.</p>
				<p class="site-footer-text">&uarr; <a href="#site-top">here’s a cool “jump to top” link</a></p>
			</div>
			<div class="site-footer-component">
				<h3>bermuda</h3>
				<p class="site-footer-text">I’m in love with this little band called Hey Geronimo from the sunny city of Brisbane. This theme was built with a lot of magic &amp; love, and is named <em>bermuda</em> after a funky little song they wrote, the colours inspired by a poster of theirs on my wall.</p>
				<p class="site-footer-text">&copy; Hey Georgie, 2007-<?php $year = date("Y"); echo $year; ?></p>
			</div>
		</footer>
		<?php wp_footer(); ?>
		<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
	</body>
</html>