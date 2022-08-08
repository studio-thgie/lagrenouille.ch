<?php

    /*

    Template Name: Newsletter
    
    */

    get_header();

?>

<main>

    <article class="g-production__article">
        <div class="g-production__description">
            <?php the_content(); ?>
        </div>
    </article>

    <div class="g-newsletter-wrapper">

        <div class="mc-field-group">
            <label for="audience"><?php _e('please_chose', 'grenouille') ?></label>
            <div>
                <input type="radio" value="privat" name="audience" checked> <span class="g-radio-label"><?php _e('interested', 'grenouille') ?></span><br>
                <input type="radio" value="veranstalter" name="audience"> <span class="g-radio-label"><?php _e('organizer', 'grenouille') ?></span>
            </div>
        </div>

        <?php if(ICL_LANGUAGE_CODE == 'de'): ?>

        <!-- Privat DE -->

        <div class="g-newsletter-form g-newsletter-form__privat">
            <form
                action="https://lagrenouille.us10.list-manage.com/subscribe/post?u=c952b7ccc68c2c6986c13717c&amp;id=936c93a93b"
                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Adresse <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="<?php echo $_POST['footer-newsletter-email']; ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Vorname <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Nachname <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-PHONE">Telefon <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="PHONE" class="required" id="mce-PHONE">
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                            name="b_c952b7ccc68c2c6986c13717c_936c93a93b" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                            id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>

        <?php endif; ?>
        <?php if(ICL_LANGUAGE_CODE == 'fr'): ?>

        <!-- Privat FR -->

        <div class="g-newsletter-form g-newsletter-form__privat">
            <form
                action="https://lagrenouille.us10.list-manage.com/subscribe/post?u=c952b7ccc68c2c6986c13717c&amp;id=06f9756e7a"
                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Adresse e-mail <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="<?php echo $_POST['footer-newsletter-email']; ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Prénom <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Nom <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-PHONE">Téléphone <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="PHONE" class="required" id="mce-PHONE">
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                            name="b_c952b7ccc68c2c6986c13717c_06f9756e7a" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                            id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>

        <?php endif; ?>
        <?php if(ICL_LANGUAGE_CODE == 'de'): ?>

        <!-- Veranstalter DE -->

        <div class="g-newsletter-form g-newsletter-form__veranstalter hide">
            <form
                action="https://lagrenouille.us10.list-manage.com/subscribe/post?u=c952b7ccc68c2c6986c13717c&amp;id=b08a8d017c"
                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Adresse <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="<?php echo $_POST['footer-newsletter-email']; ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Vorname <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Nachname <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-PHONE">Telefon <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="PHONE" class="required" id="mce-PHONE">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-TYPE">Bitte präzisieren: Anmeldung für Schule oder Veranstalter.in <span class="asterisk">*</span> </label>
                        <select name="TYPE" class="" id="mce-TYPE">
                            <option value=""></option>
                            <option value="Veranstalter">Veranstalter.in</option>
                            <option value="Schule">Schule</option>
                        </select>
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                            name="b_c952b7ccc68c2c6986c13717c_b08a8d017c" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                            id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>

        <?php endif; ?>
        <?php if(ICL_LANGUAGE_CODE == 'fr'): ?>

        <!-- Veranstalter FR -->

        <div class="g-newsletter-form g-newsletter-form__veranstalter hide">
            <form
                action="https://lagrenouille.us10.list-manage.com/subscribe/post?u=c952b7ccc68c2c6986c13717c&amp;id=fdba8ba3b7"
                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Adresse e-mail <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="<?php echo $_POST['footer-newsletter-email']; ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Prénom <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Nom <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-PHONE">Téléphone <span class="asterisk">*</span> </label>
                        <input type="text" value="" name="PHONE" class="required" id="mce-PHONE">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-TYPE">veuillez svp préciser si vous êtes une école ou un.e organisateur.trice <span class="asterisk">*</span> </label>
                        <select name="TYPE" class="" id="mce-TYPE">
                            <option value=""></option>
                            <option value="Veranstalter">organisateur.trice</option>
                            <option value="Schule">école</option>
                        </select>
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                            name="b_c952b7ccc68c2c6986c13717c_fdba8ba3b7" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                            id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>

        <?php endif; ?>

    </div>

    <?php get_template_part( 'shapes' ); ?>

</main>

<?php get_footer(); ?>