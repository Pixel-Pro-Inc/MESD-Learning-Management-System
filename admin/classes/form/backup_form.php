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
 * Form for selective purging of caches.
 *
 * @package    core
 * @copyright  2018 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_admin\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Form for selecting which caches to purge on admin/purgecaches.php
 *
 * @package   core
 * @copyright 2018 The Open University
 * @author    Mark Johnson <mark.johnson@open.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_form extends \moodleform {
    protected function definition() {
        $mform = $this->_form;
        $mform->addElement('static', 'info', '', get_string('backupdatabaseconfirm', 'tool_backup'));
        $mform->addElement('submit', 'submitbutton', get_string('backupdatabase', 'tool_backup'));
    }
   
    // public function validation($data, $files) {
    //     $errors = [];
    //     if (isset($data['purgeselectedcaches']) && empty(array_filter($data['purgeselectedoptions']))) {
    //         $errors['purgeselectedoptions'] = get_string('purgecachesnoneselected', 'admin');
    //     }
    //     return $errors;
    // }
}
