<?php

class block_loms_partners_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
        
        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_loms'));
        $mform->setDefault('config_class', 'partner-area bg-color-f9f9f9 ptb-100');
        $mform->setType('config_class', PARAM_RAW);

        // Content
        $mform->addElement('text', 'config_body', get_string('config_body', 'theme_loms'));
        $mform->setDefault('config_body', 'Trusted By Leading Universities & Companies');
        $mform->setType('config_body', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_loms'));

        // Image
        $mform->addElement('filemanager', 'config_image', get_string('config_image', 'block_loms_partners'), null,
                array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => null ));
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_loms_partners', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_loms_partners', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
