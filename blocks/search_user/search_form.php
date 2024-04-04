<?php
/**
 * @author     Terrence Titus
 * @package    block_search_user
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class search_form extends moodleform {

    function definition() {
        global $CFG, $DB;
        
        $mform = $this->_form; // Don't forget the underscore! 
        
        // Get all users who haven't been deleted
        $allusers = $DB->get_records_select('user', 'deleted = ?', array(0));

        $usernames = array();
        foreach ($allusers as $user) {
            $usernames[$user->id] = fullname($user) . ' - ' . $user->email;
        }

        $options = array(                                                                                                    
            'multiple' => false,                                              
            'noselectionstring' => get_string('allareas', 'search'),  
            'placeholder' => 'Select a user'                                                          
         );        
        $autocomplete = $mform->addElement('autocomplete', 'search_user', 'Selected User', $usernames, '', $options);
        $mform->addRule('search_user', get_string('required'), 'required', null, 'client');

        $autocomplete->setValue('');

        $this->add_action_buttons(false, 'Go to profile');
    }
}
?>
