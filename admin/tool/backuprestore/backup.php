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
 * This script triggers a full purging of system caches,
 * this is useful mostly for developers who did not disable the caching.
 *
 * @package    core
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_admin\form\backup_form;

require_once('../config.php');
require_once($CFG->libdir . '/formslib.php');

$confirm = optional_param('confirm', 0, PARAM_BOOL);
$returnurl = optional_param('returnurl', '/admin/tool/backuprestore/backup.php', PARAM_LOCALURL);
$returnurl = new moodle_url($returnurl);

admin_externalpage_setup('tool_backup_settings');

$form = new backup_form();
if ($form->is_submitted() && $form->is_validated()) {
   backup_database();
   $message = get_string('backupdatabasefinished', 'tool_backup');
}


echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('backupdatabasepage', 'tool_backup'));

echo $OUTPUT->box_start('generalbox', 'notice');
echo $form->display();
// Redirect and/or show notification message confirming backup.
if (isset($message)) {
   \core\notification::add($message, \core\output\notification::NOTIFY_INFO);
}
echo $OUTPUT->box_end();

echo $OUTPUT->footer();
?>
