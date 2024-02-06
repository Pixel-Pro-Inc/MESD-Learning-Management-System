<?php

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname' => '\core\event\user_updated',
        'callback' => '\local_assignuserrole\assignuserrole_observer::userupdated',
        'priority' => 9999,
    ],
    [
        'eventname' => '\core\event\user_created',
        'callback' => '\local_assignuserrole\assignuserrole_observer::usercreated',
        'priority' => 9999,
    ],
];