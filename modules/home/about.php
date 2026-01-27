<?php

if (have_rows('home_about')):

    while (have_rows('home_about')): the_row();

        if (!get_sub_field('enable_section')) continue;



        $title = get_sub_field('title');

        $content = get_sub_field('content');

        $link = get_sub_field('link');

        $image = get_sub_field('image');

?>

<section id='about-us' class="section-home-about">

    <div class="container grid items-center md:grid-cols-2 grid-cols-1 gap-base">

        <div class="flex flex-col gap-base items-start pr-5" data-aos="fade-right"  data-aos-delay="200" data-duration="500"> 

            <div class="box-content">

                <h2 class="title heading-1 text-primary-2"><?php echo $title; ?></h2>

                <div class="format-content body-2">

                    <?php echo $content; ?>

                </div>

            </div>

            <?php if ($link): ?>

            <a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>"><span><?php echo esc_html($link['title']); ?></span></a>

            <?php endif; ?>

        </div>

        <div class="box-image" data-aos="fade-left"  data-aos-delay="200" data-duration="500">

            <div class="img-ratio ratio:pt-[1_1]">

                <?php echo get_image_attrachment($image, 'image'); ?>

            </div>

        </div>

    </div>

</section>

<?php 

    endwhile;

endif;

?>

