<?php

class block_loms_about_courses_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'transform-area overflow-hidden ove pt-100 pb-60 bg-color-fdfdfd​');
        $mform->setType('config_class', PARAM_RAW);

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_loms'), array(1 => 'Style 1', 2 => 'Style 2'));
        $mform->setDefault('config_style', 1);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Built To Empower Every Instructor​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_loms'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Instructors from around the world teach millions of students on Loms. We provide the tools and skills to teach what you love. And you can also achieve your goal with us.​');
        $mform->setType('config_body', PARAM_RAW);

        //  Button Text
        $mform->addElement('text', 'config_btn', get_string('config_button_text', 'theme_loms'));
        $mform->setDefault('config_btn', 'Find Out How');
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
        $mform->setDefault('config_video_img', LOMS_IMG .'transform.webp');
        $mform->setType('config_video_img', PARAM_TEXT);

        //  Video Title Text
        $mform->addElement('text', 'config_video_title', 'Video Title');
        $mform->setDefault('config_video_title', 'Watch Video From the Community How Loms Change Their Life');
        $mform->setType('config_video_title', PARAM_RAW);

        //  Student Name Text
        $mform->addElement('text', 'config_student_name', 'Video Student Name');
        $mform->setDefault('config_student_name', 'Victor james,');
        $mform->setType('config_student_name', PARAM_RAW);

        //  Student Content Text
        $mform->addElement('text', 'config_student_content', 'Video Student Content');
        $mform->setDefault('config_student_content', ', Loms’s Student');
        $mform->setType('config_student_content', PARAM_RAW);

        // Section Course
        $mform->addElement('header', 'config_course_heading', 'Section Course Control');
            
        $options = array(
            'multiple' => true,
            'noselectionstring' => get_string('select_from_dropdown_multiple', 'theme_loms'),
        );
        $mform->addElement('course', 'config_courses', get_string('courses'), $options);
    }
}
