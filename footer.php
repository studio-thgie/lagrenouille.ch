        <footer>

        <div class="g-footer-newsletter">

            <?php

                $newsletter_form = (ICL_LANGUAGE_CODE == 'de') ? '/newsletter' : '/fr/newsletter';

            ?>

            <form action="<?php echo $newsletter_form; ?>" method="post" novalidate>
                <div id="mc_embed_signup_scroll">
                    <div class="mc-field-group">
                        <input type="email" value="" name="footer-newsletter-email" class="required email" id="footer-newsletter-" placeholder="Newsletter">
                    </div>
                        <input type="submit" value="Subscribe" name="subscribe"
                            id="mc-embedded-subscribe" class="button">
                </div>
            </form>
        </div>

        <div class="g-social">
            <div class="g-social__media">
                <a href="https://www.instagram.com/lagrenouille.bielbienne/" target="_blank">
                    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/insta_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Instagram"/>
                </a>
                <a href="https://www.facebook.com/lagrenouille.bielbienne/" target="_blank">
                    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/facebook_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Facebook"/>
                </a>
            </div>
        </div>

        &copy; <?php echo date("Y"); ?> Théâtre de la Grenouille &mdash; <a href="http://sifon.li/" target="_blank"/>SIFON</a> &mdash; <a href="http://www.atelyeah.com/" target="_blank"/>Atelyeah</a>
        
        </footer>

    </div>

    <?php wp_footer(); ?> 

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-106145121-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>

</html>