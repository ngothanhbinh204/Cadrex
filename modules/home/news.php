<?php
$title = get_sub_field('title');
// Use a Taxonomy field (Checkbox or Multi-select) to choose categories
$selected_cats = get_sub_field('news_categories'); 
$discover_link = get_sub_field('discover_link');

// Fallback if no specific selection, maybe show all? Defaulting to require selection.
?>
<section class="section-py section-home-news"> 
    <div class="wrap container" data-toggle="tabslet">
        <div class="box-title" data-aos="fade-down" data-aos-delay="100" data-duration="200">
            <h2 class="title heading-1 text-primary-1"><?php echo $title; ?></h2>
            <div class="box-tab">
                <ul class="tabslet-tab overflow-x-scroll w-screen">
                    <li class="active"><a href="#tab-all" data-filter="all"> All</a></li>
                    <?php 
                    if ($selected_cats):
                        foreach($selected_cats as $cat_id): 
                            $term = get_term($cat_id);
                            if($term):
                    ?>
                    <li><a href="#tab-<?php echo $term->term_id; ?>" data-filter="<?php echo $term->slug; ?>"> <?php echo $term->name; ?></a></li>
                            <?php 
                            endif;
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        
        <!-- The HTML structure uses one .tabslet-content area with filtered slides? 
             Actually original HTML had `data-filter="company"` on swiper-slide. 
             So we should render ALL posts from SELECTED categories into one swiper, 
             and let the JS or tabslet handle filtering if that's how it works 
             OR render tab panes if tabslet switches content. 
             
             Looking at the original HTML:
             <div class="tabslet-content active" id="tab1" data-filter="all" ...>
               <div class="swiper swiper-news"> ... <div class="swiper-slide" data-category="company"> ...
             
             It seems all items are loaded in one swiper, and filtered using data-category.
             However, the tab links had `href="#tab1"`. 
             
             If I implement strictly as requested "Click into each category will display posts of that category", 
             and given standard WP behavior, we might query all posts from these categories.
        -->
        <div class="tabslet-content active" id="tab-all" data-filter="all" data-aos="fade-up" data-aos-delay="100" data-duration="200">
            <div class="swiper swiper-news">
                <div class="swiper-wrapper">
                    <?php 
                    if ($selected_cats):
                        // Get all posts from these categories
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 10,
                            'category__in' => $selected_cats,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post();
                                $cats = get_the_category();
                                $cat_slug = !empty($cats) ? $cats[0]->slug : '';
                                $image_id = get_post_thumbnail_id();
                    ?>
                    <div class="swiper-slide" data-category="<?php echo $cat_slug; ?>">
                        <div class="item-news zoom-img-parent">
                            <div class="box-image img-ratio ratio:pt-[240_320] img-zoom">
                                <?php echo get_image_post(get_the_ID()); ?>
                            </div>
                            <div class="box-content">
                                <a class="title heading-4" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="decs body-3 text-utility-gray-800 line-clamp-4">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="time-news body-4"><span><?php echo get_the_date('d M Y'); ?></span></div>
                            </div>
                        </div>
                    </div>
                    <?php 
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                </div>
            </div>
            <span class="btn btn-prev"><i class="fa-regular fa-arrow-left"></i></span><span class="btn btn-next">
                 <i class="fa-regular fa-arrow-right"></i></span>
        </div>
        
        <div class="flex-center">
             <?php if ($discover_link): ?>
            <a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined" href="<?php echo esc_url($discover_link['url']); ?>" target="<?php echo esc_attr($discover_link['target'] ? $discover_link['target'] : '_self'); ?>"><span><?php echo esc_html($discover_link['title']); ?></span></a>
            <?php else: ?>
             <a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined" href=""><span>Discover more</span></a>
            <?php endif; ?>
        </div>
    </div>
</section>
