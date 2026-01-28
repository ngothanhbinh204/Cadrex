<?php
/**
 * Template Name: Page Contact
 */
get_header();

// Get ACF Fields
$form_title = get_field('contact_form_title') ?: 'GỬI LỜI NHẮN';
$form_subtitle = get_field('contact_form_subtitle') ?: 'Nếu Quý khách hàng có yêu cầu, thắc mắc. Vui lòng liên hệ với chúng tôi.';
$cf7_shortcode = get_field('contact_form_shortcode');
$company_name = get_field('company_name') ?: 'CÔNG TY CỔ PHẦN TẬP ĐOÀN DREAM LANDS';
$office_list = get_field('office_list');
$map_iframe = get_field('contact_map_iframe');
?>

<main>
    <section class="global-breadcrumb">
        <div class="container">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </section>

    <section class="contact section-py">
        <div class="container"> 
            <div class="contact-main flex flex-col lg:flex-row xl:gap-20 gap-base">
                
                <!-- Left Column: Form -->
                <div class="col-left lg:rem:w-[680px] w-full">
                    <div class="title heading-2 font-extrabold mb-2"><?php echo esc_html($form_title); ?></div>
                    <div class="sub-title mb-5"><?php echo nl2br(esc_html($form_subtitle)); ?></div>
                    
                    <?php if ($cf7_shortcode) : ?>
                        <div class="contact-form-wrapper my-8">
                            <?php echo do_shortcode($cf7_shortcode); ?>
                        </div>
                    <?php else: ?>
                        <!-- Static Fallback Form -->
                        <form class="my-8" action="">
                            <div class="wrap-form grid grid-cols-2 gap-5">
                                <div class="form-group"> 
                                    <input type="text" name="name" placeholder="Họ và tên">
                                </div>
                                <div class="form-group"> 
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                                <div class="form-group"> 
                                    <input type="text" name="phone" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group"> 
                                    <input type="text" name="subject" placeholder="Tiêu đề">
                                </div>
                                <div class="form-group textarea w-full col-span-full"> 
                                    <textarea name="message" placeholder="Nội dung"></textarea>
                                </div>
                            </div>
                            <div class="form-submit mt-5 flex-center">
                                <a class="btn-primary body-2 text-white bg-primary-1 px-6 py-3 rounded-1 hover:bg-primary-2 undefined" href="#"><span>Gửi ngay</span></a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Right Column: Info -->
                <div class="col-right flex-1 lg:p-12 p-5 bg-Utility-50 w-full">
                    <h2 class="heading-2 text-Primary-2 font-extrabold mb-base uppercase"><?php echo esc_html($company_name); ?></h2>
                    
                    <?php if ($office_list) : ?>
                    <div class="contact-box"> 
                        <div class="contact-list flex flex-col gap-5"> 
                            <?php foreach ($office_list as $office) : ?>
                            <div class="contact-item">
                                <span class="text-xl text-Primary-2"> 
                                    <i class="fa-solid fa-<?php echo esc_attr($office['icon_class']); ?>"></i>
                                </span>
                                <div class="contact-wrap flex flex-col gap-2">
                                    <?php echo wp_kses_post($office['content']); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Map -->
            <?php if ($map_iframe) : ?>
            <div class="map-wrap"> 
                <div class="map"> 
                    <?php echo $map_iframe; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
