<?php

class block_loms_features_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        $features_number = 4;
        if(isset($this->block->config->features_number)){
            $features_number = $this->block->config->features_number;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', 'Section Title');
        $mform->setDefault('config_title', 'Our Course Qualities');
        $mform->setType('config_title', PARAM_TEXT);

        // Content
        $mform->addElement('text', 'config_content', 'Section Content');
        $mform->setDefault('config_content', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.');
        $mform->setType('config_content', PARAM_TEXT);

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
        $mform->setDefault('config_features_number', 4);

        for($i = 1; $i <= $features_number; $i++) {
            $mform->addElement('header', 'config_loms_item' . $i , get_string('config_item', 'theme_loms') . $i);

            // Image URL
            $mform->addElement('static', 'config_image_doc' . $i, '<b><a style="color: var(--main-color)" href="https://docs.envytheme.com/docs/loms-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

            $mform->addElement('text', 'config_img' . $i, 'Feature Icon' . $i);
            if($i <= 4):
                $mform->setDefault('config_img' . $i, LOMS_IMG .'qualities/qualities-'.$i.'.webp');
            else:
                $mform->setDefault('config_img' . $i, LOMS_IMG .'qualities/qualities-1.webp');
            endif;
            $mform->setType('config_img' . $i, PARAM_TEXT);

            // Title
            $mform->addElement('text', 'config_features_title' . $i, get_string('config_title', 'theme_loms', $i));
            $mform->setDefault('config_features_title' . $i, 'Project Based');
            $mform->setType('config_features_title' . $i, PARAM_TEXT);

            // Card Content
            $mform->addElement('text', 'config_features_content' . $i, get_string('config_content', 'theme_loms', $i));
            $mform->setDefault('config_features_content' . $i, 'Build Real Products While Learning The Live Tutorial');
            $mform->setType('config_features_content' . $i, PARAM_TEXT);
        }
    }
}
