<div class="c-search">
    <button id="search-trigger" class="c-search__trigger js-exclude-close">
        <svg class="c-search__trigger-icon" fill="currentColor" height="24" viewBox="0 0 32 32" width="24" xmlns="http://www.w3.org/2000/svg">
            <title>Search form trigger</title>
            <path d="M31 27l-7-7.6c-1 1.7-2.6 3.2-4.3 4.3L27 31c1 1.3 3 1.3 4 0 1.3-1 1.3-3 0-4zm-7-15c0-6.6-5.4-12-12-12S0 5.4 0 12s5.4 12 12 12 12-5.4 12-12zm-12 9c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"/><path d="M5 12h2c0-2.8 2.2-5 5-5V5c-4 0-7 3-7 7z"/>
        </svg>
    </button>
    <div id="search-form" class="c-search-form-wrapper">
        <form method="get" class="c-search__form" action="<?php bloginfo('url'); ?>/">
            <label class="c-search__form-label u-visually-hidden" for="s">Search</label>
            <input
                class="c-search__form-input js-exclude-close"
                type="search"
                onblur="if (this.value == '') {this.value = 'Search my blog...';}"
                onfocus="if (this.value == 'Search my blog...') {this.value = '';}"
                value="Search my blog..."
                placeholder="Type a few words to search"
                name="s"
                id="s"
                tabindex="-1"
            >
            <button
                tabindex="-1"
                type="submit"
                class="btn c-search__form-submit js-exclude-close"
            >Search</button>
        </form>
    </div>
</div>