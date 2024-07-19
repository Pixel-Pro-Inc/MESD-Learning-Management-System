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
 * Course list block.
 *
 * @package    block_course_list_lms
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

include_once($CFG->dirroot . '/course/lib.php');

class block_course_list_lms extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_course_list_lms');
    }

    function has_config() {
        return true;
    }

    function get_content() {
        global $CFG, $DB, $OUTPUT;
    
        if ($this->content !== NULL) {
            return $this->content;
        }
    
        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
    
        $icon = $OUTPUT->pix_icon('i/course', get_string('course'));
    
        // Get all courses from DB
        $courses = get_courses();
    
        if ($courses) {
            foreach ($courses as $course) {
                // Find the custom course field with id 5 for this course
                $customfield = $DB->get_record('customfield_data', array('instanceid' => $course->id, 'fieldid' => 5));
    
                // Convert the custom field value to a string using a switch statement
                $customfieldvalue = $customfield ? $customfield->value : null;
                $level = '';
                if ($customfieldvalue !== null) {
                    switch($customfieldvalue) {
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
                }
    
                // Append the custom field value (level) to the course name if it exists
                $formattedName = $course->fullname;
                if (!empty($level)) {
                    $formattedName .= ' ' . s($level);
                }
    
                $linkcss = $course->visible ? "" : " class=\"dimmed\" ";
    
                $this->content->items[] = "<a $linkcss title=\""
                           . s($course->get_formatted_shortname()) . "\" "
                           . "href=\"$CFG->wwwroot/course/view.php?id=$course->id\">"
                           . $icon . $formattedName . "</a>";
            }
        }
    
        return $this->content;
    }    
    

    function get_remote_courses() {
        global $CFG, $USER, $OUTPUT;

        if (!is_enabled_auth('mnet')) {
            // no need to query anything remote related
            return;
        }

        $icon = $OUTPUT->pix_icon('i/mnethost', get_string('host', 'mnet'));

        // shortcut - the rest is only for logged in users!
        if (!isloggedin() || isguestuser()) {
            return false;
        }

        if ($courses = get_my_remotecourses()) {
            $this->content->items[] = get_string('remotecourses','mnet');
            $this->content->icons[] = '';
            foreach ($courses as $course) {
                $this->content->items[]="<a title=\"" . format_string($course->shortname, true) . "\" ".
                    "href=\"{$CFG->wwwroot}/auth/mnet/jump.php?hostid={$course->hostid}&amp;wantsurl=/course/view.php?id={$course->remoteid}\">"
                    .$icon. format_string(get_course_display_name_for_list($course)) . "</a>";
            }
            // if we listed courses, we are done
            return true;
        }

        if ($hosts = get_my_remotehosts()) {
            $this->content->items[] = get_string('remotehosts', 'mnet');
            $this->content->icons[] = '';
            foreach($USER->mnet_foreign_host_array as $somehost) {
                $this->content->items[] = $somehost['count'].get_string('courseson','mnet').'<a title="'.$somehost['name'].'" href="'.$somehost['url'].'">'.$icon.$somehost['name'].'</a>';
            }
            // if we listed hosts, done
            return true;
        }

        return false;
    }

    /**
     * Returns the role that best describes the course list block.
     *
     * @return string
     */
    public function get_aria_role() {
        return 'navigation';
    }

    /**
     * Return the plugin config settings for external functions.
     *
     * @return stdClass the configs for both the block instance and plugin
     * @since Moodle 3.8
     */
    public function get_config_for_external() {
        global $CFG;

        // Return all settings for all users since it is safe (no private keys, etc..).
        $configs = (object) [
            'adminview' => $CFG->block_course_list_lms_adminview,
            'hideallcourseslink' => $CFG->block_course_list_lms_hideallcourseslink
        ];

        return (object) [
            'instance' => new stdClass(),
            'plugin' => $configs,
        ];
    }
}


