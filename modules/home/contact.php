<?php
if (have_rows('home_contact')):
    while (have_rows('home_contact')): the_row();
        if (!get_sub_field('enable_section')) continue;

        $background_image = get_sub_field('background_image');
        $heading_text = get_sub_field('heading_text');
        $phone_link = get_sub_field('phone');
        $email_link = get_sub_field('email');
        $form_title = get_sub_field('form_title');
        $cf7_shortcode = get_sub_field('cf7_shortcode'); 

        $bg_url = get_image_attrachment($background_image, 'url');
?>
<section class="section-home-contact" setBackground="<?php echo $bg_url; ?>">
    <div class="title-bg" data-aos="fade-down" data-duration="200"><span><?php echo $heading_text; ?></span></div>
    <div class="container xl:mt-15 lg:mt-10 mt-5">
        <div class="box-contact" data-aos="fade-left" data-duration="200">
           <div class="contact-phone">
                <i class="fa-solid fa-phone"></i>
                <div class="phone"> 
                    <?php if ($phone_link): ?>
                        <a href="<?php echo esc_url($phone_link['url']); ?>" target="<?php echo esc_attr($phone_link['target'] ?: '_self'); ?>">
                            <span><?php echo esc_html($phone_link['title']); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="contact-mail">
                <i class="fa-solid fa-envelope"></i>
                <div class="mail"> 
                    <?php if ($email_link): ?>
                        <a href="<?php echo esc_url($email_link['url']); ?>" target="<?php echo esc_attr($email_link['target'] ?: '_self'); ?>">
                            <span><?php echo esc_html($email_link['title']); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-contact">
                <div class="title-contact heading-4"><?php echo $form_title; ?></div>
                <?php 
                if ($cf7_shortcode) {
                    echo do_shortcode($cf7_shortcode); 
                } else {
                    ?>
                    <form class="grid grid-cols-2 gap-1 " action=""> 
                        <input type="text" placeholder="Fullname *">
                        <input type="text" placeholder="Company">
                        <input type="text" placeholder="Email *">
                        <input type="text" placeholder="Phone Number *">
                        <textarea name="" placeholder="Message"></textarea>
                    </form>
                    <button type="submit"> Send</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php 
    endwhile;
endif;
?>
