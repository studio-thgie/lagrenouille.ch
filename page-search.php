<?php

    /*

    Template Name: Search
    
    */

    get_header();

?>

        <main>
            <section>
                <article class="g-search">
                <?php
                    global $wp_query;
                    $total_results = $wp_query->found_posts;
                    echo $total_results;
                ?>
                </article>
            </section>
        </main>

<?php get_footer(); ?>