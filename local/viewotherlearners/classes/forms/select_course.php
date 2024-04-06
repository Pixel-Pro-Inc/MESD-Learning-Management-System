<?php
/**
 * @author     Terrence Titus
 * @package    local_viewotherlearners
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class select_course extends moodleform {

    function definition() {
        global $DB;
        
        $mform = $this->_form; // Don't forget the underscore! 
        
        global $USER, $DB;

        // Get all courses that the user is enrolled in
        $courses = enrol_get_users_courses($USER->id);

        // Create an array of options for the select element
        $options = array('multiple' => false);
        foreach ($courses as $course) {
        $options[$course->id] = format_string($course->fullname);
        }

        // Add the select element to the form
        $mform->addElement('select', 'course_select', 'Select course', $options);
        
        // Add save changes button and cancel button
        $this->add_action_buttons(false, "View Learners");
    }
}