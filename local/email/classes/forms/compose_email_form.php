<?php
/**
 * @author     Terrence Titus
 * @package    local_email
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");


class compose_email_form extends moodleform {

    function definition() {
        global $CFG, $DB;

        $mform = $this->_form; // Don't forget the underscore! 

        // Get the course ID from the URL
        $courseId = optional_param('courseid', null, PARAM_INT);

        // For ensuring that the course id is passed to the submitted form
        $mform->addElement('hidden', 'courseid', $_GET['courseid']);

        // Get the user ids of the enrolled users
        $sql = "SELECT ue.userid
            FROM {user_enrolments} ue
            WHERE ue.enrolid IN (SELECT e.id FROM {enrol} e WHERE e.courseid = :courseid)";
        $params = ['courseid' => $courseId];
        $userRecords = $DB->get_records_sql($sql, $params);

        // Extract the user ids into a separate array
        $userIds = array_map(function($record) {
        return $record->userid;
        }, $userRecords);

        // Get the user records
        $users = $DB->get_records_sql("SELECT * FROM {user} WHERE id IN (" . implode(',', $userIds) . ")");

        // Create an array of user IDs and names
        $userOptions = [];
        foreach ($users as $user) {
        $userOptions[$user->id] = fullname($user) . ' - ' . $user->email;
        }

        // Define options for the autocomplete element
        $options = ['multiple' => true];

        // Add the autocomplete element to the form
        $mform->addElement('autocomplete', 'user_ids', 'Select recipients', $userOptions, $options);
        $mform->addRule('user_ids', get_string('required'), 'required', null, 'client');

        // Message subject field
        $mform->addElement('text', 'subject', 'Enter subject');
        $mform->addRule('subject', 'required', 'required', null, 'client');

        // Text message field
        $mform->addElement('textarea', 'message', "Enter message", 'wrap="virtual" rows="5" cols="10"');
        $mform->addRule('message', 'required', 'required', null, 'client');

        // Set the maximum file size to 200MB
        $maxbytes = 200 * 1024 * 1024; // 200MB

        // Set the total area size to 500MB
        $areamaxbytes = 500 * 1024 * 1024; // 500MB

        // File picker field
        $mform->addElement('filepicker', 'attachment', 'Attach file', null, array('maxbytes' => $maxbytes, 'areamaxbytes' => $areamaxbytes));
        $mform->addHelpButton('attachment', 'attachment', 'mod_forum');

        // Add save changes button and cancel button
        $this->add_action_buttons(true, 'Send email');
    }
}