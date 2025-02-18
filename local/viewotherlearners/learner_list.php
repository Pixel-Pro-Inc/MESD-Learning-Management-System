<?php
/**
 * @author Terrence Titus
 * @package    local_viewotherlearners
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_login();

$context = context_system::instance();

// Page header
$PAGE->set_url(new moodle_url('/local/viewotherlearners/learner_list.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Learners');
$PAGE->set_heading('Learners');

$courseId = optional_param('courseid', 0, PARAM_INT);

echo $OUTPUT->header();

if (!empty($courseId)) {
    $course = get_course($courseId);
    
    if ($course) {
        $context = context_course::instance($course->id);

        // Get only learners (students) enrolled in the course
        $enrolled_users = get_enrolled_users($context, 'local/viewotherlearners:student', 0, 'u.id, u.firstname, u.lastname, u.email');
        
        if (!empty($enrolled_users)) {
            echo '<h2>Enrolled Learners in ' . $course->fullname . '</h2>';
            echo '<ul>';
            foreach ($enrolled_users as $user) {
              $userprofilelink = $CFG->wwwroot . '/user/profile.php?id=' . $user_id;
                echo '<li>' . '<a href="' . $userprofilelink . '">' . fullname($user) . '<a>' . ' - ' . $user->email . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No learners enrolled in this course.</p>';
        }
    } else {
        echo '<p>Course not found.</p>';
    }
} else {
    echo '<p>Course ID not provided.</p>';
}

echo $OUTPUT->footer();