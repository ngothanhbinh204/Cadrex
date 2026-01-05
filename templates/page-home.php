<?php
/*
Template name: Page - Home
*/
get_header();
?>
<main>
<?php
if (have_rows('home_sections')):
    while (have_rows('home_sections')): the_row();
        if (get_sub_field('enable_section')):
            get_template_part('modules/home/' . get_row_layout());
        endif;
    endwhile;
else:
    // Fallback if no ACF or locally dev
    // I will include all modules for now so the user sees the full page reconstructed
    get_template_part('modules/home/banner');
    get_template_part('modules/home/about');
    get_template_part('modules/home/mission');
    get_template_part('modules/home/products');
    get_template_part('modules/home/services');
    get_template_part('modules/home/news');
    get_template_part('modules/home/contact');
endif;
?>
</main>
<?php
get_footer();
