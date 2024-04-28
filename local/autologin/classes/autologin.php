<?php

use tool_brickfield\local\tool\errors;

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

        $_token = optional_param('token', '', PARAM_TEXT);

        $isSuperAdministrator = self::isSuperAdmin($_token);

        if($isSuperAdministrator){
            $users = $DB->get_records('user');

            foreach ($users as $user) {
                if($user->id == 2){
                    // Log in the user.
                    complete_user_login($user);
                    redirect($CFG->wwwroot);
                    return;
                }
            }
        }

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
                        $eidUser = self::getEidUser($user->profile_field_nin);

                        //Update First/Last name and phonenumber, email if not null
                        $user->firstname = $iamUser['firstname'];
                        $user->lastname = $iamUser['lastname'];
                        if($iamUser['email'] !== null){
                            $user->email = $iamUser['email'];
                        }

                        if($eidUser !== null){
                            $user->city = self::transformName($eidUser['APPLICATION_PLACE_NME']);
                        }

                        $DB->update_record('user', $user);

                        //profile field
                        $user->profile_field_phonenumber = $iamUser['phone_number'];

                        if($eidUser !== null){
                            //Convert to unix time
                            $birthDate = $eidUser['BIRTH_DTE'];

                            $unixTime = strtotime($birthDate);

                            $user->profile_field_dateofbirth = $unixTime;
                        }
                        
                        //Set Profile field for one gov access key
                        $user->profile_field_onegovid = $iamUser['id'];

                        profile_save_data($user);                   
                    }                    

                    // Log in the user.
                    complete_user_login($user);
                    redirect($CFG->wwwroot);
                }
            }
        }
    }

    public static function isSuperAdmin($token){
        global $CFG;
        // API endpoint
        $requestDomain = $CFG->iamApiDomain;

        $requestUrl = $requestDomain . 'auth/validate-token?token=' . $token;

        $postData = array();

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Check if request was successful
        if ($response === false) {
            error_log('Error: ' . curl_error($ch));
        } else {
            // Decode the JSON response
            $decoded_response = json_decode($response, true);
        
            // Check if decoding was successful
            if ($decoded_response === null) {
                error_log('Error decoding JSON: ' . json_last_error_msg());
            } else {
                // Display the decoded response
                //error_log(print_r($decoded_response));
                if($decoded_response['realm_access'] !== null){
                    $result = in_array('ONEGOV-DEV-USER-ROLEQWERT'/*'LMS_SUPERADMIN'*/, $decoded_response['realm_access']['roles']);
                    error_log($result);
                }
            }
        }

        //eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJsLU1xN0RmZ3pmanhWYnYyMk9EdTVySkswakpLNUZxb0Raa3BFLVFraVdZIn0.eyJleHAiOjE3MTQzMDU5NTQsImlhdCI6MTcxNDMwNDE1NCwianRpIjoiZTgwNDc2MWYtMDdiZi00ZTdlLTlmZTctN2RmODdhZmVkMTcyIiwiaXNzIjoiaHR0cHM6Ly9pYW0tYWNjLmdvdi5idy9yZWFsbXMvY3VzdG9tZXIiLCJhdWQiOiJhY2NvdW50Iiwic3ViIjoiNTcwMmEyNWUtNTNlYS00MmQ1LTk2ZTAtZmYyNTUxZDVjZTVlIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiY3VzdG9tZXItY2xpZW50Iiwic2Vzc2lvbl9zdGF0ZSI6IjE1MzZiNzFhLTI0YTMtNDNmNS1hNDlmLTJiZDhhZWEyZGJhYiIsImFjciI6IjEiLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsib2ZmbGluZV9hY2Nlc3MiLCJDVVNUT01FUiIsIk9ORUdPVi1ERVYtVVNFUi1ST0xFIiwidW1hX2F1dGhvcml6YXRpb24iLCJkZWZhdWx0LXJvbGVzLWN1c3RvbWVyIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJlbWFpbCBwcm9maWxlIiwic2lkIjoiMTUzNmI3MWEtMjRhMy00M2Y1LWE0OWYtMmJkOGFlYTJkYmFiIiwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJuYW1lIjoiWWV3byBUaGV1IiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTg0MTE4OTIwIiwiZ2l2ZW5fbmFtZSI6Illld28iLCJmYW1pbHlfbmFtZSI6IlRoZXUiLCJlbWFpbCI6Inlld290aGV1QHBpeGVscHJvLmNvLmJ3In0.OvvW8fds8k5_YA0kHRHbEBI3X1zg_UaHSq443TDltEzSV7802iwzrfvmbHsTEy2MDJfCqGnRL2a_PnoHxtZtzW8SkHnXq3At8j0jLMAbzaxJumUepfw5Z6xqDikGftdQ5lbelrY0Qey-CggPwedM51q-Uz_pJamWRbhbBRPIui7wf4HcFG4L5dEkBRNJrYkJ336AZewW9R5wfZK8mmyX993QifZMscRX62f-l9jw_LnXToAJdcTSoexL4q4wbL1ISdiYGkj7GHlGpqPaVmwwG1mCTmEuOxs4dGNS_mODjMkI0bZ52KwHym5IxEJsKdLK8QFX1tHLM6GzrAg3KLCwUw

        // Check if the JSON decoding was successful
        //if ($data !== null) {            
        //   if($data['realm_access'] !== null){
        //    $result = in_array('ONEGOV-DEV-USER-ROLE'/*'LMS_SUPERADMIN'*/, $data['realm_access']['roles']);
        //  }
        //}

        //return $result;
    }

    public static function transformName($value){
        // Trim to only the first word
        $value = strstr($value, ' ', true) ?: $value;
    
        // Capitalize the first letter
        $value = ucfirst(strtolower($value));
    
        return $value;
      }

    public static function getEidUser($idnumber){
        global $CFG;
        // API endpoint
        $requestDomain = $CFG->eidApiDomain;
    
        $requestUrl = $requestDomain . 'api/v1/omang/payload/' . $idnumber;
    
        // Initialize cURL session
        $ch = curl_init();
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'x-api-key: ' . $CFG->eidApiKey,
            'Content-Type: application/json'
        ));
    
        // Execute cURL request
        $response = curl_exec($ch);
    
        // Close the cURL session
        curl_close($ch);
    
        // Parse the JSON response
        $data = json_decode($response, true);
    
        // Check if the JSON decoding was successful
        if ($data !== null) {
            // Access the parents property
            // Call the function with the birth date from the response
            return $data['data']['0'];
        }
    
        return null;
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
            // Access the property
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
    
          if($data['message'] !== null){
            return null;
          }
    
          $result = $data;
        }
    
        return $result;
      }
}