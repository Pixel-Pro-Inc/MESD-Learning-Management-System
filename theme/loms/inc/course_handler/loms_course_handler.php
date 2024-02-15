<?php
/*
* COURSE HANDLER
*/

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot. '/course/renderer.php');
include_once($CFG->dirroot . '/course/lib.php');

class lomsCourseHandler {
    public function lomsGetCourseDetails($courseId) {
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;


        $courseId = (int)$courseId;
        if ($DB->record_exists('course', array('id' => $courseId))) {
        // @lomsComm: Initiate
        $lomsCourse = new \stdClass();
        $chelper = new coursecat_helper();
        $courseContext = context_course::instance($courseId);

        $courseRecord = $DB->get_record('course', array('id' => $courseId));
        $courseElement = new core_course_list_element($courseRecord);

        /* @lomsBreak */
        $courseId = $courseRecord->id;
        $courseShortName = $courseRecord->shortname;
        $courseFullName = $courseRecord->fullname;
        $courseSummary = $chelper->get_course_formatted_summary($courseElement, array('noclean' => true, 'para' => false));
        $courseFormat = $courseRecord->format;
        $courseAnnouncements = $courseRecord->newsitems;
        $courseStartDate = $courseRecord->startdate;
        $courseEndDate = $courseRecord->enddate;
        $courseVisible = $courseRecord->visible;
        $courseCreated = $courseRecord->timecreated;
        $courseUpdated = $courseRecord->timemodified;
        $courseRequested = $courseRecord->requested;
        $courseEnrolmentCount = count_enrolled_users($courseContext);
        $course_is_enrolled = is_enrolled($courseContext, $USER->id, '', true);

        /* @lomsBreak */
        $categoryId = $courseRecord->category;

        try {
            $courseCategory = core_course_category::get($categoryId);
            $categoryName = $courseCategory->get_formatted_name();
            $categoryUrl = $CFG->wwwroot . '/course/index.php?categoryid='.$categoryId;
        } catch (Exception $e) {
            $courseCategory = "";
            $categoryName = "";
            $categoryUrl = "";
        }

        /* @lomsBreak */
        $enrolmentLink = $CFG->wwwroot . '/enrol/index.php?id=' . $courseId;
        $courseUrl = new moodle_url('/course/view.php', array('id' => $courseId));
        // @lomsComm: Start Payment
        $enrolInstances = enrol_get_instances($courseId, true);

        $course_price = '';
        $course_currency = '';
        foreach($enrolInstances as $singleenrolInstances){
            if($singleenrolInstances->enrol == 'paypal'){
                $course_price = $singleenrolInstances->cost;
                $course_currency = $singleenrolInstances->currency;
            }elseif($singleenrolInstances->enrol == 'fee'){
                $course_price = $singleenrolInstances->cost;
                $course_currency = $singleenrolInstances->currency;
            }else{
                $course_price = '';
                $course_currency = '';
            }
        }
        

        $lomsArrayOfCosts = array();
            $lomsCourseContacts = array();
            if ($courseElement->has_course_contacts()) {
                foreach ($courseElement->get_course_contacts() as $key => $courseContact) {
                $lomsCourseContacts[$key] = new \stdClass();
                $lomsCourseContacts[$key]->userId = $courseContact['user']->id;
                $lomsCourseContacts[$key]->username = $courseContact['user']->username;
                $lomsCourseContacts[$key]->name = $courseContact['user']->firstname . ' ' . $courseContact['user']->lastname;
                $lomsCourseContacts[$key]->role = $courseContact['role']->displayname;
                $lomsCourseContacts[$key]->profileUrl = new moodle_url('/user/view.php', array('id' => $courseContact['user']->id, 'course' => SITEID));
                }
            }


        // @lomsComm: Process first image
        $contentimages = $contentfiles = $CFG->wwwroot . '/theme/loms/images/lomsBg.png';
        foreach ($courseElement->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("{$CFG->wwwroot}/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimages = $url;
            } else {
                $contentfiles = $CFG->wwwroot . '/theme/loms/images/lomsBg.png';
            }
        }

        /* Map data */
        $lomsCourse->courseId = $courseId;
        $lomsCourse->enrolments = $courseEnrolmentCount;
        $lomsCourse->categoryId = $categoryId;
        $lomsCourse->categoryName = $categoryName;
        $lomsCourse->categoryUrl = $categoryUrl;
        $lomsCourse->shortName = $courseShortName;
        $lomsCourse->fullName = format_text($courseFullName, FORMAT_HTML, array('filter' => true));
        $lomsCourse->summary = $courseSummary;
        $lomsCourse->imageUrl = $contentimages;
        $lomsCourse->format = $courseFormat;
        $lomsCourse->announcements = $courseAnnouncements;
        $lomsCourse->startDate = userdate($courseStartDate, get_string('strftimedatefullshort', 'langconfig'));
        $lomsCourse->endDate = userdate($courseEndDate, get_string('strftimedatefullshort', 'langconfig'));
        $lomsCourse->visible = $courseVisible;
        $lomsCourse->created = userdate($courseCreated, get_string('strftimedatefullshort', 'langconfig'));
        $lomsCourse->updated = userdate($courseUpdated, get_string('strftimedatefullshort', 'langconfig'));
        $lomsCourse->requested = $courseRequested;
        $lomsCourse->enrolmentLink = $enrolmentLink;
        $lomsCourse->url = $courseUrl;
        $lomsCourse->teachers = $lomsCourseContacts;
        $lomsCourse->course_price = $course_price;
        $lomsCourse->course_currency = $course_currency;
        $lomsCourse->course_is_enrolled = $course_is_enrolled;

        /* Render object */
        $lomsRender = new \stdClass();
        $lomsRender->enrolmentIcon = '';
        $lomsRender->enrolmentIcon1 = '';
        $lomsRender->announcementsIcon     =     '';
        $lomsRender->announcementsIcon1     =     '';
        $lomsRender->updatedDate           =     '';
        $lomsRender->updatedDate         =     userdate($courseUpdated, get_string('strftimedatefullshort', 'langconfig'));
        $lomsRender->title             =     '<h3><a href="'. $lomsCourse->url .'">'. $lomsCourse->fullName .'</a></h3>';
        $lomsRender->coverImage        =     '<img class="img-whp" src="'. $contentimages .'" alt="'.$lomsCourse->fullName.'">';
        $lomsRender->ImageUrl = $contentimages;
        /* @lomsBreak */
        $lomsCourse->lomsRender = $lomsRender;
        return $lomsCourse;
        }
        return null;
    }

    public function lomsGetCourseDescription($courseId, $maxLength){
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;
    
        if ($DB->record_exists('course', array('id' => $courseId))) {
        $chelper = new coursecat_helper();
        $courseContext = context_course::instance($courseId);
    
        $courseRecord = $DB->get_record('course', array('id' => $courseId));
        $courseElement = new core_course_list_element($courseRecord);
    
        if ($courseElement->has_summary()) {
            $courseSummary = $chelper->get_course_formatted_summary($courseElement, array('noclean' => false, 'para' => false));
            if($maxLength != null) {
            if (strlen($courseSummary) > $maxLength) {
                $courseSummary = wordwrap($courseSummary, $maxLength);
                $courseSummary = substr($courseSummary, 0, strpos($courseSummary, "\n")) . '...';
            }
            }
            return $courseSummary;
        }
    
        }
        return null;
    }

    public function lomsListCategories(){
        global $DB, $CFG;
        $topcategory = core_course_category::top();
        $topcategorykids = $topcategory->get_children();
        $areanames = array();
        foreach ($topcategorykids as $areaid => $topcategorykids) {
            $areanames[$areaid] = $topcategorykids->get_formatted_name();
            foreach($topcategorykids->get_children() as $k=>$child){
                $areanames[$k] = $child->get_formatted_name();
            }
        }
        return $areanames;
    }

    public function lomsGetCategoryDetails($categoryId){
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;
    
        if ($DB->record_exists('course_categories', array('id' => $categoryId))) {
    
        $categoryRecord = $DB->get_record('course_categories', array('id' => $categoryId));
    
        $chelper = new coursecat_helper();
        $categoryObject = core_course_category::get($categoryId);
    
        $lomsCategory = new \stdClass();
    
        $categoryId = $categoryRecord->id;
        $categoryName = format_text($categoryRecord->name, FORMAT_HTML, array('filter' => true));
        $categoryDescription = $chelper->get_category_formatted_description($categoryObject);
    
        $categorySummary = format_string($categoryRecord->description, $striplinks = true,$options = null);
        $isVisible = $categoryRecord->visible;
        $categoryUrl = $CFG->wwwroot . '/course/index.php?categoryid=' . $categoryId;
        $categoryCourses = $categoryObject->get_courses();
        $categoryCoursesCount = count($categoryCourses);
    
        $categoryGetSubcategories = [];
        $categorySubcategories = [];
        if (!$chelper->get_categories_display_option('nodisplay')) {
            $categoryGetSubcategories = $categoryObject->get_children($chelper->get_categories_display_options());
        }
        foreach($categoryGetSubcategories as $k=>$lomsSubcategory) {
            $lomsSubcat = new \stdClass();
            $lomsSubcat->id = $lomsSubcategory->id;
            $lomsSubcat->name = $lomsSubcategory->name;
            $lomsSubcat->description = $lomsSubcategory->description;
            $lomsSubcat->depth = $lomsSubcategory->depth;
            $lomsSubcat->coursecount = $lomsSubcategory->coursecount;
            $categorySubcategories[$lomsSubcategory->id] = $lomsSubcat;
        }
    
        $categorySubcategoriesCount = count($categorySubcategories);
    
        /* Do image */
        $outputimage = '';
        //lomsComm: Fetching the image manually added to the coursecat description via the editor.
        $description = $chelper->get_category_formatted_description($categoryObject);
        $src = "";
        if ($description) {
            $dom = new DOMDocument();
            $dom->loadHTML($description);
            $xpath = new DOMXPath($dom);
            $src = $xpath->evaluate("string(//img/@src)");
        }
        if ($src && $description){
            $outputimage = $src;
        } else {
            foreach($categoryCourses as $child_course) {
            if ($child_course === reset($categoryCourses)) {
                foreach ($child_course->get_course_overviewfiles() as $file) {
                    if ($file->is_valid_image()) {
                        $imagepath = '/' . $file->get_contextid() . '/' . $file->get_component() . '/' . $file->get_filearea() . $file->get_filepath() . $file->get_filename();
                        $imageurl = file_encode_url($CFG->wwwroot . '/pluginfile.php', $imagepath, false);
                        $outputimage  =  $imageurl;
                        // Use the first image found.
                        break;
                    }
                }
            }
            }
        }
    
        /* Map data */
        $lomsCategory->categoryId = $categoryId;
        $lomsCategory->categoryName = $categoryName;
        $lomsCategory->categoryDescription = $categoryDescription;
        $lomsCategory->categorySummary = $categorySummary;
        $lomsCategory->isVisible = $isVisible;
        $lomsCategory->categoryUrl = $categoryUrl;
        $lomsCategory->coverImage = $outputimage;
        $lomsCategory->ImageUrl = $outputimage;
        $lomsCategory->courses = $categoryCourses;
        $lomsCategory->coursesCount = $categoryCoursesCount;
        $lomsCategory->subcategories = $categorySubcategories;
        $lomsCategory->subcategoriesCount = $categorySubcategoriesCount;
        return $lomsCategory;
    
        }
    }

    public function lomsGetExampleCategories($maxNum) {
        global $CFG, $DB;
    
        $lomsCategories = $DB->get_records('course_categories', array(), $sort='', $fields='*', $limitfrom=0, $limitnum=$maxNum);
    
        $lomsReturn = array();
        foreach ($lomsCategories as $lomsCategory) {
        $lomsReturn[] = $this->lomsGetCategoryDetails($lomsCategory->id);
        }
        return $lomsReturn;
    }

    public function lomsGetExampleCategoriesIds($maxNum) {
        global $CFG, $DB;
    
        $lomsCategories = $this->lomsGetExampleCategories($maxNum);
    
        $lomsReturn = array();
        foreach ($lomsCategories as $key => $lomsCategory) {
        $lomsReturn[] = $lomsCategory->categoryId;
        }
        return $lomsReturn;
    }
}
