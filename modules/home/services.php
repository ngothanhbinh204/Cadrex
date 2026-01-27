<?php

if (have_rows('home_services')):

    while (have_rows('home_services')): the_row();

        if (!get_sub_field('enable_section')) continue;



        $title = get_sub_field('title');

        $description = get_sub_field('description');

        $service_list = get_sub_field('service_list');

?>

<section id="our-services" class="section-field-op section-py !pt-base">

    <div class="container">

        <div class="field-op">

            <div class="wrap-heading rem:max-w-[1000px] w-full mx-auto text-center mb-base" data-aos="fade-down" data-aos-delay="200" data-duration="500">

                <h2 class="title heading-1 text-primary-1 font-bold mb-5"><?php echo $title; ?></h2>

                <div class="desc body-1 font-normal"> 

                    <?php echo $description; ?>

                </div>

            </div>

            <?php if ($service_list): ?>

            <div class="swiper swiper-field-op" data-aos="fade-up" data-aos-delay="200" data-duration="500">

                <ul class="swiper-wrapper field-op-list">

                    <?php foreach ($service_list as $item): 

                        $image = $item['image'];

                        $item_title = $item['item_title'];

                        $item_desc = $item['item_desc'];

                        $item_link = $item['item_link'];

                    ?>

                    <li class="swiper-slide field-op-item relative lg:flex-1 xl:rem:!h-[640px] rem:!h-[580px] overflow-hidden group transition-500">

                        <div class="thumb img-full w-full h-full">

                            <?php echo get_image_attrachment($image, 'image'); ?>

                        </div>

                        <div class="wrap-content-top absolute z-3 top-0 left-0 p-6 -lg:p-5 w-full flex items-center justify-between">

                            <h3 class="title heading-7 font-bold transition-500 ease-linear text-white"><?php echo $item_title; ?></h3>

                            <?php if ($item_link): ?>

                            <a class="icon" href="<?php echo esc_url($item_link['url']); ?>" target="<?php echo esc_attr($item_link['target'] ? $item_link['target'] : '_self'); ?>"> </a>

                            <?php endif; ?>

                        </div>

                        <div class="info absolute z-3 bottom-0 left-0 w-full p-5 md:p-6 text-white transition-300 ease-linear">                         

                            <div class="box-content body-1 border-[1.5px] border-white/20 bg-black/20 backdrop-blur-[10px] rounded-[8px] lg:p-10 p-5 ">

                                <div class="content">

                                    <p><?php echo $item_desc; ?></p>

                                </div>

                            </div>

                        </div>

                    </li>

                    <?php endforeach; ?>

                </ul>

            </div>

            <?php endif; ?>

        </div>

    </div>

</section>

<?php 

    endwhile;

endif;

?>

