#!/usr/bin/env php
<?php
// Your plugin's CLI script for backing up and restoring the Moodle database.

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/clilib.php');

// Now get cli options.
list($options, $unrecognized) = cli_get_params(
    array(
        'backup' => false,
        'restore' => false,
        'help' => false,
    ),
    array(
        'h' => 'help',
    )
);

if ($options['help']) {
    $help =
        "Perform backup or restore of the Moodle database.

        Options:
        --backup            Perform a database backup
        --restore           Restore the database from the backup
        -h, --help          Print out this help

        Example:
        \$sudo -u apache /usr/bin/php /local/yourpluginname/cli/backuprestore.php --backup
        ";

    echo $help;
    exit(0);
}




function backup_database() { 
    global $CFG;
    $dateTime= new DateTime();
    $timestamp= $dateTime->getTimestamp();
     // Perform database backup.
     $backupfile = '/var/moodledata/database_backup'.$timestamp.'.sql';
     //Checks if the file exists and creates it if it doesn't
     if(!file_exists($backupfile)) touch($backupfile);
     exec("mysqldump --opt --user={$CFG->dbuser} --password={$CFG->dbpass} {$CFG->dbname} > $backupfile");
     mtrace("Database backup completed.");
}
function restore_database($pathtodatabasefile) {   
    global $CFG;     
    //If there is no file it should throw an error notifcation
    if(!file_exists($pathtodatabasefile)){
        \core\notification::add("The file asked for doesn't exist", \core\output\notification::NOTIFY_INFO);
        return;
    }

    exec("mysql --opt --user={$CFG->dbuser} --password={$CFG->dbpass} {$CFG->dbname} < $pathtodatabasefile");
    mtrace("Database restored from backup.");
}