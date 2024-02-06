<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/create_department.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/view_departments_button.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/add_department.php');
require_login();

$context = context_system::instance();
require_capability('local/departments:viewdepartmentmanager', $context);

// Page header
$PAGE->set_url(new moodle_url('/local/departments/department_manager.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Deparments');
$PAGE->set_heading('Department Manager');
 
$mform = new create_department();
$mform_view_departments_button = new view_departments_button();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_departments_redirect'])) {
    // Redirect to the page where you can create a department
    $composeUrl = new moodle_url('/local/departments/add_department.php');
    redirect($composeUrl);
    }else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_departments_redirect'])) {
    // Redirect to the page where you can view departments
    $composeUrl = new moodle_url('/local/departments/view_departments.php');
    redirect($composeUrl);
}
  
echo $OUTPUT->header();

$mform->display();
$mform_view_departments_button->display();

echo $OUTPUT->footer();
