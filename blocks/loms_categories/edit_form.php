<?php
require_once($CFG->dirroot . '/theme/loms/inc/course_handler/loms_course_handler.php');

class block_loms_categories_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');
        $lomsCourseHandler = new lomsCourseHandler();
        $lomsCourseCategories = $lomsCourseHandler->lomsListCategories();

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'categories-area pb-100');
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Unlimited Access To <span>400+</span> Courses And <span>1,800+</span> Hands-On Labs');
        $mform->setType('config_title', PARAM_RAW);

        $items = 8;
        if(isset($this->block->config->items)){
            $items = $this->block->config->items;
        }

        $items_range = array(
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
        $items_max = 30;

        $mform->addElement('select', 'config_items', get_string('config_items', 'theme_loms'), $items_range);
        $mform->setDefault('config_items', 8);

        for($i = 1; $i <= $items; $i++) {
            $mform->addElement('header', 'config_loms_item' . $i , get_string('config_item', 'theme_loms') .' '. $i);

            $options = array(
                'multiple' => false,
            );
            $mform->addElement('autocomplete', 'config_category' . $i, get_string('category'), $lomsCourseCategories, $options);

            $mform->addElement('text', 'config_img' . $i, 'Category Icon ' . $i);
            if($i <= 5):
                $mform->setDefault('config_img' . $i, $CFG->wwwroot.'/theme/loms/pix/categories/categories-'.$i.'.svg');
            else:
                $mform->setDefault('config_img' . $i, $CFG->wwwroot.'/theme/loms/pix/categories/categories-1.svg');
            endif;
            $mform->setType('config_img' . $i, PARAM_TEXT);
        }

        $mform->addElement('header', 'config_loms_content', 'Section Content');

        // Content
        $mform->addElement('text', 'config_body', get_string('config_body', 'theme_loms'));
        $mform->setDefault('config_body', 'Browse All Different <a href="#">124+ Categories <img src="'.LOMS_IMG.'icon/arrow-rights.svg"></a>');
        $mform->setType('config_body', PARAM_RAW); 

        // Shape Images
        $mform->addElement('text', 'config_shape_img1', 'Banner Shape Image 1');
        $mform->setDefault('config_shape_img1', LOMS_IMG .'categories-shape.svg');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        // Class
        $mform->addElement('text', 'config_shape_class', 'Borer Section Class');
        $mform->setDefault('config_shape_class', 'borer text-center');
        $mform->setType('config_shape_class', PARAM_RAW);

        $mform->addElement('text', 'config_img', 'Borer Section Shape Image');
        $mform->setDefault('config_img', LOMS_IMG .'border-shape-4.svg');
        $mform->setType('config_img', PARAM_TEXT);
    }
}
