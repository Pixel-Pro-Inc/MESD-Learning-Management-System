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
        
        $allusers = $DB->get_records('user');

        $usernames = array();
        foreach ($allusers as $user) {
            $usernames[$user->id] = fullname($user);
        }

        $options = array(                                                                                                    
            'multiple' => false,                                              
            'noselectionstring' => get_string('allareas', 'search'),                                                            
         );        
        $mform->addElement('autocomplete', 'search_user', 'User', $usernames, $options);
        $mform->addRule('search_user', get_string('required'), 'required', null, 'client');

        $this->add_action_buttons(false, 'Go to profile');
    }
}
   