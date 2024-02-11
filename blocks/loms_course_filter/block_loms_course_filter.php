<?php
require_once($CFG->dirroot. '/course/renderer.php');
require_once($CFG->dirroot . '/theme/loms/inc/course_handler/loms_course_handler.php');
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
global $CFG;
class block_loms_course_filter extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_course_filter');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->class = 'selection-courses-area row-space pb-50';
            $this->config->title = 'A Broad Selection Of Courses';
            $this->config->content = 'Choose From 183,000 Online Video Courses With New Additions Published Every Month';
            $this->config->total_student_title = 'Students';
            $this->config->btn = 'View Courses';
            $this->config->link = '#';
            $this->config->img  = LOMS_IMG .'border-shape-4.svg';
            $this->config->shape_class  = 'borer text-center pb-100g';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        $categories = array();
        if(!empty($this->config->courses)){
            $coursesArr = $this->config->courses;
            $courses = new stdClass();
            foreach ($coursesArr as $key => $course) {
                $courseObj = new stdClass();
                $courseObj->id = $course;
                $courseRecord = $DB->get_record('course', array('id' => $courseObj->id), 'category');
                $courseCategory = $DB->get_record('course_categories',array('id' => $courseRecord->category));
                $courseCategory = core_course_category::get($courseCategory->id);
                $courseObj->category = $courseCategory->id;
                $courseObj->category_name = $courseCategory->get_formatted_name();
                $courses->$course = $courseObj;
            }
            $categories = array();
            foreach ($courses as $key => $course) {
                $categories[$course->category] = $course->category_name;
            }
            $categories = array_unique($categories);
        }
        $text = '';

        $text .= '
        <div class="'.$this->config->class.'">
			<div class="container">
				<div class="d-lg-flex d-md-block align-items-center justify-content-between">
					<div class="section-title left-title">
						<h2>'.$this->config->title.'</h2>
						<p>'.$this->config->content.'</p>
					</div>

					<div class="nav nav-tabs selection-courses-tab">';
                        if($this->config->btn):
                            $text .= '
                            <a href="'.$this->config->link.'" class="default-btn">
                                '.$this->config->btn.'
                            </a>';
                        endif;
                        $text .= '
					</div>
				</div>
			</div>

            <div class="container-fluid">
                <div class="owl-carousel owl-theme selection-courses-slide">';
                    if(!empty($this->config->courses)){
                        $chelper = new coursecat_helper();
                        $total_courses = count($coursesArr);
                        foreach ($courses as $course) {
                            if ($DB->record_exists('course', array('id' => $course->id))) {
                                $lomsCourseHandler = new lomsCourseHandler();
                                $lomsCourse = $lomsCourseHandler->lomsGetCourseDetails($course->id);
                                // Get Teacher Name
                                foreach($lomsCourse->teachers as $teacher):
                                    $teacher = $teacher->name;
                                endforeach;
                                $text .= '
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
                                                $text .= '
                                                <span class="price">'.get_config('theme_loms', 'site_currency') .''.$lomsCourse->course_price.'</span>';
                                            }else{
                                                $text .= '
                                                <span class="price">'.get_config('theme_loms', 'free_course_price') .'</span>';
                                            } $text .= '
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
                                </div>';
                            }
                        }
                    }
                    $text .= '
                </div>
            </div>
        </div>';

        if($this->config->img):
            $text .= '
            <div class="'.$this->config->shape_class.'">
			    <div class="container">
                    <img src="'.loms_block_image_process($this->config->img).'"alt="'.strip_tags($this->config->title).'" class="border-shape text-center">
                </div>
            </div>';
        endif;
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    /**
     * The block can be used repeatloms in a page.
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return false;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    function applicable_formats() {
        return array(
            'all' => true,
            'my' => false,
            'admin' => false,
            'course-view' => true,
            'course' => true,
        );
    }

}