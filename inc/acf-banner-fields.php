<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_banner_details',
        'title' => 'Banner Slides',
        'fields' => array(
            array(
                'key' => 'field_banner_slides',
                'label' => 'Slides',
                'name' => 'banner_slides',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Slide',
                'sub_fields' => array(
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_slide_sub_title',
                        'label' => 'Sub Title',
                        'name' => 'sub_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'wysiwyg',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'banner',
                ),
            ),
        ),
    ));

endif;
