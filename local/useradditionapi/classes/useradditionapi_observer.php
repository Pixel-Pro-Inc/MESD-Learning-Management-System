<?php

namespace local_useradditionapi;
// Load Moodle configuration
require_once($CFG->dirroot.'/user/profile/lib.php');

class useradditionapi_observer {
  public static function usercreated(\core\event\user_created $event) {
    // Get the user information from the event
    $user = $event->get_record_snapshot('user', $event->objectid);

    self::senduserrequest($user);
  }

  public static function userupdated(\core\event\user_updated $event) {
    // Get the user information from the event
    $user = $event->get_record_snapshot('user', $event->objectid);

    self::senduserrequest($user);
  }

  public static function senduserrequest($user){
    // Get the current domain from Moodle configuration
    $wwwroot = get_config('moodle', 'wwwroot');

    $requestDomain = get_config('moodle', 'redirectApiDomain');

    $requestUrl = $requestDomain . 'api/user/addUser';

    // Construct the link using the current domain
    $link = $wwwroot . '/login/index.php?nin=';

    profile_load_data($user);

    //Assign Parents and Gaurdians
    //If user is a minor
    self::assignParents($user->profile_field_nin, $user);

    // Prepare the data to send
    $data = array('userId' => $user->profile_field_nin, 'link' => $link);
    $json_data = json_encode($data);

    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL, headers, and POST data as JSON
    curl_setopt($ch, CURLOPT_URL, $requestUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute the request
    curl_exec($ch);

    // Close the cURL session
    curl_close($ch);
  }

  public static function assignParents($idnumber, $child){
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
            $birthDate = $data['data']['BIRTH_DTE'];

            error_log(print_r($data, true));

            if($birthDate == null){
              return;
            }

            // Create a DateTime object from the birth date string
            $birthDateTime = new DateTime($birthDate);
            // Get the current date
            $currentDate = new DateTime();

            // Calculate the difference between the current date and the birth date
            $age = $currentDate->diff($birthDateTime)->y;

            if($age > 30){
              return;
            }

            //Assign Parents
            $fatherId = $data['data']['FATHERS_IDNO'];
            $token = self::getSystemAdminToken();
            if($fatherId !== null){
              $father = self::getUser($fatherId, $token);
              error_log(print_r($father, true));
              self::assignParent($father, $child);
            }
            

            $motherId = $data['data']['MOTHERS_IDNO'];
            if($motherId !== null){
              $mother = self::getUser($motherId, $token);
              self::assignParent($mother, $child);
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

        error_log(print_r($data, true));
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

        error_log(print_r($data, true));
    }

    return $result;
  }

  public static function assignParent($iamUser, $child){
    global $CFG, $DB;
    //Create user in moodle
    // Assuming $username contains the username you want to check or create
    $user = $DB->get_record('user', array('username' => $iamUser->username));

    error_log(print_r($user, true));

    $user_id = 0;

    if ($user) {
        // User already exists, get the user ID
        $user_id = $user->id;
    } else {
        // User doesn't exist, create a new user
        // Create user object
        $user = new stdClass();
        $user->username = $iamUser->username;
        $user->password = 'Password2023*';
        $user->firstname = $iamUser->firstname;
        $user->lastname = $iamUser->lastname;
        if($user->email !== null){
          $user->email = $iamUser->email;
        }else{
          $user->email = 'example@example.com';
        }

        // Attempt to create user
        // If user with that username doesn't exist
        $user_id = user_create_user($user);

        error_log($user_id);

        //Add required profile fields here
        //nin
        $user->profile_field_nin = $iamUser->username;
        //phonenumber
        $user->profile_field_phonenumber = $iamUser->phone_number;
        //userrole
        $user->profile_field_userrole = 'Parent';

        profile_save_data($user);
    }

    //Assign mentees
    $context = \context_user::instance($child->id);

    error_log($context->id);

    role_assign(15, $user_id, $context->id);

    //Add Url of user profile to child
    $userProfile = $CFG->wwwroot . '/user/profile.php?id=' . $user_id;

    $child->profile_field_parent = $child->profile_field_parent . '\n' . $userProfile;

    profile_save_data($child);
  }
}