<?php

class block_loms_cta_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'join-students-area bg-color-f5faff');
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Join Over 5M+ Students');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('text', 'config_content', 'Content');
        $mform->setDefault('config_content', 'Sign Up For A Free Account Today To Get Access To 400+ Free Courses, A Community Of Learners, And Live Events Every Week.');
        $mform->setType('config_content', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', 'Button Text');
        $mform->setDefault('config_btn', 'Sign Up For Free​');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_link', 'Button Link');
        $mform->setDefault('config_link', $CFG->wwwroot .'/login/index.php');
        $mform->setType('config_link', PARAM_RAW);

        // Image URL
        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--main-color)" href="https://docs.envytheme.com/docs/loms-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        $mform->addElement('text', 'config_img', 'Section Background Image URL');
        $mform->setDefault('config_img', LOMS_IMG .'join-students-bg.webp');
        $mform->setType('config_img', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img', 'Border Shape Image URL');
        $mform->setDefault('config_shape_img', LOMS_IMG .'border-shape-2.svg');
        $mform->setType('config_shape_img', PARAM_TEXT);
    }
}
