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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     mod_synchronouslearning
 * @copyright   2024 MESD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
function synchronouslearning_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_synchronouslearning into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_synchronouslearning_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function synchronouslearning_add_instance($moduleinstance, $mform = null) {
    global $DB, $USER;

    $moduleinstance->timecreated = time();

    //Perform API call and save URL to the database
    $api_response = sendrequest($moduleinstance->timeopen, 
    $moduleinstance->timeclose, $USER);

    //if($api_response === 'error occured'){
    //    return 0;
    //}

    $moduleinstance->url = 'https://example.com/';//$api_response;

    $id = $DB->insert_record('synchronouslearning', $moduleinstance);

    return $id;
}

function sendrequest($scheduleTimeOpen, $scheduleTimeClose, $user){
    // Prepare the data to send

    profile_load_data($user);

    $data = array(
        'title' => 'Online Class', 
        'description' => 'Virtual class session facilitated through one gov',
        'location' => 'Virtual Class',
        'applicationId' => '',
        'user' => $user->profile_field_onegovid,
        'isVirtual' => true,
        'virtualPlatform' => 'Webex',
        'startTime' => $scheduleTimeOpen,
        'endTime' => $scheduleTimeClose,
        'isRecurring' => false,
        'hasService' => false,
        'state' => 'scheduled',
        'appointmentType' => 'meeting',
        'service' => array(
            'id' => '',
            'name' => 'MESD LMS'
        ),
    );

    $json_data = json_encode($data);

    // Initialize a cURL session
    $ch = curl_init();

    $devUrl = "https://gappoint-acc.gov.bw"; $prodUrl = "https://appoint.gov.bw";

    // Set the URL, headers, and POST data as JSON
    curl_setopt($ch, CURLOPT_URL, $prodUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Ensure cURL returns the response instead of printing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and capture the response
    $response = curl_exec($ch);

    $meetingLink = 'error occured';

    // Close the cURL session
    curl_close($ch);

    // Parse the JSON response
    $data = json_decode($response, true);

    // Check if the JSON decoding was successful
    if ($data !== null) {
        // Access the meetingLink property
        $meetingLink = $data['virtualMeta']['meetingLink'];
    }

    return $meetingLink;
  }

/**
 * Updates an instance of the mod_synchronouslearning in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_synchronouslearning_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function synchronouslearning_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('synchronouslearning', $moduleinstance);
}

/**
 * Removes an instance of the mod_synchronouslearning from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function synchronouslearning_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('synchronouslearning', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('synchronouslearning', array('id' => $id));

    return true;
}

/**
 * Extends the global navigation tree by adding mod_synchronouslearning nodes if there is a relevant content.
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $synchronouslearningnode An object representing the navigation tree node.
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
function synchronouslearning_extend_navigation($synchronouslearningnode, $course, $module, $cm) {
}

/**
 * Extends the settings navigation with the mod_synchronouslearning settings.
 *
 * This function is called when the context for the page is a mod_synchronouslearning module.
 * This is not called by AJAX so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@see settings_navigation}
 * @param navigation_node $synchronouslearningnode {@see navigation_node}
 */
function synchronouslearning_extend_settings_navigation($settingsnav, $synchronouslearningnode = null) {
}
