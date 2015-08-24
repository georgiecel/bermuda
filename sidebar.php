		<aside class="site-sidebar">
			<div class="site-search">
				<?php get_search_form(); ?>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">Hey there, I’m Georgie!</h3>
				<figure class="site-sidebar-photo"><img src="<?php bloginfo('template_url'); ?>/images/Georgie.jpg" alt="I’m Georgie!"></figure>
				<p class="site-sidebar-text">I’m a front-end <a href="/category/webdev/">web developer</a> and a concert photographer. I like dancing, <a href="/category/fashion/">fashion</a>, noodles, and a hot cup of tea. I write about <a href="/tag/relationships/">relationships</a>, <a href="/tag/everyday-life/">everyday life</a> and <a href="/tag/pondering/">ponder lots of stuff</a> (including stuff <a href="/category/things-i-miss/">from days gone by</a>). I have <a href="/tag/amusement/">funny stories</a>, too!</p>
				<a class="social-icon-link" href="http://twitter.com/georgiecel"><span class="social-icon icon-twitter"></span></a>
				<a class="social-icon-link" href="http://last.fm/user/jazzmoodles"><span class="social-icon icon-lastfm"></span></a>
				<a class="social-icon-link" href="http://instagram.com/hey.georgie/"><span class="social-icon icon-instagram"></span></a>
				<a class="social-icon-link" href="http://linkedin.com/in/gluhur/"><span class="social-icon icon-linkedin"></span></a>
				<a class="social-icon-link" href="http://delicious.com/sashimi"><span class="social-icon icon-delicious"></span></a>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">Regular Segments</h3>
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
						<a href="/tag/monthly-review/">Monthly Review</a>
					</li>
					<li class="site-sidebar-list-item">
						<a href="/category/things-i-miss">Things I Miss</a>
					</li>
				</ul>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">Recent Posts</h3>
				<ul>
					<?php $the_query = new WP_Query( 'posts_per_page=5' ); ?>
					<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			</div>
			<div class="site-sidebar-widget">
				<h3 class="site-sidebar-heading">A Day in the Life linkup</h3>
				<p class="site-sidebar-text">Blog about a designated day in your life each month, share your post and make friends. <a href="/day-life/">Check it out!</a></p>
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