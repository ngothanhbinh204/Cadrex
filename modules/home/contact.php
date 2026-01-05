<?php
$background_image = get_sub_field('background_image');
$heading_text = get_sub_field('heading_text');
$phone = get_sub_field('phone');
$email = get_sub_field('email');
$form_title = get_sub_field('form_title');
$cf7_shortcode = get_sub_field('cf7_shortcode'); // [contact-form-7 id="..." title="..."]

/**
 * Suggested CF7 Template provided for User:
 * 
 * <div class="grid grid-cols-2 gap-1">
 *    <div class="col-span-1">[text* your-name placeholder "Họ và tên"]</div>
 *    <div class="col-span-1">[text your-company placeholder "Công ty"]</div>
 *    <div class="col-span-1">[email* your-email placeholder "Email"]</div>
 *    <div class="col-span-1">[tel* your-phone placeholder "Số điện thoại"]</div>
 *    <div class="col-span-2">[textarea your-message placeholder "Nội dung"]</div>
 * </div>
 * <button type="submit">Send</button>
 * 
 * Note: The HTML in Home.html was:
 * <form class="grid grid-cols-2 gap-1 " action=""> 
 *    <input type="text" placeholder="Email *"> ...
 * </form>
 * <button type="submit"> Send</button>
 * 
 * So we expect the CF7 form to output that structure.
 */
?>
<?php 
$bg_url = get_image_attrachment($background_image, 'url');
?>
<section class="section-home-contact" setBackground="<?php echo $bg_url; ?>">
    <div class="title-bg" data-aos="fade-down" data-duration="200"><span><?php echo $heading_text; ?></span></div>
    <div class="container xl:mt-15 lg:mt-10 mt-5">
        <div class="box-contact" data-aos="fade-left" data-duration="200">
            <div class="contact-phone"><i class="fa-solid fa-phone"></i>
                <div class="phone"> <span><?php echo $phone; ?></span></div>
            </div>
            <div class="contact-mail">
                 <i class="fa-solid fa-envelope"></i>
                <div class="mail"> <span><?php echo $email; ?></span></div>
            </div>
            <div class="form-contact">
                <div class="title-contact heading-4"><?php echo $form_title; ?></div>
                <?php 
                if ($cf7_shortcode) {
                    echo do_shortcode($cf7_shortcode); 
                } else {
                    // Fallback visual
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
