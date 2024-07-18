<?php
require_once('config.php');
require_login();

$courseid = required_param('courseid', PARAM_INT);
$customfieldid = 5;

$customfieldvalue = $DB->get_field('customfield_data', 'value', ['fieldid' => $customfieldid, 'instanceid' => $courseid]);

if ($customfieldvalue !== false) {
    echo json_encode(['value' => $customfieldvalue]);
} else {
    echo json_encode(['value' => 'COURSE LEVEL']); // Fallback value
}