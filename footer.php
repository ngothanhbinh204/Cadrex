		<footer class="container">
			<div class="flex-between-center gap-8 -md:flex-col -md:items-start">
				<div class="box-title">
					<h2 class="title  heading-1 text-primary-1">Cadrex Valley</h2>
					<p class="sub-title body-2 text-utility-gray-800">Together We Grow and Thrive</p>
				</div>
				<div class="form-email -md:w-full">
					<div class="title body-2 font-bold text-primary-1">Get in touch with us</div>
					<form action=""> 
						<div class="flex-between text-utility-gray-500 bg-utility-gray-100 py-1 pr-1 rounded-1">
							<input class="pl-2.5 bg-utility-gray-100 flex-1 focus:outline-none" type="email" name="" placeholder="Email">
							<button class="text-primary-4 p-1 bg-white rounded-1 body-3 sq-8 " type="submit">
								 <i class="fa-regular fa-paper-plane"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="link-footer"> 
				<div>
                    <?php
                    // Get footer info list from theme options
                    $footer_info = get_field('footer_info_list', 'option');
                    if ($footer_info):
                    ?>
					<ul class="lg:rem:w-[626px] body-2 flex flex-col gap-4">
                        <?php foreach($footer_info as $item): 
                            $label = $item['label'];
                            $value = $item['value']; // WYSIWYG
                        ?>
						<li><span class="<?php echo sanitize_title($label); ?>"><strong><?php echo $label; ?>: </strong><?php echo $value; ?></span></li>
                        <?php endforeach; ?>
					</ul>
                    <?php else: ?>
                    <!-- Fallback -->
                    <ul class="lg:rem:w-[626px] body-2 flex flex-col gap-4">
						<li><a class="address" href=""><strong>Address: </strong>DEZ Dubai Integrated Economic Zones, Dubai Silicon Oasis, Premises</a></li>
						<li><a class="phone" href=""><strong>Hotline: </strong>+84 28 3920 8888</a></li>
						<li><a class="email" href=""><strong>Email: </strong>cadrex@asia.com</a></li>
						<li><a class="open" href=""><strong>Business Hours: </strong>Monday – Friday: 9:00 AM – 4:30 PM (GMT+7)</a></li>
					</ul>
                    <?php endif; ?>
				</div>
				<div class="flex flex-col gap-6">
					<div class="title heading-3 text-primary-1">Quick links</div>
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
					<div class="title heading-3 text-primary-1">Our Products</div>
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
					<div class="title heading-3 text-primary-1">Social</div>
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
			<div class="bottom-footer body-4 text-utility-gray-800"><span>© 2025 Cadrex Asia. All Rights Reserved. Website designed by CanhCam. </span></div>
		</footer>
		<script src="<?php echo get_template_directory_uri(); ?>/js/core.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>
        <?php wp_footer(); ?>
	</body>
</html>