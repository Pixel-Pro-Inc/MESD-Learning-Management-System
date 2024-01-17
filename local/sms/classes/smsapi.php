<?php
/**
 * @author     Terrence Titus
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


class smsapi {
    function sendSMS($number, $subject, $message) {
        $url = 'http://coms-acc.gov.bw/sms';

        $headers = array(
           'Content-Type: application/json',
           'Accept: application/json'
        );
     
        $data = array(
           "number" => $number,
           "subject" => $subject,
           "message" => $message
        );
        $json_data = json_encode($data);

        $ch = curl_init($url);

        // Set the URL, headers, and POST data as JSON
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                            
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);                                                         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                             
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                                                                
        
        $result = curl_exec($ch);

        if(!$result){
            die("Connection Failure");
        }

        curl_close($ch);
     
        return $result; 
    }
}

