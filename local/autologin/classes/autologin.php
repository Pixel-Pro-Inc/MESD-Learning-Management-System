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
                    //Sync User                    
                    //Get System Admin Token
                    $token = self::getSystemAdminToken();

                    if($token !== 'error occured'){
                        //Lookup user by username
                        $iamUser = self::getUser($user->profile_field_nin, $token);

                        //Update First/Last name and phonenumber, email if not null
                        $user->firstname = $iamUser->firstname;
                        $user->lastname = $iamUser->lastname;
                        if($iamUser->email !== null){
                            $user->email = $iamUser->email;
                        }

                        $DB->update_record('user', $user);

                        //profile field
                        //Set Profile field for one gov access key
                        $user->profile_field_phonenumber = $iamUser->phone_number;
                        //Figure it out after meeting with Dan
                        $user->profile_field_onegovid = ;//$iamUser->phone_number;

                        profile_save_data($user);                   
                    }                    

                    // Log in the user.
                    complete_user_login($user);
                    redirect($CFG->wwwroot);
                }
            }
        }
    }

    public static function getSystemAdminToken() {
        global $CFG;

        $data = array(
            'username' => $CFG->iamSystemAdminUsername, 
            'password' => $CFG->iamSystemAdminPassword
        );
    
        $json_data = json_encode($data);
    
        // Initialize a cURL session
        $ch = curl_init();
    
        $requestDomain = $CFG->iamApiDomain;
    
        $requestUrl = $requestDomain . 'auth/login';
    
        // Set the URL, headers, and POST data as JSON
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        // Ensure cURL returns the response instead of printing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute the request and capture the response
        $response = curl_exec($ch);
    
        $result = 'error occured';
    
        // Close the cURL session
        curl_close($ch);
    
        // Parse the JSON response
        $data = json_decode($response, true);
    
        // Check if the JSON decoding was successful
        if ($data !== null) {
            // Access the meetingLink property
            $result = $data['access_token'];
        }
    
        return $result;
    }

    public static function getUser($idnumber, $token){
        global $CFG;
        // API endpoint
        $requestDomain = $CFG->iamApiDomain;
    
        $requestUrl = $requestDomain . 'users/?username=' . $idnumber;

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ));

        // Execute cURL request
        $response = curl_exec($ch);

        $result = null;
    
        // Close the cURL session
        curl_close($ch);
    
        // Parse the JSON response
        $data = json_decode($response, true);
    
        // Check if the JSON decoding was successful
        if ($data !== null) {
            // Access the meetingLink property
            $result = $data;
        }
    
        return $result;
    }
}