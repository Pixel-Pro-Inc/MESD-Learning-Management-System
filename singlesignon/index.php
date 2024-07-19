<?php
defined('MOODLE_INTERNAL') || die();
//SSO Login
require_once($CFG->dirroot . '/local/autologin/classes/autologin.php');

// Instantiate the local_autologin class.
$autologin = new local_autologin();

// Call the attempt_autologin method.
$value = $autologin->attempt_autologin();

echo('This is the result'. $value);

//SSO Login