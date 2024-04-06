<?php
/**
 * @author Terrence Titus
 * @package    local_viewotherlearners
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/viewotherlearners/classes/forms/select_course.php');
require_login();

$context = context_system::instance();
//require_capability('local/sms:composesms', $context);

// Page header
$PAGE->set_url(new moodle_url('/local/viewotherlearners/view_learners.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('View Other Learners');
$PAGE->set_heading('View Other Learners');

$mform = new select_course();

echo $OUTPUT->header();

$mform->display();

// Handle form submission
if ($mform->is_cancelled()) {

    // Go back to manage page
    redirect($CFG->wwwroot . '/my', 'You cancelled');
} else if ($data = $mform->get_data()) {

    // Redirect to compose.php with the selected course ID in the URL
    redirect($CFG->wwwroot . '/local/viewotherlearners/learner_list.php?courseid=' . $data->course_select);
}
 

echo $OUTPUT->footer();