<?php
if (have_rows('home_mission')):
    while (have_rows('home_mission')): the_row();
        if (!get_sub_field('enable_section')) continue;

        $background_image = get_sub_field('background_image');
        $highlight_image = get_sub_field('highlight_image'); // image_2 (the center logo/image)
        $sub_title = get_sub_field('sub_title'); // "OUR MISSION"
        $description = get_sub_field('description'); // The main text
        
        $bg_url = get_image_attrachment($background_image, 'url'); 
?>
<section class="box-image-full" setbackground="<?php echo $bg_url; ?>">
    <div class="box-content">
        <div class="container relative z-3">
            <?php if ($highlight_image): ?>
            <div class="img-gradient-bg" data-aos="zoom-in" data-aos-delay="100">
                <div class="img-ratio md:ratio:pt-[60_77] ">
                    <?php echo get_image_attrachment($highlight_image, 'image'); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="title-banner col-12 heading-banner" data-aos="fade-up" data-aos-delay="100"><?php echo $sub_title; ?></div>
            <div class="title heading-1 col-xl-7 relative z-3" data-aos="fade-up" data-aos-delay="300"><?php echo $description; ?></div>
        </div>
    </div>
</section>
<?php 
    endwhile;
endif;
?>
