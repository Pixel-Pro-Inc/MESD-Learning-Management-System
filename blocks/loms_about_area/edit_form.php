<?php

class block_loms_about_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_loms'), array(1 => 'Style 1', 2 => 'Style 2'));
        $mform->setDefault('config_style', 1);

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'successful-area bg-color-fdfdfd pt-100 pb-100​');
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Become A Successful Instructor Of Our Community​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_loms'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Instructors from around the world teach millions of students on Loms. We provide the tools and skills to teach what you love. And you can also achieve your goal with us.​');
        $mform->setType('config_body', PARAM_RAW);

        //  Button Text
        $mform->addElement('text', 'config_btn', get_string('config_button_text', 'theme_loms'));
        $mform->setDefault('config_btn', 'Start Teaching Today');
        $mform->setType('config_btn', PARAM_RAW);

        //  Button Link
        $mform->addElement('text', 'config_btn_link', get_string('config_button_link', 'theme_loms'));
        $mform->setDefault('config_btn_link', $CFG->wwwroot .'/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        //  Video Link
        $mform->addElement('text', 'config_video', get_string('config_video', 'theme_loms'));
        $mform->setDefault('config_video', 'https://www.youtube.com/watch?v=_aB9Tg6SRA0');
        $mform->setType('config_video', PARAM_RAW);

        $mform->addElement('text', 'config_video_img', 'Video Image URL');
        $mform->setDefault('config_video_img', LOMS_IMG .'successful.webp');
        $mform->setType('config_video_img', PARAM_TEXT);

        //  Video Title Text
        $mform->addElement('text', 'config_video_title', 'Video Title');
        $mform->setDefault('config_video_title', 'Watch Video From The Leaders How Apply For Teaching');
        $mform->setType('config_video_title', PARAM_RAW);

        //  Student Name Text
        $mform->addElement('text', 'config_student_name', 'Video Student Name');
        $mform->setDefault('config_student_name', 'Magneta dsuza, ');
        $mform->setType('config_student_name', PARAM_RAW);

        //  Student Content Text
        $mform->addElement('text', 'config_student_content', 'Video Student Content');
        $mform->setDefault('config_student_content', 'Loms Top Author');
        $mform->setType('config_student_content', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_loms'));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--primaryColor)" href="https://docs.envytheme.com/docs/loms-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>');
            
        $mform->addElement('text', 'config_img', get_string('config_image', 'theme_loms'));
        $mform->setDefault('config_img', LOMS_IMG .'successful-img.webp');
        $mform->setType('config_img', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img', 'Shape Image');
        $mform->setDefault('config_shape_img', LOMS_IMG .'successful-shape.svg');
        $mform->setType('config_shape_img', PARAM_TEXT);

        $mform->addElement('text', 'config_border_shape_img', 'Border Shape Image');
        $mform->setDefault('config_border_shape_img', LOMS_IMG .'border-shape-1.svg');
        $mform->setType('config_border_shape_img', PARAM_TEXT);
    }
}
