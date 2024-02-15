<?php

class block_loms_banner_1_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', 'Banner Title');
        $mform->setDefault('config_title', 'Build Better <span>Skills</span> With Loms');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_content', 'Banner Content', 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_content', 'We Have <span>40k+</span> Online Courses & <span>500k+</span> Online Registered Student. Develop The Skills You Need For Your Top Priorities. Improve Workflows With Actionable Data. Build Better—every Time With The Great Loms Family.');
        $mform->setType('config_content', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', 'Button Text');
        $mform->setDefault('config_btn', 'Find Courses Now');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', 'Button Link');
        $mform->setDefault('config_btn_link', $CFG->wwwroot .'/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Button Shape 
        $mform->addElement('text', 'config_btn_shape', 'Button Shape Image URL');
        $mform->setDefault('config_btn_shape', LOMS_IMG .'banner/more-3.svg');
        $mform->setType('config_btn_shape', PARAM_TEXT);

        // Image Section
        $mform->addElement('header', 'config_image_area', 'Image Area Content');

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--main-color)" href="https://docs.envytheme.com/docs/loms-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Banner Image 1
        $mform->addElement('text', 'config_banner_img1', 'Banner Image 1 URL');
        $mform->setType('config_banner_img1', PARAM_TEXT);
        $mform->setDefault('config_banner_img1', LOMS_IMG .'banner/banner-img-1.webp');
        $mform->setType('config_banner_img1', PARAM_TEXT);

            // Icon 
            $mform->addElement('text', 'config_image1_icon', 'Image 1 Icon Image URL');
            $mform->setDefault('config_image1_icon', LOMS_IMG .'icon/rocket.svg');
            $mform->setType('config_image1_icon', PARAM_TEXT);

            // Content
            $mform->addElement('text', 'config_image1_content', 'Image 1 Content');
            $mform->setDefault('config_image1_content', 'Develop your <span>skill</span> as fast as <span>rocket</span>');
            $mform->setType('config_image1_content', PARAM_RAW);

             // Shape 
             $mform->addElement('text', 'config_image1_shape', 'Image 1 Shape URL');
             $mform->setDefault('config_image1_shape', LOMS_IMG .'banner/more-1.svg');
             $mform->setType('config_image1_shape', PARAM_TEXT);

        // Banner Image 2
        $mform->addElement('text', 'config_banner_img2', 'Banner Image 2 URL');
        $mform->setType('config_banner_img2', PARAM_TEXT);
        $mform->setDefault('config_banner_img2', LOMS_IMG .'banner/banner-img-2.webp');
        $mform->setType('config_banner_img2', PARAM_TEXT);

            // Icon 
            $mform->addElement('text', 'config_image2_icon', 'Image 2 Icon Image URL');
            $mform->setDefault('config_image2_icon', LOMS_IMG .'icon/award-2.svg');
            $mform->setType('config_image2_icon', PARAM_TEXT);

            // Content
            $mform->addElement('text', 'config_image2_content', 'Image 2 Content');
            $mform->setDefault('config_image2_content', 'Got <span>5 star</span> review from <span>3 Million</span> students');
            $mform->setType('config_image2_content', PARAM_RAW);

            // Shape 
            $mform->addElement('text', 'config_image2_shape', 'Image 2 Shape URL');
            $mform->setDefault('config_image2_shape', LOMS_IMG .'banner/more-2.svg');
            $mform->setType('config_image2_shape', PARAM_TEXT);

        // Section Background Images
        $mform->addElement('text', 'config_section_bg', 'Banner Section Background Image URL');
        $mform->setDefault('config_section_bg', LOMS_IMG .'banner/banner-bg-3.webp');
        $mform->setType('config_section_bg', PARAM_TEXT);

        // Shape Images
        $mform->addElement('text', 'config_shape_img1', 'Banner Shape Image 1');
        $mform->setDefault('config_shape_img1', LOMS_IMG .'banner/banner-shape-6.svg');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Banner Shape Image 2');
        $mform->setDefault('config_shape_img2', LOMS_IMG .'banner/banner-shape-4.svg');
        $mform->setType('config_shape_img2', PARAM_TEXT);
        
        $mform->addElement('text', 'config_shape_img3', 'Banner Shape Image 3');
        $mform->setDefault('config_shape_img3', LOMS_IMG .'banner/banner-shape-5.svg');
        $mform->setType('config_shape_img3', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img4', 'Banner Shape Image 4');
        $mform->setDefault('config_shape_img4', LOMS_IMG .'banner/banner-shape-3.svg');
        $mform->setType('config_shape_img4', PARAM_TEXT);
    }
}
