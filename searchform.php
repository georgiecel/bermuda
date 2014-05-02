<form method="get" id="searchform" class="search-form" action="<?php bloginfo('url'); ?>/" role="search">
	<label class="hidden" for="search"></label>
	<input type="search" onblur="if (this.value == '') {this.value = 'Search...';}" onfocus="if (this.value == 'Search...') {this.value = '';}" value="Search..." name="search" id="search" class="search-form-input" />
	<button type="submit" class="search-form-submit">Search</button>
</form>