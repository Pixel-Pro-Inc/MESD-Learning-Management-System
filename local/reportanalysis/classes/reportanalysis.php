<?php

namespace local_reportanalysis;

class reportanalysis {
 
  public static function sendgradesrequest(array $grades){
    //Send in data from the database to: 
    //Get the coursegrades done in the school
    $coursegrades= array(["coursename", "grade"]);
    //Get the levels that exist in  that school
    $level= array(["level"]);
    
    $grades= array([$level, $coursegrades]);

    return $grades;
  }
}