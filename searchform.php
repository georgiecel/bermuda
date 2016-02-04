<form method="get" id="searchform" class="search-form" action="<?php bloginfo('url'); ?>/">
	<label class="search-form__label" for="s">Search</label>
	<input class="search-form__input" type="search" onblur="if (this.value == '') {this.value = 'Search for...';}" onfocus="if (this.value == 'Search for...') {this.value = '';}" value="Search for..." placeholder="Search for..." name="s" id="s">
	<button type="submit" class="btn search-form__submit">Search</button>
</form>