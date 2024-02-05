<?php
/*
@lomsRef: @
*/

defined('MOODLE_INTERNAL') || die();
include_once($CFG->dirroot . '/course/lib.php');

class lomsPageHandler {
  public function lomsGetPageTitle() {
    global $PAGE, $COURSE, $DB, $CFG;

    $lomsReturn = $PAGE->heading;

    if(
      $DB->record_exists('course', array('id' => $COURSE->id))
      && $COURSE->format == 'site'
      && $PAGE->cm
      && $PAGE->cm->name !== NULL
    ){
      $lomsReturn = $PAGE->cm->name;
    } elseif($PAGE->pagetype == 'blog-index') {
      $lomsReturn = get_string("blog", "blog");
    }

    return $lomsReturn;
  }
}
