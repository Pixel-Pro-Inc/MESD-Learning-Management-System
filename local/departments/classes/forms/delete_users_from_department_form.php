<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class delete_users_from_department_form extends moodleform {

    protected function definition() {
        global $USER, $DB, $CFG;
        
        $mform = $this->_form;

        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);
        
        $mform->addElement('html', html_writer::empty_tag('input', array(
            'type' => 'button',
            'value' => 'Delete Users',
            'onclick' => 'window.location.href=\'' . $CFG->wwwroot . '/local/departments/delete_users_from_department.php?departmentid=' . $this->_customdata['id'] . '\''
        )));
  
        $this->add_action_buttons(false, 'Cancel');
    }
}