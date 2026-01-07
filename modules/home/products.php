<?php
if (have_rows('home_products')):
    while (have_rows('home_products')): the_row();
        if (!get_sub_field('enable_section')) continue;
        
        $products = get_sub_field('product_relationship');

        if ($products):
?>
<section class="section-py section-list-text-image">
    <?php foreach ($products as $post): 
        setup_postdata($post);
        // Get data from post
        $image_id = get_post_thumbnail_id($post->ID);
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $link = get_permalink($post->ID);
        
        $sub_title = "Our Products"; 
    ?>
    <div class="item-text-image">
        <div class="box-image" data-aos="fade-right" data-aos-delay="100">
            <div class="img-ratio ratio:pt-[551_979]">
                <?php echo get_image_post($post->ID); ?>
            </div>
        </div>
        <div class="box-content -md:shadow-md -md:px-3 -md:py-4" data-aos="fade-left" data-aos-delay="200">
            <div class="row flex-col justify-end !m-0 ">
                <div class="sub-title heading-3"><span><?php echo $sub_title; ?></span></div>
                <div class="title heading-1"><?php echo $title; ?></div>
                <div class="format-content"><?php echo $description; ?></div>
            </div>
            <a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined" href="<?php echo esc_url($link); ?>"><span>Discover more</span></a>
        </div>
    </div>
    <?php endforeach; 
    wp_reset_postdata(); 
    ?>
</section>
<?php 
        endif;
    endwhile;
endif;
?>
