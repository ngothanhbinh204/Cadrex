<?php
get_header();

// 1. Get Current Term Object
$current_term = get_queried_object();
$current_term_id = $current_term->term_id;
$term_desc = term_description($current_term_id);

// 2. Logic: Check for Child Categories (Sub-terms)
// Map hierarchy: L2 (Current) -> L3 (Children)
$child_terms = get_terms(array(
    'taxonomy'   => 'product_cat',
    'parent'     => $current_term_id,
    'hide_empty' => false, // Set to true in production if you only want cats with posts
    'orderby'    => 'menu_order',
    'order'      => 'ASC'
));

// Prepare an array to collect Popup Data
$popups_data = array();

// Helper function to query posts per term and capture popup data
function get_products_in_term($term_id, &$popups_data) {
    if (!$term_id) return new WP_Query();
    
    $args = array(
        'post_type'      => 'product',
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        ),
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    $query = new WP_Query($args);
    
    // Pre-process popup IDs
    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            $popup_id = 'popup-product-' . $post->ID;
            // We'll capture data during the main loop to avoid double looping if possible, 
            // but for clean separation, let's just make sure we access it consistently.
        }
    }
    return $query;
}

?>

<main>
    <!-- Breadcrumb -->
	<section class="global-breadcrumb">
		<div class="container">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
		</div>
	</section>

    <!-- Main Content -->
	<section class="section-product-list-1 xl:pt-14 xl:rem:pb-[70px] py-10">
		<div class="container">
            <!-- Page Title -->
            <h2 class="title text-primary-1 font-semibold heading-1 mb-base text-center">
                <?php echo single_term_title('', false); ?>
            </h2>
            <?php if ($term_desc) : ?>
                <div class="term-description text-center max-w-4xl mx-auto mb-10 text-utility-gray-600">
                    <?php echo wp_kses_post($term_desc); ?>
                </div>
            <?php endif; ?>

			<div class="wrapper-main flex flex-col rem:gap-[38px]">
                <?php 
                // CASE A: If there are Child Terms (e.g. we are at Level 2, showing Level 3 Sections)
                if (!empty($child_terms) && !is_wp_error($child_terms)) :
                    foreach ($child_terms as $child_term) :
                        $child_query = get_products_in_term($child_term->term_id, $popups_data);
                        
                        // Only show section if it has products (optional, but good UX)
                        if ($child_query->have_posts()) :
                ?>
                <div class="section-product-category" id="<?php echo esc_attr($child_term->slug); ?>">
					<div class="category-name"><?php echo esc_html($child_term->name); ?></div>
					
                    <div class="wrapper-list grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:rem:gap-[93px] gap-base">
                        <?php 
                        while ($child_query->have_posts()) : $child_query->the_post();
                            $p_id = get_the_ID();
                            $p_title = get_the_title();
                            $p_thumb = get_the_post_thumbnail_url($p_id, 'large');
                            $p_color = get_field('color_text');
                            $p_value = get_field('value_text');
                            
                            $popup_id = 'popup-product-' . $p_id;
                            
                            // Collect data for popup rendering later
                            $popups_data[$p_id] = array(
                                'id' => $popup_id,
                                'title' => $p_title,
                                'content' => get_the_content(), // or get_the_excerpt()
                                'image' => $p_thumb,
                                'specs' => get_field('specs')
                            );
                        ?>
						<div class="product-category-item group">
							<div class="img"> 
                                <a class="img-ratio" href="#<?php echo esc_attr($popup_id); ?>" data-fancybox> 
                                    <img class="lozad" data-src="<?php echo esc_url($p_thumb); ?>" alt="<?php echo esc_attr($p_title); ?>" />
                                </a>
                            </div>
							<div class="content mt-5">
								<h3 class="title font-semibold text-base mb-1 group-hover:text-primary-1">
                                    <a href="#<?php echo esc_attr($popup_id); ?>" data-fancybox><?php echo esc_html($p_title); ?></a>
                                </h3>
								<div class="wrap-info flex flex-col gap-1 body-4 text-utility-gray-600">
                                    <?php if ($p_color): ?>
									<div class="color"><p><?php echo esc_html($p_color); ?></p></div>
                                    <?php endif; ?>
                                    <?php if ($p_value): ?>
									<div class="value"><?php echo esc_html($p_value); ?></div>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
                        <?php 
                        endwhile; 
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php 
                        endif; // End if have posts
                    endforeach; // End foreach child term

                // CASE B: NO Child Terms (Leaf Category Page, e.g. Level 3 directly)
                else : 
                    $current_query = get_products_in_term($current_term_id, $popups_data);
                    if ($current_query->have_posts()) :
                ?>
                <div class="section-product-category" id="<?php echo esc_attr($current_term->slug); ?>">
                    <!-- Optional: Don't repeat category name if it's the main page title, or do it for consistency -->
					<div class="category-name hidden"><?php echo esc_html($current_term->name); ?></div>
					
                    <div class="wrapper-list grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:rem:gap-[93px] gap-base">
                        <?php 
                        while ($current_query->have_posts()) : $current_query->the_post();
                            $p_id = get_the_ID();
                            $p_title = get_the_title();
                            $p_thumb = get_the_post_thumbnail_url($p_id, 'large');
                            $popup_id = 'popup-product-' . $p_id;
                            
                            $popups_data[$p_id] = array(
                                'id' => $popup_id,
                                'title' => $p_title,
                                'content' => get_the_content(),
                                'image' => $p_thumb,
                                'specs' => get_field('specs')
                            );
                        ?>
						<div class="product-category-item group">
							<div class="img"> 
                                <a class="img-ratio" href="#<?php echo esc_attr($popup_id); ?>" data-fancybox> 
                                    <img class="lozad" data-src="<?php echo esc_url($p_thumb); ?>" alt="<?php echo esc_attr($p_title); ?>" />
                                </a>
                            </div>
							<div class="content mt-5">
								<h3 class="title font-semibold text-base mb-1 group-hover:text-primary-1">
                                    <a href="#<?php echo esc_attr($popup_id); ?>" data-fancybox><?php echo esc_html($p_title); ?></a>
                                </h3>
								<div class="wrap-info flex flex-col gap-1 body-4 text-utility-gray-600">
                                    <?php if ($p_color): ?>
									<div class="color"><p><?php echo esc_html($p_color); ?></p></div>
                                    <?php endif; ?>
                                    <?php if ($p_value): ?>
									<div class="value"><?php echo esc_html($p_value); ?></div>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
                        <?php 
                        endwhile; 
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php 
                    else:
                        echo '<p class="text-center text-utility-gray-500">No products found in this category.</p>';
                    endif;
                endif; 
                ?>
			</div>
		</div>
	</section>

    <!-- Section: Other Products (Sibling Terms) -->
    <?php
    // Logic: Get siblings of the CURRENT term.
    // If current term is L2, siblings are other L2s.
    // If current term is L3, siblings are other L3s.
    $other_terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'exclude'  => array($current_term_id),
        'parent'   => $current_term->parent, 
        'number'   => 8,
        'hide_empty' => true // Should hide empty mostly
    ));

    if (!empty($other_terms) && !is_wp_error($other_terms)) :
    ?>
	<section class="section-product-list-2 section-py bg-utility-gray-50">
		<div class="container">
			<h2 class="title text-primary-1 font-semibold heading-1 mb-base text-center">Other products</h2>
			<div class="swiper-column-auto relative swiper-loop autoplay">
				<div class="swiper">
					<div class="swiper-wrapper">
                        <?php foreach ($other_terms as $other_term) : 
                             $o_img = get_field('image', $other_term);
                             $o_img_url = $o_img ? $o_img['url'] : '';
                             $o_link = get_term_link($other_term);
                        ?>
						<div class="swiper-slide">
							<div class="our-product-item">
								<div class="img"> 
                                    <a class="img-ratio ratio:pt-[213_320]" href="<?php echo esc_url($o_link); ?>"> 
                                        <img class="lozad" data-src="<?php echo esc_url($o_img_url); ?>" alt="<?php echo esc_attr($other_term->name); ?>" />
                                    </a>
                                </div>
								<div class="content py-3 px-2 text-center">
									<h3 class="title heading-5 text-primary-1 uppercase">
                                        <a href="<?php echo esc_url($o_link); ?>"><?php echo esc_html($other_term->name); ?></a>
                                    </h3>
								</div>
							</div>
						</div>
                        <?php endforeach; ?>
					</div>
				</div>
				<div class="wrap-button-slide">
					<div class="btn btn-sw-1 btn-prev"></div>
					<div class="btn btn-sw-1 btn-next"></div>
				</div>
			</div>
		</div>
	</section>
    <?php endif; ?>

    <!-- Render Popups from Collected Data -->
    <?php foreach ($popups_data as $popup) : ?>
	<div id="<?php echo esc_attr($popup['id']); ?>" style="display: none;" data-fancybox-modal>
		<div class="popup-content w-full relative z-50">
			<div class="wrapper-main grid md:grid-cols-[21.21%_1fr] grid-cols-1 gap-base">
				<div class="col-left">
					<div class="img img-ratio">
                        <img class="lozad" data-src="<?php echo esc_url($popup['image']); ?>" alt="<?php echo esc_attr($popup['title']); ?>" />
					</div>
				</div>
				<div class="col-right overflow-auto pr-10 rem:max-h-[644px] h-full">
					<div class="content-top pb-6 border-b border-b-[#DCDCDC]">
						<h3 class="title heading-2 font-semibold text-primary-1 mb-6 uppercase"><?php echo esc_html($popup['title']); ?></h3>
						<div class="desc body-1 font-medium text-utility-gray-900">
							<?php echo wp_kses_post($popup['content']); ?>
						</div>
					</div>
					<div class="content-bottom">
                        <?php if (!empty($popup['specs'])) : 
                                foreach ($popup['specs'] as $spec) :
                        ?>
						<div class="wrap-info flex md:flex-row flex-col md:gap-6 gap-3 py-3 body-1 text-utility-gray-950 border-b border-b-[#DCDCDC]">
							<div class="left rem:max-w-[280px] w-full">
								<div class="title font-bold"><?php echo esc_html($spec['label']); ?>:</div>
							</div>
							<div class="right flex-1 font-medium">
                                <?php echo nl2br(esc_html($spec['value'])); ?>
							</div>
						</div>
                        <?php 
                                endforeach;
                        endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php endforeach; ?>


    <?php  get_template_part('modules/common/section-contactHome'); ?>

</main>

<?php get_footer(); ?>
