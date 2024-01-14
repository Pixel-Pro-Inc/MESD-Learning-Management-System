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
 * Defines the block_send_message class
 *
 * @package    block_send_message
 * @author     Terrence Titus
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *  Class definition for the Send message block.
 */
class block_send_message extends block_base 
{
    public function init() {
        $this->blockname = 'Send Messages';
        $this->title = 'Send Messages';
    }


    public function preferred_width() {
        // The preferred value is in pixels
        return 180;
    }

    /**
     *  Generates the block's content
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
        $this->content->text .= '<a href="'.$CFG->wwwroot.'/local/email/select_course.php" class="btn btn-default">Send Email</a>';
        $this->content->text .= '<a href="'.$CFG->wwwroot.'/local/sms/select_course.php" class="btn btn-default">Send SMS</a>';
     
        return $this->content;
    }
    
    

}