<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/lib/outputrenderers.php');
require_once($CFG->dirroot.'/local/departments/classes/forms/edit_department_form.php');
require_once($CFG->dirroot.'/local/departments/classes/forms/delete_users_from_department_form.php');
require_login();

$context = context_system::instance();
require_capability('local/departments:editdepartment', $context);

$PAGE->set_url(new moodle_url('/local/departments/edit_department.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Edit Department');
$PAGE->set_heading('Edit Department');
$PAGE->set_pagelayout('standard');

global $DB;

// Get the department ID from the URL parameters
$departmentid = optional_param('departmentid', null, PARAM_INT);

// Start the session
//session_start();

// Store the department id in the session
//$_SESSION['departmentid'] = $departmentid;

// Retrieve the department id from the session
//$departmentid = $_SESSION['departmentid'];

// Fetch the department from the database
$department = $DB->get_record('local_department', ['id' => $departmentid]);

// Create a new instance of edit_department_form, passing the department ID as custom data
$mform = new edit_department_form(null, ['id' => $departmentid]);
$mform2 = new delete_users_from_department_form(null, ['id' => $departmentid]);

// Handle form submission
if ($mform->is_cancelled()) {

  // Go back to manage page
  redirect($CFG->wwwroot . '/local/departments/view_departments.php', 'You cancelled editing the department');

} else if ($data = $mform->get_data()) {

  $departmentid = $data->id; // Get the department ID from the form data
  $DB->update_record('local_department', ['id' => $data->id, 'department_name' => $data->department_name]);
  
  // Add users to department
  $userids = $data->user_id_not_in_department;
  if (!empty($userids)) {
      foreach ($userids as $userid) {
          $linkData = new stdClass();
          $linkData->department_id = $departmentid;
          $linkData->user_id = $userid;
          $DB->insert_record('local_user_department', $linkData);
      }
  }
  
  //Remove users from department  
  $userids2 = $data->user_id_in_department;
  if (!empty($userids2)) {
    foreach ($userids2 as $userid2) {
        $DB->delete_records('local_user_department', ['user_id' => $userid2, 'department_id' => $departmentid]);
    }
  }

  redirect($CFG->wwwroot . '/local/departments/view_departments.php', 'You have successfully edited your department');
}

echo $OUTPUT->header();

$mform->set_data($department);
$mform->display();
//$mform2->display();

echo $OUTPUT->footer();