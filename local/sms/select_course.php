<?php
/**
 * @author Terrence Titus
 * @package    local_sms
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/sms/classes/forms/select_course.php');
require_login();

$context = context_system::instance();

// Page header
$PAGE->set_url(new moodle_url('/local/sms/select_course.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Select course');
$PAGE->set_heading('Select course for sms');

$mform = new select_course();

echo $OUTPUT->header();

$mform->display();

// Handle form submission
if ($mform->is_cancelled()) {

    // Go back to manage page
    redirect($CFG->wwwroot . '/my', 'You cancelled');
} else if ($data = $mform->get_data()) {

    // Redirect to compose.php with the selected course ID in the URL
    redirect($CFG->wwwroot . '/local/sms/compose.php?courseid=' . $data->course_select);
}
 

echo $OUTPUT->footer();