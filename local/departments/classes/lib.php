<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

//require(__DIR__ . '/../../config.php');

class lib
{
  public static function get_number_of_users_in_department($departmentId) {
      global $DB;

      // Count the number of users in the department
      $count = $DB->count_records('local_user_department', array('department_id' => $departmentId));

      return $count;
  }

  public static function get_department_name($departmentId) {
      global $DB;

      // Get the department name
      $department = $DB->get_record('local_department', array('id' => $departmentId));

      if ($department) {
          return $department->department_name;
      } else {
          return false;
      }
  }

  function local_departments_extend_settings_navigation($settingsnav, $context) {
    global $CFG, $PAGE;
 
    // Only let users with the appropriate capability see this settings item.
    if (!has_capability('local/departments:viewdepartmentmanager', context_system::instance())) {
        return;
    }
 
    if ($settingnode = $settingsnav->find('courseadmin', navigation_node::TYPE_COURSE)) {
        $strdepartmentmanager = get_string('departmentmanager', 'local_departments');
        $url = new moodle_url('/local/departments/department_manager.php');
        $departmentmanagernode = navigation_node::create(
            $strdepartmentmanager,
            $url,
            navigation_node::NODETYPE_LEAF,
            'departmentmanager',
            'departmentmanager',
            new pix_icon('t/addcontact', $strdepartmentmanager)
        );
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $departmentmanagernode->make_active();
        }
        $settingnode->add_node($departmentmanagernode);
    }
 }
 
}


