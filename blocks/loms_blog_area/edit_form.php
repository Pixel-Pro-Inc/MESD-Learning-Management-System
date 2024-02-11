<?php

class block_loms_blog_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_loms'));
        $mform->setDefault('config_title', 'Want To Learn More? Read Blog');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_loms'));
        $mform->setDefault('config_body', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', 'Read More Button Text');
        $mform->setDefault('config_button_text', 'Read More');
        $mform->setType('config_button_text', PARAM_RAW);


        if (!empty($this->block->config) && is_object($this->block->config)) {
            $data = $this->block->config;
        } else {
            $data = new stdClass();
            $data->slidesnumber = 0;
        }

        $searchareas = \core_search\manager::get_search_areas_list(true);
        $areanames = array();
        foreach ($searchareas as $areaid => $searcharea) {
            $areanames[$areaid] = $searcharea->get_visible_name();
        }

        $bloglisting = new blog_listing();

        $entries = $bloglisting->get_entries();
        $entrieslist = array();

        foreach ($entries as $entryid => $entry) {
          $entrieslist[$entry->id] = $entry->subject;
        }

        $options = array(
            'multiple' => true,
        );
        $mform->addElement('autocomplete', 'config_posts', get_string('posts'), $entrieslist, $options);
    }
}
