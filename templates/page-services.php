<?php
/**
 * Template Name: Page Services
 */
get_header();

// 1. Get ACF Fields
$banner_image = get_field('service_banner_image');
$intro_content = get_field('service_intro_content');
$hero_solutions = get_field('service_hero_solutions'); // Repeater (Intro Sections)
$service_lists = get_field('service_sections'); // Repeater (Sliders)

?>

<main>
    <!-- Banner Section -->
	<section class="page-banner-main">
		<div class="img img-ratio pt-[calc(560/1920*100rem)]">
            <?php if ($banner_image) : ?>
                <img class="lozad" data-src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_image['alt']); ?>" />
            <?php endif; ?>
		</div>
	</section>

    <!-- Intro & Solutions Section -->
	<section class="service-1 section-py">
		<div class="container">
            <?php if ($intro_content) : ?>
			<div class="wrap-content mb-base">
				<div class="format-content body-1 text-center">
					<?php echo wp_kses_post($intro_content); ?>
				</div>
			</div>
            <?php endif; ?>

			<div class="wrapper flex flex-col gap-5">
                <?php 
                if ($hero_solutions) : 
                    foreach ($hero_solutions as $solution) :
                        $s_img = $solution['image'];
                        $s_img_url = $s_img ? $s_img['url'] : '';
                        $s_title = $solution['title'];
                        $s_desc = $solution['description'];
                ?>
				<div class="wrapper-main grid grid-cols-2 gap-5">
					<div class="col-left">
						<div class="img img-ratio ratio:pt-[440_690] rounded-5 h-full">
                            <img class="lozad" data-src="<?php echo esc_url($s_img_url); ?>" alt="<?php echo esc_attr($s_title); ?>" />
						</div>
					</div>
					<div class="col-right">
						<div class="box">
							<h2 class="title heading-2 font-bold text-Primary-2 mb-base"><?php echo esc_html($s_title); ?></h2>
							<div class="format-content body-1 font-normal">
								<?php echo wp_kses_post($s_desc); ?>
							</div>
						</div>
					</div>
				</div>
                <?php 
                    endforeach;
                endif; 
                ?>
			</div>
		</div>
	</section>

    <!-- Services Sliders Sections -->
    <?php 
    if ($service_lists) :
        foreach ($service_lists as $index => $section) :
            $sec_title = $section['section_title'];
            $sec_services = $section['services_list']; // Relationship object
            // Just nice CSS classes handling from HTML source
            $section_class = ($index === 0) ? 'service-2 section-py !pt-0' : 'service-3 section-py';
    ?>
	<section class="<?php echo esc_attr($section_class); ?>">
		<div class="container">
            <?php if ($sec_title): ?>
			<h2 class="title heading-2 font-bold text-Primary-2 mb-base text-center"><?php echo esc_html($sec_title); ?></h2>
            <?php endif; ?>
			
            <div class="slide-service">
				<div class="swiper-column-auto relative mt-base swiper-loop autoplay">
					<div class="swiper">
						<div class="swiper-wrapper">
                            <?php 
                            if ($sec_services) :
                                foreach ($sec_services as $post_obj) :
                                    setup_postdata($post_obj);
                                    $p_title = get_the_title($post_obj);
                                    $p_thumb = get_the_post_thumbnail_url($post_obj, 'large');
                                    $p_link = '#'; // No link as requested "không cho click vào chi tiết"
                            ?>
							<div class="swiper-slide"> 
                                <a class="card-product group" href="javascript:void(0);">
									<div class="img img-ratio ratio:pt-[1_1] zoom-img">
                                        <img class="lozad" data-src="<?php echo esc_url($p_thumb); ?>" alt="<?php echo esc_attr($p_title); ?>" />
									</div>
									<div class="content-card-product">
										<div class="title-card-product group-hover:text-Primary-2">
											<p><?php echo esc_html($p_title); ?></p>
										</div>
									</div>
								</a>
							</div>
                            <?php 
                                endforeach;
                                wp_reset_postdata();
                            endif;
                            ?>
						</div>
					</div>
					<div class="wrap-button-slide">
						<div class="btn btn-sw-1 btn-prev"></div>
						<div class="btn btn-sw-1 btn-next"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php 
        endforeach;
    endif;
    ?>

</main>

<?php get_footer(); ?>
