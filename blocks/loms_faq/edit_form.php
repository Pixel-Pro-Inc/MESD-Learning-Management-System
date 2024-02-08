<?php

class block_loms_faq_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $lomsFontList = include($CFG->dirroot . '/theme/loms/inc/font_handler/loms_font_select.php');

        $faqnumber = 5;
        if(isset($this->block->config->faqnumber)){
            $faqnumber = $this->block->config->faqnumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
        
        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Find The Answer Of Your Questions');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_content', 'Section Content');
        $mform->setDefault('config_content', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.');
        $mform->setType('config_content', PARAM_RAW);

        $faqrange = array(
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

        $mform->addElement('select', 'config_faqnumber', 'Faq Number', $faqrange);
        $mform->setDefault('config_faqnumber', 5);

        for($i = 1; $i <= $tabNumber; $i++) {
            $mform->addElement('header', 'config_loms_item_item' . $i , 'Tab Item ' . $i);

            $mform->addElement('text', 'config_item_title' . $i, 'Title' . $i);
            $mform->setDefault('config_item_title' . $i, 'How Do We Create Course Content?');
            $mform->setType('config_item_title' . $i, PARAM_TEXT);
        
            $mform->addElement('textarea', 'config_item_content' . $i, 'Faq Content' . $i, 'wrap="virtual" rows="10" cols="50"');
            $mform->setDefault('config_item_content' . $i, '
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.');
            $mform->setType('config_item_content' . $i, PARAM_RAW);
        }
    }
}
