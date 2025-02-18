<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Main login page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../config.php');

redirect_if_major_upgrade_required();

$context = context_system::instance();
$PAGE->set_url("$CFG->wwwroot/singlesignon/index.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

//SSO Login
require_once($CFG->dirroot . '/local/autologin/classes/autologin.php');

// Instantiate the local_autologin class.
$autologin = new local_autologin();

// Call the attempt_autologin method.
$autologin->attempt_autologin();

//SSO Login