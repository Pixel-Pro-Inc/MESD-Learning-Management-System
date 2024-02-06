<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/user/profile/lib.php');

class local_autologin {

    public static function obfuscate($idnumber) {
        global $CFG;

        $hashed = hash_hmac('sha256', $idnumber, $CFG->shaSecret, true);
        $base64 = base64_encode($hashed);
        return $base64;
    }

    public static function attempt_autologin() {
        global $CFG, $DB;

        // Check if the request contains the obfuscated ID parameter.
        $obfuscatedIdnumber = optional_param('nin', '', PARAM_TEXT);

        if (!empty($obfuscatedIdnumber)) {
            // Loop through all users and attempt to find a match.
            $users = $DB->get_records('user');

            foreach ($users as $user) {
                // Obfuscate the user's ID for comparison.
                profile_load_data($user);
                
                $obfuscatedUserid = self::obfuscate($user->profile_field_nin);

                if ($obfuscatedUserid === $obfuscatedIdnumber) {
                    // Log in the user.
                    complete_user_login($user);
                    redirect($CFG->wwwroot);
                }
            }
        }
    }
}