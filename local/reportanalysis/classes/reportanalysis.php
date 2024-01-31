<?php

namespace local_reportanalysis;

class reportanalysis {
 
  public static function sendgradesrequest(array $grades){
    // Get the current domain from Moodle configuration
    $wwwroot = get_config('moodle', 'wwwroot');

    // Construct the link using the current domain
    $link = $wwwroot;

    // Prepare the data to send
    $data = array('grades' => $grades, 'link' => $link);
    $json_data = json_encode($data);

    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL, headers, and POST data as JSON
    curl_setopt($ch, CURLOPT_URL, "http://ec2-51-20-2-134.eu-north-1.compute.amazonaws.com/api/report/status");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute the request
    curl_exec($ch);

    // Close the cURL session
    curl_close($ch);
  }
}