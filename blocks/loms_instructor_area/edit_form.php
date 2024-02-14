<?php

class block_loms_instructor_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');

        $itemNumber = 5;
        if(isset($this->block->config->itemNumber)){
            $itemNumber = $this->block->config->itemNumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_loms'), array(1 => 'Style 1', 2 => 'Style 2'));
        $mform->setDefault('config_style', 1);

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'instructor-area ptb-100');
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Classes Taught By Real Creators​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_loms'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.');
        $mform->setType('config_body', PARAM_RAW);

        $mform->addElement('text', 'config_border_img', 'Section Border Shape Image');
        $mform->setType('config_border_img', PARAM_TEXT);

        $range = array(
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11',
            12 => '12',
            13 => '13',
            14 => '14',
            15 => '15',
            16 => '16',
            17 => '17',
            18 => '18',
            19 => '19',
            20 => '20',
            21 => '21',
            22 => '22',
            23 => '23',
            24 => '24',
            25 => '25',
            26 => '26',
            27 => '27',
            28 => '28',
            29 => '29',
            30 => '30',
        );

        $mform->addElement('select', 'config_itemNumber', get_string('config_items', 'theme_loms'), $range);
        $mform->setDefault('config_itemNumber', 5);

        for($i = 1; $i <= $itemNumber; $i++) {
            $mform->addElement('header', 'config_loms_item' . $i , get_string('config_item', 'theme_loms') . $i);

            $mform->addElement('text', 'config_instructor_name' . $i, get_string('config_instructor_name', 'block_loms_instructor_area', $i));
            $mform->setDefault('config_instructor_name' . $i, 'William James');
            $mform->setType('config_instructor_name' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_instructor_designation' . $i, get_string('config_instructor_designation', 'block_loms_instructor_area', $i));
            $mform->setDefault('config_instructor_designation' . $i, 'Full Stack Developer');
            $mform->setType('config_instructor_designation' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_instructor_img' . $i, get_string('config_instructor_img', 'block_loms_instructor_area', $i));
            if($i <= 5):
                $mform->setDefault('config_instructor_img' . $i, LOMS_IMG .'instructor/instructor-'.$i.'.webp');
            else:
                $mform->setDefault('config_instructor_img' . $i, LOMS_IMG .'instructor/instructor-1.webp');
            endif;
            $mform->setType('config_instructor_img' . $i, PARAM_TEXT);
        }
    }
}
