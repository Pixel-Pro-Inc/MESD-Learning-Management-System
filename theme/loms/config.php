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
 * Loms.
 *
 * @package    theme_loms
 * @copyright  2023 EnvyTheme
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

if (!defined('LOMS_IMG')) {
    define('LOMS_IMG', $CFG->wwwroot . '/theme/loms/pix/');
}

$THEME->name = 'loms';
$THEME->sheets = [ 'bootstrap-select', 'owl-carousel', 'owl-theme-default', 'magnific-popup', 'animate', 'boxicons', 'remixicon', 'flaticon', 'meanmenu', 'style', 'loms-mdl-core', 'responsive', 'dashboard' ];
$THEME->editor_sheets = [];
$THEME->parents = ['boost'];

$THEME->layouts = [
    // Most backwards compatible layout without the blocks.
    'base' => array(
        'file' => 'drawers.php',
        'regions' => array(),
    ),
    // Standard layout with blocks.
    'standard' => array(
        'file' => 'drawers.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Main course page.
    'course' => array(
        'file' => 'drawers.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true),
    ),
    'coursecategory' => array(
        'file' => 'drawers.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'drawers.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // The site home page.
    'frontpage' => array(
        'file' => 'drawers.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'loms_dashboard.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // My courses page.
    'mycourses' => array(
        'file' => 'drawers.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    'mydashboard' => array(
        'file' => 'loms_my.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true, 'langmenu' => true, 'nocontextheader' => true),
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'drawers.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    'login' => array(
        'file' => 'login.php',
        'regions' => array('fullwidth-top', 'fullwidth-bottom', 'above-content', 'below-content', 'left', 'side-pre'),
        'options' => array('langmenu' => true),
        'defaultregion' => 'below-content',
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header and bare activity header.
    'popup' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array(
            'nofooter' => true,
            'nonavbar' => true,
            'activityheader' => [
                'notitle' => true,
                'nocompletion' => true,
                'nodescription' => true
            ]
        )
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array(
            'nofooter' => true,
            'nocoursefooter' => true,
            'activityheader' => [
                'nocompletion' => true
            ]
        ),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // Please be extremely careful if you are modifying this layout.
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => false, 'noactivityheader' => true),
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'columns2.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre'
    )
];

$THEME->enable_dock = false;
$THEME->yuicssmodules = array();
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->scss = function($theme) {
    return theme_loms_get_main_scss_content($theme);
};

$THEME->javascripts = array( 'bootstrap-select.min', 'magnific-popup.min', 'loms.dashboard.preprocess', 'meanmenu.min', 'wow.min', 'owl.carousel.min', 'carousel.thumbs.min', 'ajaxchimp.min', 'mixitup.min', 'main');

$THEME->iconsystem = '\\theme_loms\\output\\icon_system_fontawesome';
$THEME->csspostprocess = 'theme_loms_process_css';
$THEME->haseditswitch = true;
$THEME->usescourseindex = true;
// By default, all boost theme do not need their titles displayed.
$THEME->activityheaderconfig = [
    'notitle' => true
];