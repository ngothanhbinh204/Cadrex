<?php
/**
 * Banner module (Common)
 * Logic:
 * 1. If Category/Archive: Show banner of that category (using ACF field 'banner_image' on term)
 * 2. If Page (Home or other): Show ACF repeater 'banner_list' from current page
 */

// Init vars
$banner_list = [];
$is_single_banner = false;
$single_banner_image = '';
$single_banner_title = '';
$single_banner_subtitle = '';

if (is_category() || is_tax() || is_archive()) {
    // TAXONOMY CASE
    $term = get_queried_object();
    $image = get_field('banner_image', $term); // Assumed field name on taxonomy
    
    // Fallback if no specific banner for cat, maybe use a default or empty
    if ($image) {
        $is_single_banner = true;
        $single_banner_image = $image;
        $single_banner_title = single_term_title('', false);
        $single_banner_subtitle = ''; // Optional: get_field('sub_title', $term);
    } 
} else {
    // PAGE CASE (Home)
    // Check if this is part of Flexible Content loop or just a standalone include
    // If inside loop, variables might be passed or get_sub_field works.
    // However, if we want to support "all pages", we might need to check get_field (top level) or get_sub_field (nested)
    // Since this was originally in modules/home/banner.php using get_sub_field('banner_list'), 
    // we should try that first, but also support get_field('banner_list') if used outside flex loop.
    
    // Check if we are in a flexible content row
    if (get_row_layout()) {
       $banner_list = get_sub_field('banner_list');
    } else {
       $banner_list = get_field('banner_list');
    }
}

// RENDER
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

<?php elseif ($banner_list): ?>
<section class="section-banner-home">
    <div class="swiper swiper-home-banner">
        <div class="swiper-wrapper">
            <?php foreach ($banner_list as $item): 
                $image = $item['image'];
                $sub_title = $item['sub_title'];
                $title = $item['title'];
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
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<?php endif; ?>