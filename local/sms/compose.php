<?php
/**
 * @author Terrence Titus
 * @package    local_sms
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/sms/classes/forms/compose_message_form.php');
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/local/sms/classes/smsapi.php');
require_login();

$context = context_system::instance();

// Page header
$PAGE->set_url(new moodle_url('/local/sms/compose.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Compose message');
$PAGE->set_heading('Compose message');

$mform = new compose_message_form();
$smsapi = new smsapi();

echo $OUTPUT->header();

$mform->display();

// Handle form submission
if ($mform->is_cancelled()) {
    // Go back to manage page
    redirect($CFG->wwwroot . '/local/sms/select_course.php', 'You cancelled');

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
        
        profile_load_data($user);
        
        // Get the user's phone number
        $phoneNumber = $user->profile_field_phonenumber; // Assuming the phone number is stored in the 'phone1' field
        //$phoneNumber = $user->phone1;
        // Check if phone number > 8 digit
        // If phone number doesnt have a country code add 267, assuming its a botswana number
        // Check if it has a + , if true, remove the +
        // Remove all spaces

        // Send the SMS
        $smsapi->sendSMS($phoneNumber, $subject, $message);
    }
    redirect($CFG->wwwroot . '/local/sms/select_course.php', 'Message sent');
}
 
 
echo $OUTPUT->footer();
