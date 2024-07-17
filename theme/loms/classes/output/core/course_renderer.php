<?php

namespace theme_loms\output\core;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/renderer.php');

class course_renderer extends \core_course_renderer {

    public function render_course_card($course) {
        global $DB;
        $coursecontext = \context_course::instance($course->id);
        
        // Fetch the custom field value
        $customfield = $DB->get_field('customfield_data', 'value', [
            'fieldid' => 5,
            'instanceid' => $course->id
        ]);
        
        // Add the custom field value to the course object
        $course->customfield = $customfield;

        return $this->render_from_template('core_course/coursecard', $course);
    }
}
