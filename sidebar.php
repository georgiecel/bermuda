		<aside class="site-sidebar">
			<div class="site-search">
				<?php get_search_form(); ?>
			</div>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : endif; ?>
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