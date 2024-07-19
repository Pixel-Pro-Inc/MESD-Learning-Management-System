<?php
require_once('config.php');
require_login();

$courseid = required_param('courseid', PARAM_INT);
$customfieldid = 5;

$customfieldvalue = $DB->get_field('customfield_data', 'value', ['fieldid' => $customfieldid, 'instanceid' => $courseid]);

if ($customfieldvalue !== false) {
    $level;

    switch($customfieldvalue){
        case 1:
            $level = 'Standard 1';
        break;
        case 2:
            $level = 'Standard 2';
        break;
        case 3:
            $level = 'Standard 3';
        break;
        case 4:
            $level = 'Standard 4';
        break;
        case 5:
            $level = 'Standard 5';
        break;
        case 6:
            $level = 'Standard 6';
        break;
        case 7:
            $level = 'Standard 7';
        break;
        case 8:
            $level = 'Form 1';
        break;
        case 9:
            $level = 'Form 2';
        break;
        case 10:
            $level = 'Form 3';
        break;
        case 11:
            $level = 'Form 4';
        break;
        case 12:
            $level = 'Form 5';
        break;
        case 13:
            $level = 'Level 100';
        break;
        case 14:
            $level = 'Level 200';
        break;
        case 15:
            $level = 'Level 300';
        break;
        case 16:
            $level = 'Level 400';
        break;
        case 17:
            $level = 'Level 500';
        break;
    }
    echo json_encode(['value' => $level]);
} else {
    echo json_encode(['value' => 'COURSE LEVEL']); // Fallback value
}