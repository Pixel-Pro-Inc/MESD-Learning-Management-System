<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/lib/outputrenderers.php');
require_login();

$context = context_system::instance();
require_capability('local/departments:viewdetaileddepartment', $context);

$PAGE->set_url(new moodle_url('/local/departments/view_detailed_department.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('View Department');
$PAGE->set_heading('View Department');

// Get the department ID from the URL parameters
$departmentid = optional_param('departmentid', null, PARAM_INT);

// Fetch the department from the database
$department = $DB->get_record('local_department', ['id' => $departmentid], '*', MUST_EXIST);

// Count the number of users in the department
$count = $DB->count_records('local_user_department', ['department_id' => $departmentid]);

// Fetch all users in the department
$users = $DB->get_records_sql("
 SELECT u.*, r.shortname as role
 FROM {user} u
 INNER JOIN {local_user_department} lud ON u.id = lud.user_id
 INNER JOIN {role_assignments} ra ON u.id = ra.userid
 INNER JOIN {context} ctx ON ra.contextid = ctx.id
 INNER JOIN {role} r ON ra.roleid = r.id
 WHERE lud.department_id = ?
 ORDER BY u.firstname ASC, u.lastname ASC", 
 array($departmentid)
);

echo $OUTPUT->header();

//$mform->display();

echo "<div class='department-actions'>";
$deleteurl = new moodle_url('/local/departments/delete_department.php', ['departmentid' => $department->id]);
echo "<a href='{$deleteurl}' class='btn btn-primary' style='margin-right: 10px;'>Delete Department</a>";
echo "</div>";

?>
<style>
body {
 font-family: Arial, sans-serif;
 background-color: #f0f0f0;
 padding: 20px;
}
h1 {
 color: #333;
 text-align: center;
}
p {
 margin: 10px 0;
 text-align: center;
}
.card {
 background-color: #fff;
 box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
 width: auto; /* Make the cards slimmer */
 margin: auto;
 padding: 20px;
 border-radius: 5px;
 margin-bottom: 20px;
 display: flex;
 flex-direction: row;
 justify-content: space-between;
}
.card h2 {
 margin: 0;
 color: #333;
}
.card p {
 margin: 10px 0;
 color: #666;
}
.card strong {
 display: block;
 margin-top: 10px;
}
.bold {
 font-weight: bold;
}
</style>
<?php

// Display the department details
echo "<h1>" . $department->department_name . "</h1>";
echo "<p class='bold'>Number of users: " . $count . "</p>"; /* Bolden the 'number of users' field */

// Display the details of all users in the department
foreach ($users as $user) {
 echo "<div class='card'>";
 echo "<h2>" . fullname($user) . "</h2>";
 echo "<p><strong>Email: </strong>" . (isset($user->email) ? $user->email : "Email not assigned") . "</p>";
 echo "<p><strong>Role: </strong>" . $user->role . "</p>";
 echo "<p><strong>Phone: </strong>" . (isset($user->phone1) ? $user->phone1 : "Phone not assigned") . "</p>";
 echo "</div>";
}

echo $OUTPUT->footer();






