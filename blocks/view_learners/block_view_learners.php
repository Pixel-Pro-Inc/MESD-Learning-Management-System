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
        global $CFG;
     
        if ($this->content !== NULL) {
            return $this->content;
        }
     
        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';
     
        // Add links to the block content
        $this->content->text .= '<a href="'.$CFG->wwwroot.'/local/viewotherlearners/view_learners.php" class="btn btn-default">View Other Learners</a>';
     
        return $this->content;
    }

    function check_visibility() {
        // Get the context of the block.
        $context = $this->page->context;
     
        // Check if the user has the required capability.
        if (has_capability('block/view_learners:useviewlearners', $context)) {
            // The block is visible.
            return true;
        } else {
            // The block is not visible.
            return false;
        }
    }
}