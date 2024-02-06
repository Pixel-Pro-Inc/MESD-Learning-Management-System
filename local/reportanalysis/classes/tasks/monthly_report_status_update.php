<?php
namespace local_reportanalysis\task;

defined('MOODLE_INTERNAL') || die();

class monthly_report_status_update extends \core\task\scheduled_task {

    public function execute() {
        global $DB;

        // Check if the last execution was more than a month ago
        $lastExecution = $this->get_last_run_time();
        // If it has been more than a month since the last execution, proceed with the update
        if ($lastExecution === false || time() - $lastExecution > 2592000) {           
            // Fetch all grades
            $grades = $DB->get_records('grade_grades');
            //Tries to send the grades to the observer so that it makes its way to the API
            \local_reportanalysis\reportanalysis::sendgradesrequest($grades);
        }
    }
    public function get_name() {
        return 'Monthly report status update';
    }
}