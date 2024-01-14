<?php
// This file is part of Moodle - https://moodle.org/
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
 * Adds admin settings for the plugin.
 *
 * @package     tool_backuprestore
 * @category    admin
 * @copyright   2020 Your Name <email@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('courses', new admin_category('tool_backuprestore', 
    new lang_string('Backup & Restore Database', 'tool_backuprestore')));
#region Backup page

    $backuppage= new admin_externalpage('tool_backup_settings', new lang_string('Backup site', 'tool_backup'),
    "$CFG->wwwroot/$CFG->admin/tool/backuprestore/backup.php");
    
     //Addes the page to view in the proper category
     $ADMIN->add('tool_backuprestore', $backuppage);
     
#endregion
#region Restore page
     $restorepage = new admin_settingpage('tool_restore_settings', 
     new lang_string('Restore site', 'tool_restore'));   

     //Add a filepicker that requires only an sql file to the restorepage

     //Addes the page to view in the proper category
     $ADMIN->add('tool_backuprestore', $restorepage);
#endregion 

}