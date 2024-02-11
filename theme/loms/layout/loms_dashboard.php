<?php
defined('MOODLE_INTERNAL') || die();
echo $OUTPUT->doctype();

include($CFG->dirroot . '/theme/loms/inc/loms_themehandler.php');

$bodyattributes = $OUTPUT->body_attributes();
include($CFG->dirroot . '/theme/loms/inc/loms_themehandler_context.php');

echo $OUTPUT->render_from_template('theme_loms/loms_dashboard', $templatecontext);