<?php
/**
 * Template Name: Page Products
 */
get_header();

// Get all parent categories (Level 1)
$parent_terms = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0,
    'orderby'    => 'menu_order', 
    'order'      => 'ASC'
));
?>

<main>
    <section class="global-breadcrumb">
        <div class="container">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </section>

    <section class="section-product-page-1">
        <h2 class="title text-primary-1 font-semibold heading-1 xl:mb-15 mb-base text-center">
            <?php the_title(); ?>
        </h2>
        
        <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)) : ?>
        <div class="our-product-top">
            <div class="container">
                <div class="our-product-top-list">
                    <div class="swiper-column-auto relative">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($parent_terms as $term) : 
                                    $term_img = get_field('image', $term);
                                    $img_url = $term_img ? $term_img['url'] : '';
                                    $section_id = 'product-cat-' . $term->term_id;
                                ?>
                                <div class="swiper-slide">
                                    <div class="our-product-item">
                                        <!-- Link anchor to section on same page -->
                                        <div class="img"> 
                                            <a class="img-ratio ratio:pt-[213_320] js-scroll-to-section" href="#<?php echo esc_attr($section_id); ?>" data-target="<?php echo esc_attr($section_id); ?>"> 
                                                <img class="lozad" data-src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($term->name); ?>" />
                                            </a>
                                        </div>
                                        <div class="content py-3 px-2 text-center">
                                            <h3 class="title heading-5 text-primary-1 uppercase">
                                                <a href="#<?php echo esc_attr($section_id); ?>" class="js-scroll-to-section" data-target="<?php echo esc_attr($section_id); ?>">
                                                    <?php echo esc_html($term->name); ?>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optional: Bottom slider if needed, or mirrored content -->
        <!-- <div class="our-product-bottom rem:mt-[33px]">...</div> -->
        <?php endif; ?>
    </section>

    <section class="section-product-page-2 section-py">
        <div class="container">
            <div class="wrapper-main flex flex-col gap-8">
                <?php 
                if (!empty($parent_terms)) :
                    foreach ($parent_terms as $parent_term) :
                        $section_id = 'product-cat-' . $parent_term->term_id;
                        
                        // Query Child Categories (Level 2)
                        $child_terms = get_terms(array(
                            'taxonomy'   => 'product_cat',
                            'hide_empty' => false,
                            'parent'     => $parent_term->term_id
                        ));
                        
                        // Only show section if it has content (optional check)
                        // display: block for now
                ?>
                <div class="section-product-category" id="<?php echo esc_attr($section_id); ?>">
                    <div class="category-name"><?php echo esc_html($parent_term->name); ?></div>
                    
                    <div class="wrapper-list grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:rem:gap-[93px] gap-base">
                        <?php 
                        if (!empty($child_terms) && !is_wp_error($child_terms)) :
                            foreach ($child_terms as $child) :
                                $child_img = get_field('image', $child);
                                $child_img_url = $child_img ? $child_img['url'] : '';
                                $child_link = get_term_link($child);
                        ?>
                        <div class="product-category-item group">
                            <div class="img"> 
                                <a class="img-ratio" href="<?php echo esc_url($child_link); ?>"> 
                                    <img class="lozad" data-src="<?php echo esc_url($child_img_url); ?>" alt="<?php echo esc_attr($child->name); ?>" />
                                </a>
                            </div>
                            <div class="content mt-5">
                                <h3 class="title font-semibold text-base mb-1 group-hover:text-primary-1">
                                    <a href="<?php echo esc_url($child_link); ?>"><?php echo esc_html($child->name); ?></a>
                                </h3>
                                <div class="wrap-info flex flex-col gap-1 body-4 text-utility-gray-600">
                                   <!-- Optional description or ACF fields for Sub-category -->
                                   <div class="value"><?php echo wp_kses_post(get_field('content', $child)); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endforeach;
                        else:
                            // Fallback: If no sub-cats, maybe show recent products?
                            echo '<p>No sub-categories found.</p>';
                        endif;
                        ?>
                    </div>
                    
                    <!-- View All Button: Links to Parent Category Archive? Or just removed if showing all subcats -->
                    <div class="button-view-all flex-center mt-base">
                        <button class="btn btn-more js-view-all-products" onclick="window.location.href='<?php echo get_term_link($parent_term); ?>'">
                            <span>View All</span>
                            <div class="icon">
                                <i class="fa-light fa-chevron-down"></i>
                            </div>
                        </button>
                    </div>
                </div>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>
        </div>
    </section>
    <?php  get_template_part('modules/common/section-contactHome'); ?>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Simple smooth scroll script handling
    const links = document.querySelectorAll('.js-scroll-to-section');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const headerOffset = 100; // Adjust based on sticky header height
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
});
</script>

<?php get_footer(); ?>
