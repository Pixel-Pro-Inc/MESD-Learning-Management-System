<?php

namespace local_reportanalysis;

class reportanalysis {
 
  public static function sendgradesrequest(array $grades){
    //Send in data from the database to: 
    //Get the courses done in the school
    $courses= array(["coursename"]);
    //Get the levels that exist in  that school
    $level= array(["level"]);
    
    $grades= array([$level, $courses]);

    return $grades;
  }
}