<?php

class block_loms_course_filter_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'selection-courses-area row-space pb-50');
        $mform->setType('config_class', PARAM_RAW);

        // $mform->addElement('select', 'config_style', get_string('config_style', 'theme_loms'), array(1 => 'Style 1', 2 => 'Style 2'));
        // $mform->setDefault('config_style', 1);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'A Broad Selection Of Courses');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_content', 'Content');
        $mform->setDefault('config_content', 'Choose From 183,000 Online Video Courses With New Additions Published Every Month');
        $mform->setType('config_content', PARAM_RAW);

        // Total Student Title
        $mform->addElement('text', 'config_total_student_title', 'Total Students Title');
        $mform->setDefault('config_total_student_title', 'Students');
        $mform->setType('config_total_student_title', PARAM_RAW);

        $options = array(
            'multiple' => true,
            'noselectionstring' => get_string('select_from_dropdown_multiple', 'theme_loms'),
        );
        $mform->addElement('course', 'config_courses', get_string('courses'), $options);
        
        // Button Text
        $mform->addElement('text', 'config_btn', 'Button Text');
        $mform->setDefault('config_btn', 'View Courses');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_link', 'Button Link');
        $mform->setDefault('config_link', $CFG->wwwroot .'/course');
        $mform->setType('config_link', PARAM_RAW);

        // Image URL
        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--main-color)" href="https://docs.envytheme.com/docs/loms-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Class
        $mform->addElement('text', 'config_shape_class', get_string('config_shape_class', 'theme_loms'));
        $mform->setDefault('config_shape_class', 'borer text-center pb-100');
        $mform->setType('config_shape_class', PARAM_RAW);

        $mform->addElement('text', 'config_img', 'Section Shape Image');
        $mform->setDefault('config_img', LOMS_IMG .'border-shape-4.svg');
        $mform->setType('config_img', PARAM_TEXT);
    }
}
