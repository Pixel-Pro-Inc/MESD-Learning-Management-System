<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once("$CFG->libdir/formslib.php");

 class delete_department_button extends moodleform {
  
  protected function definition() {
   global $USER, $DB;
   
   $mform = $this->_form;
 
   // Add a delete button to the form
   $deletebutton = $mform->createElement('button', 'delete', 'Delete Department');
   $deletebutton->setType('submit');
   $deletebutton->updateAttributes(['onclick' => 'return confirm(\'Are you sure you want to delete this department?\')']);
   $mform->registerNoSubmitButton('delete');
   $mform->addElement($deletebutton);
  }
  
  public function __construct($action = null, $customdata = null) {
    parent::__construct($action, $customdata);
  }
  
 }
 
 