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
 * Parent theme: boost
 *
 * @package   theme_loms
 * @copyright EnvyTheme
 *
 */
global $CFG;

require_once($CFG->dirroot . "/course/renderer.php");
require_once($CFG->dirroot . '/theme/loms/inc/course_handler/loms_course_handler.php');

/**
 * Course renderer
 */
class theme_loms_core_course_renderer extends core_course_renderer {
    /**
     * Overrrides the context for the course card renderer
     * Includes custom course fields
     */
    protected function render_course_card($course) {
        global $DB;
        $coursecontext = \context_course::instance($course->id);

        error_log('This is the course before the custom field');
        error_log(print_r($course, true));
        
        // Replace 5 with your actual custom field ID
        $courselevel = $DB->get_field('customfield_data', 'value', [
            'fieldid' => 5,
            'instanceid' => $course->id
        ]);

        error_log('This is the custom field');
        error_log(print_r($courselevel, true));
        
        // Add the custom field value to the course object
        $course->courselevel = $courselevel;

        error_log('This is the course after the custom field');
        error_log(print_r($course, true));

        return $this->render_from_template('core_course/coursecard', $course);
    }
    /**
     * Returns HTML to display a course category as a part of a tree
     *
     * This is an internal function, to display a particular category and all its contents
     * use {@link core_course_renderer::course_category()}
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_category $coursecat
     * @param int $depth depth of this category in the current tree
     * @return string
     */
    protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {

        global $CFG, $PAGE;

        $categoryname = $coursecat->get_formatted_name();
        $loms_category_link = new moodle_url('/course/index.php', array('categoryid' => $coursecat->id));

        $loms_cat = $coursecat->id;
        $loms_cat_summary_unclean = $chelper->get_category_formatted_description($coursecat);
        if ($loms_cat_summary_unclean !== null) {
            $loms_cat_summary = preg_replace("/<img[^>]+\>/i", " ", $loms_cat_summary_unclean);
        } else {
            $loms_cat_summary = '';
        }        $children_courses = $coursecat->get_courses();
        $loms_items_count = '';

        if ($coursecat->get_children_count() > 0) {
            $loms_items_count .= $coursecat->get_children_count() . ' ' . get_string('categories');
        } else {
            $loms_items_count .= count($coursecat->get_courses()) . ' ' . get_string('courses');
        }
        $loms_cat_updated = get_string('modified') . ' ' . userdate($coursecat->timemodified, '%d %B %Y', 0);

        $contentimages = '';
        if ($description = $chelper->get_category_formatted_description($coursecat)) {
            $dom = new \DOMDocument();
            $dom->loadHTML($description);
            $xpath = new \DOMXPath($dom);
            $src = $xpath->evaluate("string(//img/@src)");
        }

        if (isset($src)){
            $contentimages = '<img class="img-whp" src="'.$src.'" alt="'.$categoryname.'">';
        } else {
            $contentimages = '<img class="img-whp" src="'.$CFG->wwwroot.'/theme/loms/pix/category.webp">';
            foreach($children_courses as $child_course) {
                if ($child_course === reset($children_courses)) {
                        foreach ($child_course->get_course_overviewfiles() as $file) {
                        $isimage = $file->is_valid_image();
                        $url = file_encode_url("$CFG->wwwroot/pluginfile.php", '/'. $file->get_contextid(). '/'. $file->get_component(). '/'. $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                        if ($isimage) {
                            $contentimages = '<img class="img-whp" src="'.$url.'">';
                        }
                    }
                }
            }
        }

        $content = '';
        $content .= '
        <div class="col-xl-3 col-md-6">
            <div class="courses_list_content">
                <div class="single-courses">
                    <div class="courses-image">
                        <a href="'.$loms_category_link.'" class="d-block courses-img">
                            '.$contentimages.'
                        </a>
                    </div>

                    <div class="courses-content">
                        <h3>
                            <a href="'. $loms_category_link .'">'.$categoryname.'</a>
                        </h3>

                        <ul class="star-price list-unstyled pl-0 d-flex justify-content-between align-items-center">
                            <li class="loms-course-date">'.$loms_cat_updated.'</li>
                            
                            <li>
                                <span class="price">'.$loms_items_count.'</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>';

        return $content;        
    }

    /**
     * Renders the list of subcategories in a category
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_category $coursecat
     * @param int $depth depth of the category in the current tree
     * @return string
     */
    protected function coursecat_subcategories(coursecat_helper $chelper, $coursecat, $depth) {
        global $CFG;
        $subcategories = array();
        if (!$chelper->get_categories_display_option('nodisplay')) {
            $subcategories = $coursecat->get_children($chelper->get_categories_display_options());
        }
        $totalcount = $coursecat->get_children_count();
        if (!$totalcount) {
            // Note that we call core_course_category::get_children_count() AFTER core_course_category::get_children()
            // to avoid extra DB requests.
            // Categories count is cached during children categories retrieval.
            return '';
        }
        $content = '';
        $content .= '<div class="container">';
        $content .= '<div class="courses row courses_container">';

        // prepare content of paging bar or more link if it is needed
        $paginationurl = $chelper->get_categories_display_option('paginationurl');
        $paginationallowall = $chelper->get_categories_display_option('paginationallowall');
        if ($totalcount > count($subcategories)) {
            if ($paginationurl) {
                // the option 'paginationurl was specified, display pagingbar
                $perpage = $chelper->get_categories_display_option('limit', $CFG->coursesperpage);
                $page = $chelper->get_categories_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar($totalcount, $page, $perpage,
                        $paginationurl->out(false, array('perpage' => $perpage)));
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => 'all')),
                            get_string('showall', '', $totalcount)), array('class' => 'paging paging-showall'));
                }
            } else if ($viewmoreurl = $chelper->get_categories_display_option('viewmoreurl')) {
                // the option 'viewmoreurl' was specified, display more link (if it is link to category view page, add category id)
                if ($viewmoreurl->compare(new moodle_url('/course/index.php'), URL_MATCH_BASE)) {
                    $viewmoreurl->param('categoryid', $coursecat->id);
                }
                $viewmoretext = $chelper->get_categories_display_option('viewmoretext', new lang_string('viewmore'));
                $morelink = ' <div class="col-12 paging paging-morelink">
                              <div class="courses_all_btn text-center">
                                <a class="btn btn-transparent mt-3 mb-3" href="'.$viewmoreurl.'">'.$viewmoretext.'</a>
                              </div>
                            </div>';
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // there are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode
            $pagingbar = html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => $CFG->coursesperpage)),
                get_string('showperpage', '', $CFG->coursesperpage)), array('class' => 'paging paging-showperpage'));
        }

        foreach ($subcategories as $subcategory) {
            $content .= $this->coursecat_category($chelper, $subcategory, $depth + 1);
        }

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }
        if (!empty($morelink)) {
            $content .= $morelink;
        }

        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }
    /**
     * Displays one course in the list of courses.
     *
     * This is an internal function, to display an information about just one course
     * please use {@link core_course_renderer::course_info_box()}
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_list_element|stdClass $course
     * @param string $additionalclasses additional classes to add to the main <div> tag (usually
     *    depend on the course position in list - first/last/even/odd)
     * @return string
     */
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        $content = $this->coursecat_coursebox_content($chelper, $course);
        return $content;
    }

    /**
     * Returns HTML to display course content (summary, course contacts and optionally category name)
     *
     * This method is called from coursecat_coursebox() and may be re-used in AJAX
     *
     * @param coursecat_helper $chelper various display options
     * @param stdClass|core_course_list_element $course
     * @return string
     */
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        global $CFG, $PAGE;

        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }
        
        $content = '';
        $courseid = $course->id;

        $lomsCourseHandler = new lomsCourseHandler();
        $lomsCourse = $lomsCourseHandler->lomsGetCourseDetails($courseid);

        $contentimages = $contentfiles = '';
        $coursesummary = ($course->has_summary()) ? $chelper->get_course_formatted_summary($course) : '';
        $coursename = $chelper->get_course_formatted_name($course);
        $coursenamelink = new moodle_url('/course/view.php', array('id' => $course->id));
        $loms_context = context_course::instance($course->id);
        $numberofusers = count_enrolled_users($loms_context);
        $category = format_text($PAGE->category->name, FORMAT_HTML, array('filter' => true));

        // Display course contacts. See core_course_list_element::get_course_contacts().
        if ($course->has_course_contacts()) {
            $loms_course_contacts = '';
            foreach ($course->get_course_contacts() as $coursecontact) {
                $rolenames = array_map(function ($role) {
                    return $role->displayname;
                }, $coursecontact['roles']);
                $name = implode(", ", $rolenames).': '.
                        html_writer::link(new moodle_url('/user/view.php',
                                array('id' => $coursecontact['user']->id, 'course' => SITEID)),
                            $coursecontact['username']);
                $loms_course_contacts .= '<span class="loms_course_meta_item mr10">'.$name.'</span>';
            }
        }

        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimages .= '<img class="img-whp" src="'.$url.'" alt="'.$coursename.'">';
            }
        }

        // Get Teacher Name
        $teacher = '';
        foreach($lomsCourse->teachers as $teacher):
            $teacher = $teacher->name;
        endforeach;
         $contenttext = '';
         
         $lomsCourseDescription = strip_tags($lomsCourseHandler->lomsGetCourseDescription($course->id, 99999999999999));
         $lomsCourseDescription = substr($lomsCourseDescription, 0, 98);

         $contenttext .= '
            <div class="col-xl-3 col-md-6">
                <div class="single-courses">
                    <a href="'. $lomsCourse->url .'" class="d-block courses-img">
                        '.$lomsCourse->lomsRender->coverImage.'
                    </a>

                    <div class="courses-content">
                        <h3>
                            <a href="'. $lomsCourse->url .'">
                                '.$lomsCourse->fullName.'
                            </a>
                        </h3>

                        <ul class="star-price list-unstyled pl-0 d-flex justify-content-between align-items-center">
                            <li class="loms-course-date">'. $lomsCourse->lomsRender->updatedDate .'</li>
                            
                            <li>';
                            if($lomsCourse->course_price) {
                                $contenttext .= '
                                <span class="price">'.get_config('theme_loms', 'site_currency') .''.$lomsCourse->course_price.'</span>';
                            }else{
                                $contenttext .= '
                                <span class="price">'.get_config('theme_loms', 'free_course_price') .'</span>';
                            } $contenttext .= '
                            </li>
                        </ul>

                        <div class="d-flex align-items-center user">
                            <div class="flex-shrink-0">
                                <div class="icon">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="m-0">By <a href="'. $lomsCourse->url .'">
                                '.$teacher.'</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';  
        $content .= $contenttext. $contentfiles;
        return $content;
    }

    /**
     * Renders HTML to display particular course category - list of it's subcategories and courses
     *
     * Invoked from /course/index.php
     *
     * @param int|stdClass|core_course_category $category
     */
    public function course_category($category) {
        global $CFG;
        $usertop = core_course_category::user_top();
        if (empty($category)) {
            $coursecat = $usertop;
        } else if (is_object($category) && $category instanceof core_course_category) {
            $coursecat = $category;
        } else {
            $coursecat = core_course_category::get(is_object($category) ? $category->id : $category);
        }
        $site = get_site();
        $actionbar = new \core_course\output\category_action_bar($this->page, $coursecat);
        $output = $this->render_from_template('core_course/category_actionbar', $actionbar->export_for_template($this));

        if (core_course_category::is_simple_site()) {
            // There is only one category in the system, do not display link to it.
            $strfulllistofcourses = get_string('fulllistofcourses');
            $this->page->set_title("$site->shortname: $strfulllistofcourses");
        } else if (!$coursecat->id || !$coursecat->is_uservisible()) {
            $strcategories = get_string('categories');
            $this->page->set_title("$site->shortname: $strcategories");
        } else {
            $strfulllistofcourses = get_string('fulllistofcourses');
            $this->page->set_title("$site->shortname: $strfulllistofcourses");
        }

        // Print current category description
        $chelper = new coursecat_helper();
        if ($description = $chelper->get_category_formatted_description($coursecat)) {
            $output .= $this->box($description, array('class' => 'generalbox info'));
        }

        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_AUTO)
                ->set_attributes(array('class' => 'row category-browse category-browse-'.$coursecat->id));

        $coursedisplayoptions = array();
        $catdisplayoptions = array();
        $browse = optional_param('browse', null, PARAM_ALPHA);
        $perpage = optional_param('perpage', $CFG->coursesperpage, PARAM_INT);
        $page = optional_param('page', 0, PARAM_INT);
        $baseurl = new moodle_url('/course/index.php');
        if ($coursecat->id) {
            $baseurl->param('categoryid', $coursecat->id);
        }
        if ($perpage != $CFG->coursesperpage) {
            $baseurl->param('perpage', $perpage);
        }
        $coursedisplayoptions['limit'] = $perpage;
        $catdisplayoptions['limit'] = $perpage;
        if ($browse === 'courses' || !$coursecat->get_children_count()) {
            $coursedisplayoptions['offset'] = $page * $perpage;
            $coursedisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $catdisplayoptions['nodisplay'] = true;
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $catdisplayoptions['viewmoretext'] = new lang_string('viewallsubcategories');
        } else if ($browse === 'categories' || !$coursecat->get_courses_count()) {
            $coursedisplayoptions['nodisplay'] = true;
            $catdisplayoptions['offset'] = $page * $perpage;
            $catdisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $coursedisplayoptions['viewmoretext'] = new lang_string('viewallcourses');
        } else {
            // we have a category that has both subcategories and courses, display pagination separately
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses', 'page' => 1));
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories', 'page' => 1));
        }
        $chelper->set_courses_display_options($coursedisplayoptions)->set_categories_display_options($catdisplayoptions);

        // Display course category tree.
        $output .= $this->coursecat_tree($chelper, $coursecat);

        return $output;
    }
}