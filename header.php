<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href=""><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Farsan&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Flex:opsz,wght,XOPQ,XTRA,YOPQ,YTDE,YTFI,YTLC,YTUC@8..144,100..1000,96,468,79,-203,738,514,712&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/core.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.min.css">
		<title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="container-header">
				<div class="logo md:rem:w-[290px] rem:w-[140px] md:py-2.5 z-4 xl:px-0 lg:px-2"><a class="img-ratio ratio:pt-[80_290]" href="<?php echo home_url(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt=""></a></div>
				<div class="list-menu-header">
                    <?php
                    if (has_nav_menu('header-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container'      => 'div',
                            'container_class'=> 'header-menu',
                            'items_wrap'     => '<ul>%3$s</ul>',
                            'walker'         => new CanhCam_Walker(),
                            'depth'          => 2,
                        ));
                    } else {
                        // Fallback static HTML if menu is not assigned yet to avoid blank space during dev
                        ?>
                        <div class="header-menu"> 
                            <ul> 
                                <li class="menu-item-has-children current-menu-item"><a href="">About-us </a></li>
                                <li class="menu-item-has-children"><a href="">Our Products</a></li>
                                <li class="menu-item-has-children"><a href="">Our Services</a></li>
                                <li class="menu-item-has-children"><a href="">News</a></li>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
					<div class="icon-search header-search"><i class="fa-regular fa-magnifying-glass"></i></div>
					<div class="header-language"> 
						<div class="header-language-active">
							<ul> 
								<li class="wpml-ls-current-language"><a href=""> <span class="wpml-ls-native">VN</span></a></li>
								<ul> 
									<li> <a href=""> <span>EN</span></a></li>
								</ul>
							</ul>
						</div>
						<div class="header-language-list">
							<ul> 
								<li class="wpml-ls-current-language"><a href=""> <span class="wpml-ls-native">VN</span></a></li>
								<ul> 
									<li> <a href=""> <span>EN</span></a></li>
								</ul>
							</ul>
						</div>
					</div>
					<div class="header-hambuger"><span></span><span></span><span></span>
						<div id="pulseMe">
							<div class="bar left"></div>
							<div class="bar top"></div>
							<div class="bar right"></div>
							<div class="bar bottom"></div>
						</div>
					</div><a class="btn-contact-header" href="">Contact</a>
				</div>
			</div>
			<div class="header-mobile-wrapper">
				<div class="header-mobile">
					<div class="logo-mobile rem:w-[290px] opacity-0"><a class="img-ratio ratio:pt-[80_290]" href="<?php echo home_url(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt=""></a></div>
					<div class="list-menu-header flex-1 w-full">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Our Products</a></li>
							<li><a href="#">Our Services</a></li>
							<li><a href="#">News</a></li>
							<li class="btn-contact-header"><a href="">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="overlay"></div>
			</div>
		</header>
		<div class="header-search-form">
			<div class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5"><i class="fa-light fa-xmark"></i></div>
			<div class="container">
				<div class="wrap-form-search-product">
					<div class="productsearchbox">
						<input type="text" placeholder="Bộ ghế sofa 2022">
						<button class="text-white text-base"><i class="fa-regular fa-magnifying-glass "></i></button>
					</div>
				</div>
			</div>
		</div>