<?php
/**
 * @author     Terrence
 * @package    local_departments
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

//require(__DIR__ . '/../../config.php');

class lib {
    function local_departments_extend_navigation(global_navigation $navigation) {
        // Only add this navigation item to users with the appropriate capability.
        if (!has_capability('local/departments:viewdepartmentmanager', context_system::instance())) {
            return;
        }
     
        // Create the URL for the custom department page.
        $url = new moodle_url('/local/departments/department_manager.php');
     
        // Create the navigation node.
        $node = navigation_node::create(
            get_string('manager', 'local_departments'), // Node title.
            $url,                                   // Node URL.
            navigation_node::TYPE_SETTING,            // Node type.
            null,                                   // Parent key.
            'departments',                           // Node key.
            new pix_icon('i/settings', '')            // Node icon.
        );
     
        // Add the node to the navigation.
        $navigation->add_node($node);
    }
     
 
}
