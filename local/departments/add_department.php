<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/add_department.php');
require_login();

global $DB;

$context = context_system::instance();
require_capability('local/departments:adddepartments', $context);

// Page header
$PAGE->set_url(new moodle_url('/local/departments/add_department.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Add deparments');
$PAGE->set_heading('Create Department');

$mform = new add_department();

// Form processing and displaying is done here.
if ($mform->is_cancelled()) {

    // Go back to manage page
    redirect($CFG->wwwroot . '/local/departments/department_manager.php', 'You cancelled creating a department');

} else if($fromform = $mform->get_data()) {
    // Prepare the department data
    $departmentData = new stdClass();
    $departmentData->department_name = $fromform->department_name;
 
    // Insert the department data
    $departmentId = $DB->insert_record('local_department', $departmentData);
 
    // Get the user ids from the form data
    $userIds = $fromform->user_ids;
 
    // Loop through the user ids and insert them into the local_user_department table
    foreach ($userIds as $userId) {
        $linkData = new stdClass();
        $linkData->user_id = $userId;
        $linkData->department_id = $departmentId;
        $DB->insert_record('local_user_department', $linkData);
    }

    // Go back to manage page after adding to DB
    redirect($CFG->wwwroot . '/local/departments/department_manager.php', 'You have successfully created a department');
}
   
echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();



