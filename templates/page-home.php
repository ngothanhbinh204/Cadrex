<?php

/**

 * Template Name: Page - Home

 */

get_header();

?>



<main class='animate-back-in-end animate-infinite animate-duration-500 animate-ease-linear animate-alternate-reverse animate-fill-backwards'>

    <?php

    include get_template_directory() . '/modules/common/banner.php';

    get_template_part('modules/home/about');

    get_template_part('modules/home/mission');

    get_template_part('modules/home/products');

    get_template_part('modules/home/services');

    get_template_part('modules/home/news');

    get_template_part('modules/home/contact');

    

    /*

    if (have_rows('home_sections')):

        while (have_rows('home_sections')): the_row();

            // ...

        endwhile;

    endif;

    */

    ?>

</main>



<?php get_footer(); ?>

