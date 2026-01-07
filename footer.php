<footer class="container">
    <div class="flex-between-center gap-8 -md:flex-col -md:items-start">
        <div class="box-title">
            <h2 class="title heading-1 text-primary-1">
                <?php echo get_field('footer_logo_text', 'option'); ?>
            </h2>
            <p class="sub-title body-2 text-utility-gray-800">
                <?php echo get_field('footer_sub_title', 'option'); ?>
            </p>
        </div>
        <div class="form-email -md:w-full">
            <div class="title body-2 font-bold text-primary-1">
                <?php _e('Get in touch with us', 'canhcam'); ?>
            </div>
            
            <?php 
            // Thay form tĩnh bằng Shortcode Contact Form 7 để quản lý dễ hơn
            $footer_form_shortcode = get_field('footer_form_shortcode', 'option');
            if ($footer_form_shortcode):
                echo do_shortcode($footer_form_shortcode);
            else: ?>
                <form action=""> 
                    <div class="flex-between text-utility-gray-500 bg-utility-gray-100 py-1 pr-1 rounded-1">
                        <input class="pl-2.5 bg-utility-gray-100 flex-1 focus:outline-none" type="email" name="email" placeholder="<?php _e('Email', 'canhcam'); ?>">
                        <button class="text-primary-4 p-1 bg-white rounded-1 body-3 sq-8" type="submit">
                             <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="link-footer"> 
        <div>
            <?php
            $footer_info = get_field('footer_info_list', 'option');
            if ($footer_info):
            ?>
            <ul class="lg:rem:w-[626px] body-2 flex flex-col gap-4">
                <?php foreach($footer_info as $item): 
                    $label = $item['label'];
                    $value = $item['value']; 
                ?>
                <li>
                    <span class="<?php echo sanitize_title($label); ?>">
                        <strong><?php echo $label; ?>: </strong><?php echo $value; ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>

        <div class="flex flex-col gap-6">
            <div class="title heading-3 text-primary-1"><?php _e('Quick links', 'canhcam'); ?></div>
            <?php
            if (has_nav_menu('footer-2')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer-2',
                    'container'      => false,
                    'items_wrap'     => '<ul class="flex flex-col gap-2 body-2">%3$s</ul>',
                    'walker'         => new CanhCam_Walker(),
                ));
            }
            ?>
        </div>

        <div class="flex flex-col gap-6">
            <div class="title heading-3 text-primary-1"><?php _e('Our Products', 'canhcam'); ?></div>
            <?php
            if (has_nav_menu('footer-3')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer-3',
                    'container'      => false,
                    'items_wrap'     => '<ul class="flex flex-col gap-2 body-2">%3$s</ul>',
                    'walker'         => new CanhCam_Walker(),
                ));
            }
            ?>
        </div>

        <div class="social flex flex-col gap-6 lg:rem:w-[126px]">
            <div class="title heading-3 text-primary-1"><?php _e('Social', 'canhcam'); ?></div>
            <?php
            if (has_nav_menu('footer-4')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer-4',
                    'container'      => false,
                    'items_wrap'     => '<ul class="social-footer flex flex-col gap-2 body-2">%3$s</ul>',
                    'walker'         => new CanhCam_Walker(),
                ));
            }
            ?>
        </div>
    </div>

    <div class="bottom-footer body-4 text-utility-gray-800">
        <span>
            <?php 
                $copyright = get_field('footer_copyright', 'option');
                if ($copyright) {
                    echo str_replace('{year}', date('Y'), $copyright);
                } else {
                    printf(__('© %d Cadrex Asia. All Rights Reserved. Website designed by CanhCam.', 'canhcam'), date('Y'));
                }
            ?>
        </span>
    </div>
</footer>
<?php wp_footer(); ?>