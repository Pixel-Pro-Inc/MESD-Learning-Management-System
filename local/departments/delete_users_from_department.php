<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require(__DIR__ . '/../../config.php');
require_login();

// $context = context_system::instance();
// require_capability('local/departments:viewdepartmentmanager', $context);

// Page header
$PAGE->set_url(new moodle_url('/local/departments/delete_users_from_department.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Remove users');
$PAGE->set_heading('Remove users');

global $DB;
// Get the department ID from the URL parameters
$departmentid = optional_param('departmentid', null, PARAM_INT);
$users = $DB->get_records('local_user_department', ['department_id' => $departmentid]);


echo $OUTPUT->header();

foreach ($users as $user) {
    // Fetch user details
    $userdetails = $DB->get_record('user', ['id' => $user->userid]);
    $username = $userdetails->firstname . ' ' . $userdetails->lastname;
 
    echo "<p>" . $username . "</p>";
    echo '<form method="post" action="/local/yourplugin/remove_user.php" onsubmit="return confirm(\'Are you sure you want to remove this user?\')">';
    echo '<input type="hidden" name="userid" value="' . $user->userid . '">';
    echo '<input type="submit" value="Remove from Department">';
    echo '</form>';
 }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = required_param('userid', PARAM_INT);
    $DB->delete_records('local_user_department', ['userid' => $userid]);
}
 

echo $OUTPUT->footer();