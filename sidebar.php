		<aside class="site-sidebar">
			<a href="/" class="site-logo">Hey Georgie</a>
			<div class="site-search">
				<?php get_search_form(); ?>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">holla@</h3>
				<p class="site-sidebar-text">I’m Georgie. I code during the day and photograph bands at night. I love waffles, noodles &amp; tea. I write about fashion, music, getting through life, and finding hidden gems in Sydney.</p>
				<a class="site-sidebar-icon" href="http://twitter.com/georgiecel"><i class="icon-twitter"></i></a>
				<a class="site-sidebar-icon" href="http://last.fm/user/jazzmoodles"><i class="icon-lastfm"></i></a>
				<a class="site-sidebar-icon" href="http://instagram.com/hey.georgie/"><i class="icon-instagram"></i></a>
				<a class="site-sidebar-icon" href="http://linkedin.com/in/gluhur/"><i class="icon-linkedin"></i></a>
				<a class="site-sidebar-icon" href="http://delicious.com/sashimi/"><i class="icon-delicious"></i></a>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">Regularly Updated</h3>
				<ul class="site-sidebar-list">
					<li class="site-sidebar-list-item">
						<a href="/category/2-minutes-40-seconds">2 minutes and 40 seconds</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/a-day-in-the-life">A Day in the Life</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/fashion-friday">Fashion Friday</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/music">Music</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/photoblog/">Photoblog</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/things-i-miss">Things I Miss</a>
					</li>
				</ul>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">A Day in the Life linkup</h3>
				<p class="site-sidebar-text">Blog about a designated day in your life each month, share your post and make friends. <a href="/day-life/">Take part!</a></p>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">Subscribe to Hey Georgie</h3>
			<?php $status = isset( $_REQUEST['subscribe'] ) ? $_REQUEST['subscribe'] : false; ?>
			<?php if ( $status == 'invalid_email' ) : ?>
				<p class="site-sidebar-text">You’ve entered an invalid email address, please try again.</p>
			<?php elseif ( $status == 'success' ) : ?>
				<p class="site-sidebar-text">Thank you for subscribing! &hearts; Please check your email to confirm.</p>
			<?php else : ?>
				<form class="subscribe-form" method="POST">
					<input type="hidden" name="my-form-action" value="subscribe" />
					<input type="email" class="subscribe-form-input" name="my-email" onblur="if (this.value == '') {this.value = 'Type your email address';}" onfocus="if (this.value == 'Type your email address') {this.value = '';}" value="Type your email address" placeholder="Type your email address" />
					<button class="subscribe-form-submit" type="submit">Go!</button>
				</form>
			<?php endif; ?>
			</div>
		</aside>