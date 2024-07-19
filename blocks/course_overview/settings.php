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
 * Settings for the myoverview block
 *
 * @package    block_course_overview
 * @copyright  2019 Tom Dickman <tomdickman@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->dirroot . '/blocks/course_overview/lib.php');

    // Presentation options heading.
    $settings->add(new admin_setting_heading('block_course_overview/appearance',
            get_string('appearance', 'admin'),
            ''));

    // Display Course Categories on Dashboard course items (cards, lists, summary items).
    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaycategories',
            get_string('displaycategories', 'block_course_overview'),
            get_string('displaycategories_help', 'block_course_overview'),
            1));

    // Enable / Disable available layouts.
    $choices = array(BLOCK_COURSE_OVERVIEW_VIEW_CARD => get_string('card', 'block_course_overview'),
            BLOCK_COURSE_OVERVIEW_VIEW_LIST => get_string('list', 'block_course_overview'),
            BLOCK_COURSE_OVERVIEW_VIEW_SUMMARY => get_string('summary', 'block_course_overview'));
    $settings->add(new admin_setting_configmulticheckbox(
            'block_course_overview/layouts',
            get_string('layouts', 'block_course_overview'),
            get_string('layouts_help', 'block_course_overview'),
            $choices,
            $choices));
    unset ($choices);

    // Enable / Disable course filter items.
    $settings->add(new admin_setting_heading('block_course_overview/availablegroupings',
            get_string('availablegroupings', 'block_course_overview'),
            get_string('availablegroupings_desc', 'block_course_overview')));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingallincludinghidden',
            get_string('allincludinghidden', 'block_course_overview'),
            '',
            0));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingall',
            get_string('all', 'block_course_overview'),
            '',
            1));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupinginprogress',
            get_string('inprogress', 'block_course_overview'),
            '',
            1));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingpast',
            get_string('past', 'block_course_overview'),
            '',
            1));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingfuture',
            get_string('future', 'block_course_overview'),
            '',
            1));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingcustomfield',
            get_string('customfield', 'block_course_overview'),
            '',
            0));

    $choices = \core_customfield\api::get_fields_supporting_course_grouping();
    if ($choices) {
        $choices  = ['' => get_string('choosedots')] + $choices;
        $settings->add(new admin_setting_configselect(
                'block_course_overview/customfiltergrouping',
                get_string('customfiltergrouping', 'block_course_overview'),
                '',
                '',
                $choices));
    } else {
        $settings->add(new admin_setting_configempty(
                'block_course_overview/customfiltergrouping',
                get_string('customfiltergrouping', 'block_course_overview'),
                get_string('customfiltergrouping_nofields', 'block_course_overview')));
    }
    $settings->hide_if('block_course_overview/customfiltergrouping', 'block_course_overview/displaygroupingcustomfield');

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupingfavourites',
            get_string('favourites', 'block_course_overview'),
            '',
            1));

    $settings->add(new admin_setting_configcheckbox(
            'block_course_overview/displaygroupinghidden',
            get_string('hiddencourses', 'block_course_overview'),
            '',
            1));
}
