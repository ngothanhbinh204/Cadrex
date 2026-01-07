<?php
if (have_rows('home_news')):
    while (have_rows('home_news')): the_row();
        if (!get_sub_field('enable_section')) continue;

        $title         = get_sub_field('title');
        $selected_cats = get_sub_field('news_categories'); // array các category ID đã chọn
        $discover_link = get_sub_field('discover_link');

        // Chuẩn bị dữ liệu: lấy tất cả bài viết và phân loại theo category
        $posts_by_cat = ['all' => []]; // 'all' chứa tất cả bài viết
        $categories   = [];           // danh sách category để tạo tab

        if ($selected_cats && is_array($selected_cats)) {
            // Lấy thông tin các category đã chọn để làm tab
            foreach ($selected_cats as $cat_id) {
                $term = get_term($cat_id, 'category');
                if ($term && !is_wp_error($term)) {
                    $categories[$term->slug] = $term->name;
                    $posts_by_cat[$term->slug] = [];
                }
            }

            // Query tất cả bài viết thuộc các category đã chọn
            $args = [
                'post_type'      => 'post',
                'posts_per_page' => -1,
                'category__in'   => $selected_cats,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ];
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $post_cats = get_the_category();
                    $cat_slugs = wp_list_pluck($post_cats, 'slug');
                    $cat_attr  = implode(' ', $cat_slugs);

                    $post_data = [
                        'id'        => get_the_ID(),
                        'title'     => get_the_title(),
                        'permalink' => get_permalink(),
                        'excerpt'   => get_the_excerpt(),
                        'date'      => get_the_date('d M Y'),
                        'image'     => get_image_post(get_the_ID()), // giữ nguyên hàm cũ của bạn
                        'cat_attr'  => $cat_attr,
                    ];

                    // Thêm vào tab "All"
                    $posts_by_cat['all'][] = $post_data;

                    // Thêm vào các tab category tương ứng
                    foreach ($cat_slugs as $slug) {
                        if (isset($posts_by_cat[$slug])) {
                            $posts_by_cat[$slug][] = $post_data;
                        }
                    }
                }
                wp_reset_postdata();
            }
        }
?>
<section class="section-py section-home-news">
	<div class="wrap container" data-toggle="tabslet">
		<div class="box-title" data-aos="fade-down" data-aos-delay="100" data-duration="200">
			<h2 class="title heading-1 text-primary-1"><?php echo esc_html($title); ?></h2>
			<div class="box-tab">
				<ul class="tabslet-tab overflow-x-scroll w-screen">
					<li class="active">
						<a href="#all">All</a>
					</li>
					<?php foreach ($categories as $slug => $name): ?>
					<li>
						<a href="#<?php echo esc_attr($slug); ?>">
							<?php echo esc_html($name); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<!-- Tab All -->
		<div class="tabslet-content active" id="all" data-aos="fade-up" data-aos-delay="100" data-duration="200">
			<div class="swiper swiper-news">
				<div class="swiper-wrapper">
					<?php foreach ($posts_by_cat['all'] as $post): ?>
					<div class="swiper-slide" data-category="<?php echo esc_attr($post['cat_attr']); ?>">
						<div class="item-news zoom-img-parent">
							<div class="box-image img-ratio ratio:pt-[240_320] img-zoom">
								<?php echo $post['image']; ?>
							</div>
							<div class="box-content">
								<a class="title heading-4" href="<?php echo esc_url($post['permalink']); ?>">
									<?php echo esc_html($post['title']); ?>
								</a>
								<div class="decs body-3 text-utility-gray-800 line-clamp-4">
									<?php echo wp_kses_post($post['excerpt']); ?>
								</div>
								<div class="time-news body-4">
									<span><?php echo esc_html($post['date']); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<span class="btn btn-prev"><i class="fa-regular fa-arrow-left"></i></span>
			<span class="btn btn-next"><i class="fa-regular fa-arrow-right"></i></span>
		</div>

		<!-- Các tab category riêng biệt -->
		<?php foreach ($categories as $slug => $name): ?>
		<div class="tabslet-content" id="<?php echo esc_attr($slug); ?>" data-aos="fade-up" data-aos-delay="100"
			data-duration="200">
			<div class="swiper swiper-news">
				<div class="swiper-wrapper">
					<?php foreach ($posts_by_cat[$slug] as $post): ?>
					<div class="swiper-slide">
						<div class="item-news zoom-img-parent">
							<div class="box-image img-ratio ratio:pt-[240_320] img-zoom">
								<?php echo $post['image']; ?>
							</div>
							<div class="box-content">
								<!-- Bạn có thể tùy chỉnh thêm format-content cho một số category cụ thể nếu cần -->
								<a class="title heading-4" href="<?php echo esc_url($post['permalink']); ?>">
									<?php echo esc_html($post['title']); ?>
								</a>
								<div class="decs body-3 text-utility-gray-800 line-clamp-4">
									<?php echo wp_kses_post($post['excerpt']); ?>
								</div>
								<div class="time-news body-4">
									<span><?php echo esc_html($post['date']); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<span class="btn btn-prev"><i class="fa-regular fa-arrow-left"></i></span>
			<span class="btn btn-next"><i class="fa-regular fa-arrow-right"></i></span>
		</div>
		<?php endforeach; ?>

		<div class="flex-center">
			<?php if ($discover_link && !empty($discover_link['url'])): ?>
			<a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined"
				href="<?php echo esc_url($discover_link['url']); ?>"
				target="<?php echo esc_attr($discover_link['target'] ? $discover_link['target'] : '_self'); ?>">
				<span><?php echo esc_html($discover_link['title']); ?></span>
			</a>
			<?php else: ?>
			<a class="btn-primary body-2 text-white bg-primary-4 px-6 py-3 rounded-1 hover:bg-primary-1 undefined"
				href="#">
				<span>Discover more</span>
			</a>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
    endwhile;
endif;
?>