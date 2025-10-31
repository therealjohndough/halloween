<?php
/**
 * ACF Hero Slider Fields for Skyworld Cannabis Homepage
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_hero_slider',
    'title' => 'Homepage Hero Slider',
    'fields' => array(
        array(
            'key' => 'field_hero_slides',
            'label' => 'Hero Slides',
            'name' => 'hero_slides',
            'type' => 'repeater',
            'instructions' => 'Add 3-5 hero slides for the homepage carousel',
            'required' => 1,
            'conditional_logic' => 0,
            'min' => 3,
            'max' => 5,
            'layout' => 'table',
            'button_label' => 'Add Hero Slide',
            'sub_fields' => array(
                array(
                    'key' => 'field_slide_background',
                    'label' => 'Background Image',
                    'name' => 'slide_background',
                    'type' => 'image',
                    'instructions' => 'High-res cannabis product or facility image (1920x1080 recommended)',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_slide_headline',
                    'label' => 'Headline',
                    'name' => 'slide_headline',
                    'type' => 'text',
                    'instructions' => 'Main hero headline (e.g., "Premium Indoor Cannabis")',
                    'required' => 1,
                    'maxlength' => 80,
                ),
                array(
                    'key' => 'field_slide_subheadline',
                    'label' => 'Subheadline',
                    'name' => 'slide_subheadline',
                    'type' => 'textarea',
                    'instructions' => 'Supporting text (e.g., "Rooted in Indigenous Tradition")',
                    'required' => 0,
                    'rows' => 2,
                    'maxlength' => 160,
                ),
                array(
                    'key' => 'field_slide_cta_primary',
                    'label' => 'Primary CTA Button',
                    'name' => 'slide_cta_primary',
                    'type' => 'group',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_cta_primary_text',
                            'label' => 'Button Text',
                            'name' => 'text',
                            'type' => 'text',
                            'default_value' => 'Explore Our Flower',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_cta_primary_url',
                            'label' => 'Button URL',
                            'name' => 'url',
                            'type' => 'url',
                            'default_value' => '/strains/',
                            'required' => 1,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_slide_cta_secondary',
                    'label' => 'Secondary CTA Button',
                    'name' => 'slide_cta_secondary',
                    'type' => 'group',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_cta_secondary_text',
                            'label' => 'Button Text',
                            'name' => 'text',
                            'type' => 'text',
                            'default_value' => 'Find Skyworld Near You',
                            'required' => 0,
                        ),
                        array(
                            'key' => 'field_cta_secondary_url',
                            'label' => 'Button URL',
                            'name' => 'url',
                            'type' => 'url',
                            'default_value' => '/store-locator/',
                            'required' => 0,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_slide_strain_highlight',
                    'label' => 'Featured Strain',
                    'name' => 'slide_strain_highlight',
                    'type' => 'post_object',
                    'instructions' => 'Optionally feature a specific strain on this slide',
                    'required' => 0,
                    'post_type' => array('strains'),
                    'return_format' => 'object',
                ),
            ),
        ),
        array(
            'key' => 'field_press_logos',
            'label' => 'Press & Media Logos',
            'name' => 'press_logos',
            'type' => 'repeater',
            'instructions' => 'Add press/media outlet logos for the marquee section',
            'required' => 0,
            'min' => 0,
            'max' => 12,
            'layout' => 'table',
            'button_label' => 'Add Press Logo',
            'sub_fields' => array(
                array(
                    'key' => 'field_press_logo_image',
                    'label' => 'Logo Image',
                    'name' => 'logo_image',
                    'type' => 'image',
                    'instructions' => 'Press outlet logo (PNG/SVG preferred, white/transparent background)',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                ),
                array(
                    'key' => 'field_press_logo_name',
                    'label' => 'Media Outlet Name',
                    'name' => 'logo_name',
                    'type' => 'text',
                    'instructions' => 'Name of press outlet (for alt text)',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_press_logo_url',
                    'label' => 'Article/Feature URL',
                    'name' => 'logo_url',
                    'type' => 'url',
                    'instructions' => 'Optional link to article or feature',
                    'required' => 0,
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'front-page.php',
            ),
        ),
        array(
            array(
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

endif;