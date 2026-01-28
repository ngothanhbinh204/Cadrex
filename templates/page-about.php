<?php
/**
 * Template Name: Page About
 */
get_header();
?>

<main>
    <?php
    // Section: Banner
    $banner = get_field('about_banner');
    if ($banner) :
        $banner_image = $banner['image'];
    ?>
    <section class="page-banner-main">
        <div class="img img-ratio pt-[calc(560/1920*100rem)]">
            <?php if ($banner_image) : ?>
                <img class="lozad" data-src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_image['alt']); ?>" />
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Section: Intro (About 1)
    $intro = get_field('about_intro');
    if ($intro) :
    ?>
    <section class="about-1 section-40">
        <div class="container">
            <?php if ($intro['title']) : ?>
                <h2 class="title heading-1 mb-5 text-Primary-2 font-semibold"><?php echo esc_html($intro['title']); ?></h2>
            <?php endif; ?>
            <div class="fortmat-content body-1 font-medium">
                <?php echo $intro['content']; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Section: Mission (Box Image Full)
    $mission = get_field('about_mission');
    if ($mission) :
        $bg_image_url = $mission['background_image']['url'] ?? '';
    ?>
    <section class="box-image-full" setbackground="<?php echo esc_url($bg_image_url); ?>">
        <div class="box-content rem:min-h-[920px] -lg:rem:min-h-[500px]">
            <div class="container container relative z-3 flex-between gap-y-base flex-col rem:min-h-[500px]">
                <div class="img-gradient-bg" data-aos="zoom-in" data-aos-delay="100">
                    <div class="img-ratio md:ratio:pt-[60_77]">
                        <?php if (!empty($mission['inner_image'])) : ?>
                            <img src="<?php echo esc_url($mission['inner_image']['url']); ?>" alt="<?php echo esc_attr($mission['inner_image']['alt']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($mission['small_title']) : ?>
                    <div class="title-banner col-12 heading-banner" data-aos="fade-up" data-aos-delay="100">
                        <?php echo esc_html($mission['small_title']); ?>
                    </div>
                <?php endif; ?>
                <div class="title heading-1 relative z-3 flex-1 format-content" data-aos="fade-up" data-aos-delay="300">
                    <?php echo $mission['description']; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Section: Certificates (About 3)
    $certificates = get_field('about_certificates');
    if ($certificates) :
    ?>
    <section class="about-3 section-py">
        <div class="container">
            <?php if ($certificates['title']) : ?>
                <h2 class="title heading-1 mb-5 text-Primary-2 font-semibold text-center mb-base"><?php echo esc_html($certificates['title']); ?></h2>
            <?php endif; ?>
            <div class="swiper-column-auto relative swiper-loop autoplay">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        $gallery = $certificates['gallery'];
                        if ($gallery) :
                            foreach ($gallery as $image) :
                        ?>
                        <div class="swiper-slide">
                            <div class="box-image img-ratio ratio:pt-[166_264]">
                                <img class="lozad" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <div class="wrap-button-slide">
                        <div class="btn btn-sw-1 btn-prev"></div>
                        <div class="btn btn-sw-1 btn-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php  get_template_part('modules/common/section-contactHome'); ?>

</main>

<?php get_footer(); ?>
