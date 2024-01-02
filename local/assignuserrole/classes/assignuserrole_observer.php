<?php

namespace local_assignuserrole;

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
    require_once($CFG->dirroot.'/user/profile/lib.php');

    profile_load_data($user);

    $roleid = 1;

    $logMessage = print_r($user, true);

    // Log the string to the error log
    error_log($logMessage);

    $userid = $user->id;

    // Get the user context
    $usercontext = \context_user::instance($userid);

    //$context = get_context_instance(CONTEXT_USER);

    // Assign the role
    role_assign($roleid, $userid, $usercontext->id);
  }
}