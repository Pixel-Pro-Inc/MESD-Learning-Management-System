<?php
/**
 * @author     Terrence Titus
 * @package    block_search_user
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class search_form extends moodleform {

    function definition() {
        global $DB;
        
        $mform = $this->_form; // Don't forget the underscore! 
        
        // Get all users who haven't been deleted
        $allusers = $DB->get_records_select('user', 'deleted = ?', array(0));

        $usernames = array();

        $usernames[0] = '';
        
        foreach ($allusers as $user) {
            if($user->id != 1){
                $usernames[$user->id] = fullname($user);
            }
        }

        $options = array(                                                                                                    
            'multiple' => false,                                              
            'noselectionstring' => get_string('allareas', 'search'),  
            'placeholder' => 'Select a user'                                                          
        );
                
        $mform->addElement('autocomplete', 'search_user', 'User', $usernames, '', $options);
        $mform->addRule('search_user', get_string('required'), 'required', null, 'client');

        $this->add_action_buttons(false, 'Go to profile');
    }
}
?>
