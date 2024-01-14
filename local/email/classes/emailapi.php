<?php
/**
 * @author     Terrence Titus
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


class emailapi {
    function sendEmailAPI($to, $subject, $message, $attachments = []) {
        // The API endpoint
        $url = 'http://coms.gov.bw/email';
     
        // Prepare the data
        $data = array(
            'email' => $to,
            'subject' => $subject,
            'message' => $message,
            'html' => '',
            'attachments' => $attachments
        );
     
        // Convert the data to JSON
        $json_data = json_encode($data);
     
        // Initialize a cURL session
        $ch = curl_init();
     
        // Set the URL, headers, and POST data as JSON
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
     
        // Execute the request
        $response = curl_exec($ch);
     
        // Close the cURL session
        curl_close($ch);
     
        // Decode the response
        $decodedResponse = json_decode($response, true);
     
        // Return the response
        return $decodedResponse;
    }

    function reArrayFiles($filePost) {
        // Check if 'name' key exists and is an array
        if (!isset($filePost['name']) || !is_array($filePost['name'])) {
            return array();
        }
      
        $fileArray = array();
        $fileCount = count($filePost['name']);
        $fileKey = array_keys($filePost);
      
        for ($i=0; $i<$fileCount; $i++) {
            foreach ($fileKey as $key) {
                $fileArray[$i][$key] = $filePost[$key][$i];
            }
        }
        return $fileArray;
    }
        
}

