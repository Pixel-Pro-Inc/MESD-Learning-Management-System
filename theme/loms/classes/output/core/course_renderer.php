<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Custom course renderer for the loms theme.
 *
 * @package    theme_loms
 * @copyright  2023 EnvyTheme
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_loms\output\core;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/renderer.php');

class course_renderer extends \core_course_renderer {

    public function render_course_card($course) {
        global $DB;
        $coursecontext = \context_course::instance($course->id);

        error_log('This is the course before the custom field');
        error_log(print_r($course, true));
        
        // Replace 5 with your actual custom field ID
        $customfield = $DB->get_field('customfield_data', 'value', [
            'fieldid' => 5,
            'instanceid' => $course->id
        ]);

        error_log('This is the custom field');
        error_log(print_r($customfield, true));
        
        // Add the custom field value to the course object
        $course->customfield = $customfield;

        error_log('This is the course after the custom field');
        error_log(print_r($course, true));

        return $this->render_from_template('core_course/coursecard', $course);
    }
}
