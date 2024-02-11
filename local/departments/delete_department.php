<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/delete_department_button.php');
require_login();

global $DB, $CFG;

$context = context_system::instance();
require_capability('local/departments:deletedepartments', $context);

// Get the department ID from the URL parameters
$departmentid = optional_param('departmentid', null, PARAM_INT);

// Page header
$PAGE->set_url(new moodle_url('/local/departments/delete_department.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Add departments');

$mform = new delete_department_button(null, array('departmentid' => $departmentid)); 

// Handle the delete button click event
if ($data = $mform->get_data()) {
   if (!empty($data->delete)) {
      // Delete the department
      $DB->delete_records('local_department', ['id' => $this->_customdata['departmentid']]);
 
      // Go back to view departments page after deleting the department from DB
      redirect($CFG->wwwroot . '/local/departments/view_departments.php', 'You have successfully deleted the department');
   }
 }

 echo $OUTPUT->header();

$mform->display();

 echo $OUTPUT->footer();
