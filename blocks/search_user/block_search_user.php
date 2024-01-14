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

    
    // public function get_content() {
    //     global $DB, $USER;
       
    //     if ($this->content !== NULL) {
    //     return $this->content;
    //     }
       
    // }

    // function check_visibility() {
    //     // Get the context of the block.
    //     $context = $this->page->context;
     
    //     // Check if the user has the required capability.
    //     if (has_capability('block/view_learners:useviewlearners', $context)) {
    //         // The block is visible.
    //         return true;
    //     } else {
    //         // The block is not visible.
    //         return false;
    //     }
    // }
     
    public function get_content() {
        global $OUTPUT, $USER;
     
        // Check if the search term is set in the URL.
        $searchterm = optional_param('search', '', PARAM_TEXT);
     
        if (!empty($searchterm)) {
            // Search for users.
            $userlist = core_user::get_users(false, array('lastname' => $searchterm));
     
            // Display the search results.
            foreach ($userlist as $user) {
                echo html_writer::link(new moodle_url('/user/view.php', array('id' => $user->id)), fullname($user));
            }
        } else {
            // Display the search bar.
            $form = new stdClass();
            $form->action = new moodle_url('/blocks/searchusers/index.php');
            $form->method = 'get';
        }
    }
}