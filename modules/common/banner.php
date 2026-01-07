<?php
/**
 * Banner module (Common)
 * Logic:
 * 1. If Category/Archive: Show banner of that category (using ACF field 'banner_image' on term)
 * 2. If Page: Show selected banners from 'banner_select_page' (CPT Banner). Each CPT Banner contains a repeater of slides.
 */

// Init vars
$banner_objects = [];
$is_single_banner = false;
$single_banner_image = '';
$single_banner_title = '';
$single_banner_subtitle = '';

if (is_category() || is_tax() || is_archive()) {
    // TAXONOMY CASE
    $term = get_queried_object();
    $image = get_field('banner_image', $term); 
    
    if ($image) {
        $is_single_banner = true;
        $single_banner_image = $image;
        $single_banner_title = single_term_title('', false);
        $single_banner_subtitle = ''; 
    } 
} else {
    // PAGE CASE
    $banner_objects = get_field('banner_select_page');
}

// RENDER SINGLE BANNER (Taxonomy)
if ($is_single_banner):
?>
<section class="section-banner-home">
    <div class="swiper swiper-home-banner">
        <div class="swiper-wrapper">
             <div class="swiper-slide">
                <div class="box-slide">
                    <div class="img-ratio box-image ratio:pt-[880_1920] -lg:ratio:pt-[1_1] font-medium">
                        <?php echo get_image_attrachment($single_banner_image); ?>
                    </div>
                    <div class="box-content">
                        <div class="sub-title heading-1" data-aos="fade-down" data-aos-delay="100"><span><?php echo $single_banner_subtitle; ?></span></div>
                        <div class="line"></div>
                        <div class="title heading-banner" data-aos="fade-up" data-aos-delay="100"><span><?php echo $single_banner_title; ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
// RENDER SLIDER BANNER (Selected Banners -> Repeater Slides)
elseif ($banner_objects): 
?>
<section class="section-banner-home">
    <div class="swiper swiper-home-banner">
        <div class="swiper-wrapper">
            <?php foreach ($banner_objects as $post_obj): 
                $post_id = $post_obj->ID;
                $slides = get_field('banner_slides', $post_id);

                if ($slides):
                    foreach($slides as $slide):
                        $image = $slide['image'];
                        $sub_title = $slide['sub_title'];
                        $title = $slide['title'];
            ?>
            <div class="swiper-slide">
                <div class="box-slide">
                    <div class="img-ratio box-image ratio:pt-[880_1920] -lg:ratio:pt-[1_1] font-medium">
                         <?php echo get_image_attrachment($image); ?>
                    </div>
                    <div class="box-content">
                        <div class="sub-title heading-1" data-aos="fade-down" data-aos-delay="100"><span><?php echo $sub_title; ?></span></div>
                        <div class="line"></div>
                        <div class="title heading-banner" data-aos="fade-up" data-aos-delay="100"><span><?php echo $title; ?></span></div>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                endif;
            endforeach; 
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<?php endif; ?>