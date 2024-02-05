<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class view_departments_button extends moodleform {

    function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'view_departments_redirect', 'view_departments_redirect');
        $mform->addElement('submit', 'view_department','View Departments'); //View departments button
    }                           
} 