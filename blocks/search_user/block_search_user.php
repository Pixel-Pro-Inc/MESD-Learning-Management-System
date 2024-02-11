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
 * Defines the block_search class
 *
 * @package    block_search_user
 * @author     Terrence Titus
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *  Class definition for the Quick Find List block.
 */

 require_once(__DIR__ . '/search_form.php');
require_once("$CFG->libdir/formslib.php");

class block_search_user extends block_base 
{
    public function init() {
        $this->blockname = 'Search Users';
        $this->title = 'Search Users';
    }

    public function preferred_width() {
        // The preferred value is in pixels
        return 360;
    }

    public function has_config() {
        return true;
    }

    function check_visibility() {
        // Get the context of the block.
        $context = $this->page->context;
     
        // Check if the user has the required capability.
        if (has_capability('block/search_user:usesearchuser', $context)) {
            // The block is visible.
            return true;
        } else {
            // The block is not visible.
            return false;
        }
    }
     
    public function get_content() {

        if ($this->content !== null) {
            return $this->content;
        }
        
        $mform = new search_form();
        if ($mform->is_submitted()) {
            $data = $mform->get_data();
            $userid = $data->search_user;
            if ($userid) {
                redirect(new moodle_url('/user/view.php', array('id' => $userid)));
            }
        } else {
            ob_start();
            $mform->display();
            $formhtml = ob_get_clean();
        }
     
        $this->content = new stdClass;
        $this->content->text = $formhtml;
     
        return $this->content;
     }
     
     
}