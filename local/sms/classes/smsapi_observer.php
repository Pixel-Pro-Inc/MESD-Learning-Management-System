<?php
/**
 * @author     Terrence Titus
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


class smsapi_observer {
    function sendSMS($number, $subject, $message) {
        $url = 'https://coms.gov.bw/sms';
     
        $headers = array(
           'Content-Type: application/json',
           'Accept: application/json'
        );
     
        $data = array(
           'number' => $number,
           'subject' => $subject,
           'message' => $message
        );
     
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                            
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));                                                         
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

