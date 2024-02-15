<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('MOODLE_DB_HOST');
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'admin';
$CFG->dbpass    = 'Password';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 3306,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_unicode_ci',
);

$CFG->wwwroot   = 'http://localhost:8080';
$CFG->dataroot  = '/var/www/html/moodledata';
$CFG->admin     = 'admin';

//Environment Variables For Our Custom Plugins Go Here
$CFG->logoutredir = 'https://uatportal.gov.bw/';
$CFG->shaSecret = 'secret';
$CFG->redirectApiDomain = 'http://127.0.0.1:5000/';
//IAM API
$CFG->iamApiDomain = "https://gateway-cus-acc.gov.bw/";
$CFG->iamSystemAdminUsername = "lms_admin";
$CFG->iamSystemAdminPassword = "01001111001010";
//Communications API
$CFG->comsSMSUrl = 'https://coms.gov.bw/sms';
$CFG->comsEmailUrl = 'https://coms.gov.bw/email';
//EID API
$CFG->eidApiDomain = 'http://idverification-acc.gov.bw:8081/';
$CFG->eidApiKey = 'KLBzNwGVZMRF9c65MOMV7Cl8rhIMTu4z';
$CFG->assignParentCuttOff = 21;
//Appointments API
$CFG->serviceId = '65c4835b625a7be036df5be6';
$CFG->serviceName = 'MESD-LMS';
$CFG->appointmentsApiDomain = 'https://appoint.gov.bw/';
//End of Appointments API
//End of Environment Variables

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
