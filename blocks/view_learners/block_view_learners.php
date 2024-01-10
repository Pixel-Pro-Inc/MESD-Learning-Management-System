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
 * Defines the block_view_learners class
 *
 * @package    block_view_learners
 * @author     Terrence Titus
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *  Class definition for the Quick Find List block.
 */

class block_view_learners extends block_base 
{
    public function init() {
        $this->blockname = 'View Learners';
        $this->title = 'View other learners ';
    }

    public function preferred_width() {
        // The preferred value is in pixels
        return 360;
    }

    public function has_config() {
        return true;
    }

    
    public function get_content() {
        global $DB, $USER;
       
        if ($this->content !== NULL) {
        return $this->content;
        }
       
        // Fetch the enrolment instance IDs that the user is enrolled in.
        $sql = "SELECT DISTINCT ue.enrolid FROM {user_enrolments} ue 
            JOIN {enrol} e ON e.id = ue.enrolid 
            WHERE ue.userid = :userid AND e.status = :status";
        $params = ['userid' => $USER->id, 'status' => ENROL_INSTANCE_ENABLED];
        $enrolmentInstanceIds = $DB->get_fieldset_sql($sql, $params);
       
        // Fetch all courses that the user is enrolled in.
        $courseIds = [];
        foreach ($enrolmentInstanceIds as $enrolmentInstanceId) {
        $courseIds[] = $DB->get_field('enrol', 'courseid', ['id' => $enrolmentInstanceId]);
        }
       
        // Fetch all courses under each course category.
        $courses = [];
        foreach ($courseIds as $courseId) {
        $courses[] = $DB->get_record('course', ['id' => $courseId]);
        }
       
        // Generate the HTML to display the courses.
        $courseList = '';
        foreach ($courses as $course) {
        // Fetch the students for the course.
        $context = context_course::instance($course->id);
        $students = get_enrolled_users($context, '', 0, 'u.*', null, null, null, null, false);
       
        // Generate the HTML for the course and its students.
        $courseList .= '<label>' . $course->fullname . '</label>';
        $courseList .= '<select class="course-dropdown" data-courseid="'.$course->id.'">';
        $courseList .= '<option value="">View Learners</option>';
        foreach ($students as $student) {
        $courseList .= '<option value="'.$student->id.'">'.$student->firstname.' '.$student->lastname.'</option>';
        }
        $courseList .= '</select>';
        }
       
        $this->content = new stdClass;
        $this->content->text = $courseList;
       
        return $this->content;
       }
       
       
       

}