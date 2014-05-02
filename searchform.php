<form method="get" id="searchform" class="search-form" action="<?php bloginfo('url'); ?>/" role="search">
	<label class="hidden" for="search"></label>
	<input type="search" onblur="if (this.value == '') {this.value = 'Search for...';}" onfocus="if (this.value == 'Search for...') {this.value = '';}" value="Search for..." placeholder="Search for..." name="search" id="search" class="search-form-input" />
	<button type="submit" class="search-form-submit">Search</button>
</form>