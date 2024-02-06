<?php

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2023120400;
$plugin->requires = 2020110900;
$plugin->component = 'local_reportanalysis';
$plugin->maturity  = MATURITY_STABLE;

$tasks = array(
    array(
        'classname' => '\local_reportanalysis\task\monthly_report_status_update',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '0',
        'day' => '1',
        'dayofweek' => '*',
        'month' => '*',
        'disabled' => 0,
    )
);
