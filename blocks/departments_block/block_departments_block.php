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
 * Defines the block_quickfindlist class
 *
 * @package    block_departments_block
 * @author     Terrence Titus
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *  Class definition for the Quick Find List block.
 */
class block_departments_block extends block_base 
{
    public function init() {
        $this->blockname = 'Department Navigation';
        $this->title = 'Department Navigation';
    }


    public function preferred_width() {
        // The preferred value is in pixels
        return 180;
    }

    /**
     *  Generates the block's content
     *
     *  Determines the role configured for this instance, and ensures it doesn't conflict with other
     *  instances on the page.
     *  Then displays a form for searching the users who have that role, and if required, the
     *  results from the submitted search.
     */
    public function get_content() {
        global $CFG;
     
        if ($this->content !== NULL) {
            return $this->content;
        }
     
        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';
     
        // Add links to the block content
        $this->content->text .= '<a href="'.$CFG->wwwroot.'/local/departments/department_manager.php" class="btn btn-default">Department Manager</a>';
        $this->content->text .= '<a href="'.$CFG->wwwroot.'/local/departments/view_departments.php" class="btn btn-default">View Departments</a>';
     
        return $this->content;
     }
     

}