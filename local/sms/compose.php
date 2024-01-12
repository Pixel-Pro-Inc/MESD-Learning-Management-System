<?php
/**
 * @author Terrence Titus
 * @package    local_sms
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

// Page header
$PAGE->set_url(new moodle_url('/local/sms/compose.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Compose message');
$PAGE->set_heading('Compose message');

echo $OUTPUT->header();



echo $OUTPUT->footer();
