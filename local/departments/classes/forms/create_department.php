<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class create_department extends moodleform {

    function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'create_departments_redirect', 'create_departments_redirect');
        $mform->addElement('submit', 'create_departments', 'Create Department'); //Create departments button
    }                           
} 