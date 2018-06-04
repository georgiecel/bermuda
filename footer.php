            </div>
        </div>
        <div class="l-spacing-outer l-spacing-inner--large">
            <footer class="c-footer">
                <hr>
                <?php dynamic_sidebar('footer'); ?>
            </footer>
        </div>
        <script type="text/javascript">
            var form = document.getElementById('search-form');
            var searchButton = document.querySelector('.c-search__trigger');
            var formInput = document.querySelector('.c-search__form-input');

            function showSearchForm(event) {
                form.classList.add('is-visible');
                formInput.focus();
            }

            searchButton.addEventListener('click', showSearchForm, false);

            function closeAll(event) {
                if(!event.target.classList.contains('js-exclude-close')) {
                    form.classList.remove('is-visible');
                    formInput.blur();
                }
            }

            window.addEventListener('touchstart', closeAll, false);
            window.addEventListener('click', closeAll, false);
        </script>
        <?php wp_footer(); ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-64300477-1', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>