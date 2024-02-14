<?php

class block_loms_contact_info_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');

        $features_number = 3;
        if(isset($this->block->config->features_number)){
            $features_number = $this->block->config->features_number;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Shape Image
        $mform->addElement('text', 'config_shape_img', 'Shape Image URL');
        $mform->setDefault('config_shape_img', LOMS_IMG .'info-shape.svg');
        $mform->setType('config_shape_img', PARAM_TEXT);

        $featuresrange = array(
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

        $mform->addElement('select', 'config_features_number', get_string('config_items', 'theme_loms'), $featuresrange);
        $mform->setDefault('config_features_number', 3);

        for($i = 1; $i <= $features_number; $i++) {
            $mform->addElement('header', 'config_loms_item' . $i , get_string('config_item', 'theme_loms') . $i);

            // Field Icon
            $select = $mform->addElement('select', 'config_icon' . $i, 'Card Icon' . $i, $lomsFontList, array('class'=>'loms_icon_class'));
            $select->setSelected('ri-phone-fill');

            // Content 
            $mform->addElement('textarea', 'config_features_content' . $i, 'Crd Content' .$i);
            $mform->setDefault('config_features_content' . $i, 'Phone: <a href="tel:+(323)750-1234">+(323) 750-1234</a>');
            $mform->setType('config_features_content' . $i, PARAM_RAW);
        }
    }
}
