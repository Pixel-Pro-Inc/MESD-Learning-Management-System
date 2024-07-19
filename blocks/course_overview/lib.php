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
 * Library functions for overview.
 *
 * @package   block_course_overview
 * @copyright 2018 Peter Dias
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Constants for the user preferences grouping options
 */
define('BLOCK_COURSE_OVERVIEW_GROUPING_ALLINCLUDINGHIDDEN', 'allincludinghidden');
define('BLOCK_COURSE_OVERVIEW_GROUPING_ALL', 'all');
define('BLOCK_COURSE_OVERVIEW_GROUPING_INPROGRESS', 'inprogress');
define('BLOCK_COURSE_OVERVIEW_GROUPING_FUTURE', 'future');
define('BLOCK_COURSE_OVERVIEW_GROUPING_PAST', 'past');
define('BLOCK_COURSE_OVERVIEW_GROUPING_FAVOURITES', 'favourites');
define('BLOCK_COURSE_OVERVIEW_GROUPING_HIDDEN', 'hidden');
define('BLOCK_COURSE_OVERVIEW_GROUPING_CUSTOMFIELD', 'customfield');

/**
 * Allows selection of all courses without a value for the custom field.
 */
define('BLOCK_COURSE_OVERVIEW_CUSTOMFIELD_EMPTY', -1);

/**
 * Constants for the user preferences sorting options
 * timeline
 */
define('BLOCK_COURSE_OVERVIEW_SORTING_TITLE', 'title');
define('BLOCK_COURSE_OVERVIEW_SORTING_LASTACCESSED', 'lastaccessed');
define('BLOCK_COURSE_OVERVIEW_SORTING_SHORTNAME', 'shortname');

/**
 * Constants for the user preferences view options
 */
define('BLOCK_COURSE_OVERVIEW_VIEW_CARD', 'card');
define('BLOCK_COURSE_OVERVIEW_VIEW_LIST', 'list');
define('BLOCK_COURSE_OVERVIEW_VIEW_SUMMARY', 'summary');

/**
 * Constants for the user paging preferences
 */
define('BLOCK_COURSE_OVERVIEW_PAGING_12', 12);
define('BLOCK_COURSE_OVERVIEW_PAGING_24', 24);
define('BLOCK_COURSE_OVERVIEW_PAGING_48', 48);
define('BLOCK_COURSE_OVERVIEW_PAGING_96', 96);
define('BLOCK_COURSE_OVERVIEW_PAGING_ALL', 0);

/**
 * Constants for the admin category display setting
 */
define('BLOCK_COURSE_OVERVIEW_DISPLAY_CATEGORIES_ON', 'on');
define('BLOCK_COURSE_OVERVIEW_DISPLAY_CATEGORIES_OFF', 'off');

/**
 * Get the current user preferences that are available
 *
 * @uses core_user::is_current_user
 *
 * @return array[] Array representing current options along with defaults
 */
function block_course_overview_user_preferences(): array {
    $preferences['block_course_overview_user_grouping_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_COURSE_OVERVIEW_GROUPING_ALL,
        'type' => PARAM_ALPHA,
        'choices' => array(
            BLOCK_COURSE_OVERVIEW_GROUPING_ALLINCLUDINGHIDDEN,
            BLOCK_COURSE_OVERVIEW_GROUPING_ALL,
            BLOCK_COURSE_OVERVIEW_GROUPING_INPROGRESS,
            BLOCK_COURSE_OVERVIEW_GROUPING_FUTURE,
            BLOCK_COURSE_OVERVIEW_GROUPING_PAST,
            BLOCK_COURSE_OVERVIEW_GROUPING_FAVOURITES,
            BLOCK_COURSE_OVERVIEW_GROUPING_HIDDEN,
            BLOCK_COURSE_OVERVIEW_GROUPING_CUSTOMFIELD,
        ),
        'permissioncallback' => [core_user::class, 'is_current_user'],
    );

    $preferences['block_course_overview_user_grouping_customfieldvalue_preference'] = [
        'null' => NULL_ALLOWED,
        'default' => null,
        'type' => PARAM_RAW,
        'permissioncallback' => [core_user::class, 'is_current_user'],
    ];

    $preferences['block_course_overview_user_sort_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_COURSE_OVERVIEW_SORTING_LASTACCESSED,
        'type' => PARAM_ALPHA,
        'choices' => array(
            BLOCK_COURSE_OVERVIEW_SORTING_TITLE,
            BLOCK_COURSE_OVERVIEW_SORTING_LASTACCESSED,
            BLOCK_COURSE_OVERVIEW_SORTING_SHORTNAME
        ),
        'permissioncallback' => [core_user::class, 'is_current_user'],
    );

    $preferences['block_course_overview_user_view_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_COURSE_OVERVIEW_VIEW_CARD,
        'type' => PARAM_ALPHA,
        'choices' => array(
            BLOCK_COURSE_OVERVIEW_VIEW_CARD,
            BLOCK_COURSE_OVERVIEW_VIEW_LIST,
            BLOCK_COURSE_OVERVIEW_VIEW_SUMMARY
        ),
        'permissioncallback' => [core_user::class, 'is_current_user'],
    );

    $preferences['/^block_course_overview_hidden_course_(\d)+$/'] = array(
        'isregex' => true,
        'choices' => array(0, 1),
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 0,
        'permissioncallback' => [core_user::class, 'is_current_user'],
    );

    $preferences['block_course_overview_user_paging_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_COURSE_OVERVIEW_PAGING_12,
        'type' => PARAM_INT,
        'choices' => array(
            BLOCK_COURSE_OVERVIEW_PAGING_12,
            BLOCK_COURSE_OVERVIEW_PAGING_24,
            BLOCK_COURSE_OVERVIEW_PAGING_48,
            BLOCK_COURSE_OVERVIEW_PAGING_96,
            BLOCK_COURSE_OVERVIEW_PAGING_ALL
        ),
        'permissioncallback' => [core_user::class, 'is_current_user'],
    );

    return $preferences;
}

/**
 * Pre-delete course hook to cleanup any records with references to the deleted course.
 *
 * @param stdClass $course The deleted course
 */
function block_course_overview_pre_course_delete(\stdClass $course) {
    // Removing any favourited courses which have been created for users, for this course.
    $service = \core_favourites\service_factory::get_service_for_component('core_course');
    $service->delete_favourites_by_type_and_item('courses', $course->id);
}
