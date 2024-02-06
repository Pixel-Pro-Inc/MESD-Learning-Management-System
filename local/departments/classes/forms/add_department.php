<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class add_department extends moodleform {

    function definition() {
        global $CFG, $DB;
        
        $mform = $this->_form; // Don't forget the underscore! 
        
        // Department name field
        $mform->addElement('text', 'department_name', 'Enter department name');
        $mform->setType('department_name', PARAM_TEXT);
        $mform->addRule('department_name', get_string('required'), 'required', null, 'client');

        // Fetch all users from the database
        $users = $DB->get_records('user');

        // Create an array of user IDs and names
        $userOptions = [];
        foreach ($users as $user) {
            $userOptions[$user->id] = fullname($user) . ' - ' . $user->email;
        }

        // Define options for the autocomplete element
        $options = ['multiple' => true];

        // Add the autocomplete element to the form
        $mform->addElement('autocomplete', 'user_ids', 'Assign users', $userOptions, $options);
        $mform->addRule('user_ids', get_string('required'), 'required', null, 'client');
        
        // Add save changes button and cancel button
        $this->add_action_buttons();
    }
}
   
