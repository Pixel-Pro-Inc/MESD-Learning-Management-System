<?php
/**
 * @author Terrence Titus
 * @package    local_email
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/email/classes/forms/compose_email_form.php');
require_once($CFG->dirroot . '/local/email/classes/emailapi.php');
require_login();

$context = context_system::instance();

// Page header
$PAGE->set_url(new moodle_url('/local/email/compose.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Compose email');
$PAGE->set_heading('Compose email');

$mform = new compose_email_form();
$emailapi = new emailapi();

echo $OUTPUT->header();

$mform->display();

// Handle form submission
if ($mform->is_cancelled()) {
    // Go back to manage page
    redirect($CFG->wwwroot . '/local/email/select_course.php', 'You cancelled');

}else if ($data = $mform->get_data()) {
    // Get the selected user IDs
    $selectedUserIds = $data->user_ids;
 
    // Get the subject and message from the form
    $subject = $data->subject;
    $message = $data->message;
 
    // // Get the uploaded files
    // $uploadedFiles = $_FILES['attachment'];
 
    // // Re-arrange the uploaded files array
    // $files = $emailapi->reArrayFiles($uploadedFiles);
 
    // Loop through each selected user ID
    foreach ($selectedUserIds as $userId) {
        // Get the user record
        $user = $DB->get_record('user', ['id' => $userId]);
 
        // // Loop through each uploaded file
        // foreach ($files as $file) {
        //     // Move the uploaded file to a permanent location
        //     $destination = "/path/to/your/directory/" . $file['name'];
        //     move_uploaded_file($file['tmp_name'], $destination);
 
        //     // Add the file path to the attachments array
        //     $attachments[] = $destination;
        // }

        // Send the email
        $emailapi->sendEmailAPI($user->email, $subject, $message, []);//$attachments);
 
        //// Clear the attachments array for the next user
        //$attachments = [];
    }
 
    // Redirect back to the manage page
    redirect($CFG->wwwroot . '/local/email/select_course.php', 'Emails sent successfully');
}
 
echo $OUTPUT->footer();
