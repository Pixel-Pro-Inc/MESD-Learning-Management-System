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
        // Parse the JSON response
        $data = self::getEidUser($idnumber);
    
        // Check if the JSON decoding was successful
        if ($data !== null) {
            // Access the parents property
            // Call the function with the birth date from the response
            $birthDate = $data['BIRTH_DTE'];

            if($birthDate == null){
              return;
            }

            // Create a DateTime object from the birth date string
            $birthDateTime = new \DateTime($birthDate);
            // Get the current date
            $currentDate = new \DateTime();

            // Calculate the difference between the current date and the birth date
            $age = $currentDate->diff($birthDateTime)->y;

            if($age > $CFG->assignParentCuttOff){
              return;
            }

            //Assign Parents
            $fatherId = $data['FATHERS_IDNO'];

            $token = self::getSystemAdminToken();

            if($fatherId !== null){
              $father = self::getUser($fatherId, $token);
              //If parent has account with IAM              
              if($father !== null){
                self::assignParent($father, $child, 'Male');
              }
              //If parent does not have account with IAM   
              //Create Moodle Account With EID           
              if($father === null){
                $data = self::getEidUser($fatherId);

                $eidFather = array('username' => $fatherId, 'firstname' => self::transformName($data['FIRST_NME']), 
                'lastname' => self::transformName($data['SURNME']), 'email' => null, 'phone_number' => '26771111111');

                self::assignParent($eidFather, $child, 'Male');
              }              
            }
            

            $motherId = $data['MOTHERS_IDNO'];

            if($motherId !== null){
              $mother = self::getUser($motherId, $token);  
              //If parent has account with IAM      
              if($mother !== null){
                self::assignParent($mother, $child, 'Female');
              }
              //If parent does not have account with IAM   
              //Create Moodle Account With EID
              if($mother === null){
                $data = self::getEidUser($motherId);

                $eidMother = array('username' => $motherId, 'firstname' => self::transformName($data['FIRST_NME']), 
                'lastname' => self::transformName($data['SURNME']), 'email' => null, 'phone_number' => '26771111111');

                self::assignParent($eidMother, $child, 'Female');
              }
            }
        }
  }

  public static function transformName($value){
    // Trim to only the first word
    $value = strstr($value, ' ', true) ?: $value;

    // Capitalize the first letter
    $value = ucfirst(strtolower($value));

    return $value;
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

  public static function assignParent($parentUser, $child, $parentGender){
    global $CFG, $DB;
    //Create user in moodle
    // Assuming $username contains the username you want to check or create
    $user = $DB->get_record('user', array('username' => $parentUser['username']));

    $user_id = 0;

    if ($user) {
        // User already exists, get the user ID
        $user_id = $user->id;
    } else {
        // User doesn't exist, create a new user
        // Create user object
        $user = new \stdClass();
        $user->username = $parentUser['username'];
        $user->password = 'Password2023*';
        $user->firstname = $parentUser['firstname'];
        $user->lastname = $parentUser['lastname'];
        if($parentUser['email'] !== null){
          $user->email = $parentUser['email'];
        }else{
          $user->email = $parentUser['firstname'] . $parentUser['username'] . '@example.com';
        }

        $user->auth = 'manual';
        $user->confirmed = 1;
        $user->mnethostid = 1;
        $user->timecreated = time();
        $user->maildisplay = 0;

        // Attempt to create user
        // If user with that username doesn't exist
        $user_id = user_create_user($user);

        //Get User From ID
        $user = $DB->get_record('user', array('id' => $user_id));

        profile_load_data($user);

        //Add required profile fields here
        //gender
        $user->profile_field_gender = $parentGender;
        //nin
        $user->profile_field_nin = $parentUser['username'];
        //phonenumber
        $user->profile_field_phonenumber = $parentUser['phone_number'];
        //userrole
        $user->profile_field_userrole = 'Parent';

        profile_save_data($user);
    }

    //Assign mentees
    $context = \context_user::instance($child->id);

    role_assign(15, $user_id, $context->id);

    //Add Url of user profile to child
    $userProfile = $CFG->wwwroot . '/user/profile.php?id=' . $user_id;

    if(!$child->profile_field_parent){
      $child->profile_field_parent += $userProfile . "\n\n";
    }else{
      $child->profile_field_parent = $userProfile . "\n\n";
    }

    profile_save_data($child);
  }
}