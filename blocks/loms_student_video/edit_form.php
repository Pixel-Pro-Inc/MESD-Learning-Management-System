<?php

class block_loms_student_video_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        $sliderNumber = 2;
        if(isset($this->block->config->sliderNumber)){
            $sliderNumber = $this->block->config->sliderNumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
        
        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'testimonials-area pt-100 pb-70');
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Student All Over The World Love LOMS');
        $mform->setType('config_title', PARAM_RAW);

        $mform->addElement('text', 'config_border_img', 'Section Border Shape Image');
        $mform->setType('config_border_img', PARAM_TEXT);

        $sliderrange = array(
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

        $mform->addElement('select', 'config_sliderNumber', get_string('config_items', 'theme_loms'), $sliderrange);
        $mform->setDefault('config_sliderNumber', 2);

        for($i = 1; $i <= $sliderNumber; $i++) {
            $mform->addElement('header', 'config_loms_item' . $i , get_string('config_item', 'theme_loms') . $i);

            $mform->addElement('text', 'config_img' . $i, 'Slider Image' . $i);
            if($i <= 2):
                $mform->setDefault('config_img' . $i, LOMS_IMG .'testimonials/testimonials-'.$i.'.webp');
            else:
                $mform->setDefault('config_img' . $i, LOMS_IMG .'testimonials/testimonials-1.webp');
            endif;
            $mform->setType('config_img' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_sm_img' . $i, 'Slider Small Image' . $i);
            if($i <= 2):
                $mform->setDefault('config_sm_img' . $i, LOMS_IMG .'testimonials/thumb/testimonials-'.$i.'.webp');
            else:
                $mform->setDefault('config_sm_img' . $i, LOMS_IMG .'testimonials/thumb/testimonials-1.webp');
            endif;
            $mform->setType('config_sm_img' . $i, PARAM_TEXT);

            // Video
            $mform->addElement('text', 'config_slider_video' . $i, ' Student Youtube Video ', $i);
            $mform->setDefault('config_slider_video' . $i, 'https://www.youtube.com/watch?v=_aB9Tg6SRA0');
            $mform->setType('config_slider_video' . $i, PARAM_TEXT);

            // Name
            $mform->addElement('text', 'config_slider_name' . $i, ' Name', $i);
            $mform->setDefault('config_slider_name' . $i, 'Victor James');
            $mform->setType('config_slider_name' . $i, PARAM_TEXT);

            // Designation
            $mform->addElement('text', 'config_slider_designation' . $i, ' Designation', $i);
            $mform->setDefault('config_slider_designation' . $i, 'Solit IT Solution');
            $mform->setType('config_slider_designation' . $i, PARAM_TEXT);

            // Flag
            $mform->addElement('text', 'config_flag' . $i, 'Flag Image' . $i);
            $mform->setDefault('config_flag' . $i, LOMS_IMG .'testimonials/flag-1.webp');
            $mform->setType('config_flag' . $i, PARAM_TEXT);
        }
    }
}
