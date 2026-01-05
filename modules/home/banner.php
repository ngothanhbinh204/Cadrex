<?php
$banner_list = get_sub_field('banner_list');

if ($banner_list):
?>
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
