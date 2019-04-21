            </div>
        </div>
        <div class="l-spacing-outer l-spacing-inner--large">
            <footer class="c-footer">
                <hr>
                <?php dynamic_sidebar('footer'); ?>
            </footer>
        </div>
        <script type="text/javascript">
            const form = document.getElementById('search-form');
            const searchButton = document.querySelector('.c-search__trigger');
            const formInput = document.querySelector('.c-search__form-input');

            function showSearchForm(e) {
                form.classList.add('is-visible');
                formInput.focus();
            }

            searchButton.addEventListener('click', showSearchForm, false);

            function closeAll(e) {
                if(!e.target.classList.contains('js-exclude-close')) {
                    form.classList.remove('is-visible');
                    formInput.blur();
                }
            }

            window.addEventListener('touchstart', closeAll, false);
            window.addEventListener('click', closeAll, false);

            const toggleTheme = document.getElementById('theme-switch');
            const currentTheme = localStorage.getItem('theme');

            if (currentTheme) {
                document.getElementById('html').classList.add(currentTheme);

                if (document.getElementById('html').classList.contains('dark')) {
                    toggleTheme.checked = true;
                }
            }

            function switchTheme(e) {
                if (e.target.checked) {
                    document.getElementById('html').classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                else {
                    document.getElementById('html').classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }

            toggleTheme.addEventListener('change', switchTheme, false);
        </script>
        <?php wp_footer(); ?>
        <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-64300477-1', 'auto');
            ga('send', 'pageview');
        </script>
        <?php endif; ?>
    </body>
</html>