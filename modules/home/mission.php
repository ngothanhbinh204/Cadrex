<?php
$background_image = get_sub_field('background_image');
$highlight_image = get_sub_field('highlight_image'); // The central image
$sub_title = get_sub_field('sub_title');
$description = get_sub_field('description');
?>
<section class="box-image-full" setbackground="<?php echo get_image_attrachment($background_image, 'url'); ?>">
    <div class="box-content">
        <div class="container relative z-3">
            <div class="img-gradient-bg" data-aos="zoom-in" data-aos-delay="100">
                <div class="img-ratio md:ratio:pt-[60_77] ">
                    <?php 
                    // Use helper 
                     if (!empty($highlight_image['ID'])) {
                        $alt = get_post_meta($highlight_image['ID'], '_wp_attachment_image_alt', true);
                        echo '<img src="' . wp_get_attachment_image_url($highlight_image['ID'], 'full') . '" alt="' . esc_attr($alt) . '">';
                    }
                    ?>
                </div>
            </div>
            <div class="title-banner col-12 heading-banner" data-aos="fade-up" data-aos-delay="100"><?php echo $sub_title; ?></div>
            <div class="title heading-1 col-xl-7 relative z-3" data-aos="fade-up" data-aos-delay="300"><?php echo $description; ?></div>
        </div>
    </div>
</section>
