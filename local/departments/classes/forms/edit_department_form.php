<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

 class edit_department_form extends moodleform {
 
    protected function definition() {
        global $USER, $DB;
        
        $mform = $this->_form;
        
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);
        
        $mform->addElement('text', 'department_name', 'Department name', array('size' => '30'));
        $mform->setType('department_name', PARAM_TEXT);
        
        //!!!!!!!!!! Users not in the department !!!!!!!!!!!!! 
        $usersNotInDepartment = $DB->get_records_sql("
            SELECT u.* 
            FROM {user} u 
            WHERE u.id NOT IN (
                SELECT lud.user_id 
                FROM {local_user_department} lud 
                WHERE lud.department_id = ?
            )
            ORDER BY u.firstname ASC, u.lastname ASC", 
            array($this->_customdata['id'])
        );
        $userlistNotInDepartment = array();
        foreach ($usersNotInDepartment as $user) {
        $userlistNotInDepartment[$user->id] = fullname($user);
        }
        // Define options for the autocomplete element
        $options = ['multiple' => true];
        // Add the autocomplete element to the form
        $mform->addElement('autocomplete', 'user_id_not_in_department', 'Add users', $userlistNotInDepartment, $options);
        $mform->setType('user_id_not_in_department', PARAM_INT);

        // !!!!!!!!!! Users in the department !!!!!!!!!
        $usersInDepartment = $DB->get_records_sql("
        SELECT u.* 
        FROM {user} u
        WHERE u.id IN (
           SELECT lud.user_id 
           FROM {local_user_department} lud
           WHERE lud.department_id = ?
        ) 
        ORDER BY u.firstname ASC, u.lastname ASC", 
            array($this->_customdata['id'])
        );
        //$userlistInDepartment = array();
        foreach ($usersInDepartment as $user) {
            $userlistInDepartment[$user->id] = fullname($user);
            $test[$user->id] = fullname($user);
        }
        // Add the autocomplete element to the form
        $mform->addElement('autocomplete', 'user_id_in_department', 'Remove users', $test, $options);
        $mform->setType('user_id_in_department', PARAM_INT);

        $this->add_action_buttons();
    }
}
 
 