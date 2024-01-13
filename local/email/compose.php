<?php
/**
 * @author Terrence Titus
 * @package    local_email
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/email/classes/forms/compose_email_form.php');
require_once($CFG->dirroot . '/local/email/classes/emailapi_observer.php');
require_login();

$context = context_system::instance();
require_capability('local/email:composeemail', $context);

// Page header
$PAGE->set_url(new moodle_url('/local/email/compose.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Compose email');
$PAGE->set_heading('Compose email');

$mform = new compose_email_form();
$emailapi = new emailapi_observer();

echo $OUTPUT->header();

$mform->display();

// Handle form submission
if ($mform->is_cancelled()) {
    // Go back to manage page
    redirect($CFG->wwwroot . '/local/email/select_course.php', 'You cancelled');

 } else if ($data = $mform->get_data()) {
    // Get the selected user IDs
    $userIds = $data->user_ids;
 
    // Get the subject and message
    $subject = $data->subject;
    $message = $data->message;
 
    // Loop through each user ID
    foreach ($userIds as $userId) {
        // Get the user record
        $user = $DB->get_record('user', ['id' => $userId]);
 
        // Get the user's phone number
        $phoneNumber = $user->phone1; // Assuming the phone number is stored in the 'phone1' field
 
        // Send the SMS
        $smsapi->sendSMS($phoneNumber, $subject, $message);
    }
    redirect($CFG->wwwroot . '/local/sms/select_course.php', 'Message sent');
}
 
 
echo $OUTPUT->footer();
