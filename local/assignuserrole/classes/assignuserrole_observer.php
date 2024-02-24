<?php

namespace local_assignuserrole;

require_once($CFG->dirroot.'/user/profile/lib.php');

class assignuserrole_observer {
  public static function usercreated(\core\event\user_created $event) {
    // Get the user information from the event
    $user = $event->get_record_snapshot('user', $event->objectid);

    self::assignrole($user);
  }

  public static function userupdated(\core\event\user_updated $event) {
    // Get the user information from the event
    $user = $event->get_record_snapshot('user', $event->objectid);

    self::assignrole($user);
  }

  public static function assignrole($user){
    // Convert the object to a string representation
    profile_load_data($user);

    $roleid = 5;

    switch($user->profile_field_userrole){
      case 'MESD Executive':
        $roleid = 9;
        break;
      case 'Director':
        $roleid = 10;
        break;
      case 'Super Administrator':
        $roleid = 11;
        break;
      case 'Administrator':
        $roleid = 12;
        break;
      case 'School Head':
        $roleid = 13;
        break;
      case 'Head of Department':
        $roleid = 14;
        break;
      case 'Senior Educator':
        $roleid = 3;
        break;
      case 'Educator':
        $roleid = 4;
        break;
      case 'Learner':
        $roleid = 5;
        break;
      case 'Parent':
        $roleid = 15;
        break;
      default:
        return;
    }
    
    $userid = $user->id;

    // Get the system context
    $systemcontext = \context_system::instance();

    // Assign the role
    role_assign($roleid, $userid, $systemcontext->id);
  }
}