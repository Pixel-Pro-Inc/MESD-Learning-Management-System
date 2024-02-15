<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/departments/classes/forms/add_department.php');
require(__DIR__ . '/classes/lib.php');
require_once($CFG->dirroot.'/lib/outputrenderers.php');
require_login();

$context = context_system::instance();
require_capability('local/departments:viewdepartments', $context);

$PAGE->set_url(new moodle_url('/local/departments/view_departments.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('View Departments');
$PAGE->set_heading('View Departments');
$PAGE->set_pagelayout('standard');

global $DB;

echo $OUTPUT->header();

echo "<style>
.department-item {
 border: 1px solid #ccc;
 padding: 10px;
 margin-bottom: 10px;
}
</style>";

// Fetch all departments from the database
$departments = $DB->get_records('local_department');

// Check if there are any departments
if (!empty($departments)) {
 
 echo "<div class='department-list'>";
 foreach ($departments as $department) {
 echo "<div class='department-item'>";
 echo "<h4>" . $department->department_name . "</h4>";
 
 // Fetch the number of users in the department
 $count = lib::get_number_of_users_in_department($department->id);
 echo "<p>Users: " . $count . "</p>";
 
 // Buttons
 echo "<div class='department-actions'>";
 $editurl = new moodle_url('/local/departments/edit_department.php', ['departmentid' => $department->id]);
 echo "<a href='{$editurl}' class='btn btn-primary' style='margin-right: 10px;'>Edit</a>";

 $viewurl = new moodle_url('/local/departments/view_detailed_department.php', ['departmentid' => $department->id]);
 echo "<a href='{$viewurl}' class='btn btn-primary'>View</a>";

 echo "</div>";
 echo "</div>";
 }
 echo "</div>";

} else {
 echo "<p>No departments found.</p>";
}

echo $OUTPUT->footer();
