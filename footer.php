		</div>
		</div>
		<footer class="site-footer" role="contentinfo">
			&copy; Hey Georgie, 2007-<?php $year = date("Y"); echo $year; ?> &middot; designed by <a href="http://georgieluhur.com">Georgie</a> &middot; &uarr; <a href="#site-header">top</a>
		</footer>
		<?php wp_footer(); ?>
		<script src="<?php bloginfo('template_url'); ?>/js/modernizr.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/respond.js"></script>
		<script>
		$(document).ready(function() {

			$('.main-navigation-toggle').click(function () {
				$('#main-navigation').toggleClass('is-open');
				$('.main-navigation-toggle').toggleClass('is-open');
				e.preventDefault();
			});
			
		});
		</script>
	</body>
</html>