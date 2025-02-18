<?php
defined('MOODLE_INTERNAL') || die();

include($CFG->dirroot . '/theme/loms/inc/loms_themehandler.php');

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

array_push($extraclasses, "loms_context_frontend");
$bodyclasses = implode(" ",$extraclasses);
$bodyattributes = $OUTPUT->body_attributes($bodyclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;

include($CFG->dirroot . '/theme/loms/inc/loms_themehandler_context.php');

echo $OUTPUT->render_from_template('theme_loms/loms_my', $templatecontext);