<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_about_courses extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_about_courses');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->class = 'transform-area overflow-hidden ove pt-100 pb-60 bg-color-fdfdfd​';
            $this->config->title = 'Built To Empower Every Instructor​';
            $this->config->body = 'Instructors from around the world teach millions of students on Loms. We provide the tools and skills to teach what you love. And you can also achieve your goal with us..';
            $this->config->btn = 'Find Out How';
            $this->config->btn_link = $CFG->wwwroot .'/course';
            $this->config->video_title = 'Watch Video From the Community How Loms Change Their Life';
            $this->config->video = 'https://www.youtube.com/watch?v=_aB9Tg6SRA0';
            $this->config->student_name = 'Victor james';
            $this->config->student_content = 'Loms’s Student';
            $this->config->video_img =  LOMS_IMG .'transform.webp';
            $this->config->style = 1;
        }
    }

    public function get_content() {
        global $CFG, $DB;

        if ($this->content !== null) {
          return $this->content;
        }
        $this->content         =  new stdClass;
        
        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }
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
        if($style == 2):
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="empower-grid">
                                <div class="row align-items-center">';
                                    if(!empty($this->config->courses)){
                                        $chelper = new coursecat_helper();
                                        $total_courses = count($coursesArr);
                                        $counter = 0;
                                        foreach ($courses as $course) {
                                            if ($DB->record_exists('course', array('id' => $course->id))) {
                                                $lomsCourseHandler = new lomsCourseHandler();
                                                $lomsCourse = $lomsCourseHandler->lomsGetCourseDetails($course->id);
                
                                                // Get Teacher Name
                                                foreach($lomsCourse->teachers as $teacher):
                                                    $teacher = $teacher->name;
                                                endforeach;
                
                                                $lomsCourseDescription = strip_tags($lomsCourseHandler->lomsGetCourseDescription($course->id, 99999999999999));
                                                $lomsCourseDescription = implode(' ', array_slice(str_word_count($lomsCourseDescription, 2), 0, 15));
                                                if ($counter % 3 == 0) {
                                                    $text .= '<div class="col-lg-6">';
                                                }
                                                if ($counter % 3 == 0) { 
                                                    $text .= '  
                                                    <div class="single-courses grid-style wow animate__animated animate__zoomIn delay-0-2s">
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
                                                } elseif ($counter % 3 == 1) {
                                                    $text .= '  
                                                    <div class="single-courses grid-style active wow animate__animated animate__zoomIn delay-0-2s">
                                                        <div class="courses-content mt-0">
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
                                                }else{
                                                    $text .= '  
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-courses grid-style wow animate__animated animate__zoomIn delay-0-2s">
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
                                                        </div>
                                                    </div>';
                                                }
                                                $counter++;
                                            }
                                        }
                                        if ($counter % 3 != 0) {
                                            // If the last group is incomplete, close the div tag
                                            echo '</div>';
                                        }
                                    }
                                    $text .= '
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
						    <div class="successful-content ml-70 wow animate__animated animate__fadeInRight delay-0-8s">
                                <h2>'.$this->config->title.'</h2>
                                <p>'.$this->config->body.'</p>';

                                if($this->config->video_title):
                                    $text .= '
                                    <div class="single-successful d-flex align-items-center">
                                        <div class="successful-video-img flex-shrink-0">';
                                            if($this->config->video_img):
                                                $text .= '<img src="'.loms_block_image_process($this->config->video_img).'" alt="'.$this->config->video_title.'">';
                                            endif;
                                            
                                            if($this->config->video):
                                                $text .= '
                                                <a href="'.$this->config->video.'" class="video-btns popup-youtube">
                                                    <i class="ri-play-circle-fill"></i>
                                                </a>';
                                            endif;
                                            $text .= '
                                        </div>

                                        <div class="successful-video-content flex-grow-1">
                                            <h3>
                                                <a href="'.$this->config->video.'" class="popup-youtube">'.$this->config->video_title.'</a>
                                            </h3>
                                            <ul>
                                                <li>
                                                    <div class="active">'.$this->config->student_name.'</div>
                                                </li>
                                                <li>
                                                    <span>'.$this->config->student_content.'</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';

                                    if($this->config->btn): $text .= '
                                        <a href="'.$this->config->btn_link.'" class="default-btn"> '.$this->config->btn.'</a>'; 
                                    endif;  
                                endif;  
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        else:
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="successful-content mr-70 wow animate__animated animate__fadeInLeft delay-0-8s">
                                <h2>'.$this->config->title.'</h2>
                                <p>'.$this->config->body.'</p>';

                                if($this->config->video_title):
                                    $text .= '
                                    <div class="single-successful d-flex align-items-center">
                                        <div class="successful-video-img flex-shrink-0">';
                                            if($this->config->video_img):
                                                $text .= '<img src="'.loms_block_image_process($this->config->video_img).'" alt="'.$this->config->video_title.'">';
                                            endif;
                                            
                                            if($this->config->video):
                                                $text .= '
                                                <a href="'.$this->config->video.'" class="video-btns popup-youtube">
                                                    <i class="ri-play-circle-fill"></i>
                                                </a>';
                                            endif;
                                            $text .= '
                                        </div>

                                        <div class="successful-video-content flex-grow-1">
                                            <h3>
                                                <a href="'.$this->config->video.'" class="popup-youtube">'.$this->config->video_title.'</a>
                                            </h3>
                                            <ul>
                                                <li>
                                                    <div class="active">'.$this->config->student_name.'</div>
                                                </li>
                                                <li>
                                                    <span>'.$this->config->student_content.'</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';

                                    if($this->config->btn): $text .= '
                                        <a href="'.$this->config->btn_link.'" class="default-btn"> '.$this->config->btn.'</a>'; 
                                    endif;  
                                endif;  
                                $text .= '
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="empower-grid">
                                <div class="row align-items-center">';
                                    if(!empty($this->config->courses)){
                                        $chelper = new coursecat_helper();
                                        $total_courses = count($coursesArr);
                                        $counter = 0;
                                        foreach ($courses as $course) {
                                            if ($DB->record_exists('course', array('id' => $course->id))) {
                                                $lomsCourseHandler = new lomsCourseHandler();
                                                $lomsCourse = $lomsCourseHandler->lomsGetCourseDetails($course->id);
                
                                                // Get Teacher Name
                                                foreach($lomsCourse->teachers as $teacher):
                                                    $teacher = $teacher->name;
                                                endforeach;
                
                                                $lomsCourseDescription = strip_tags($lomsCourseHandler->lomsGetCourseDescription($course->id, 99999999999999));
                                                $lomsCourseDescription = implode(' ', array_slice(str_word_count($lomsCourseDescription, 2), 0, 15));
                                                if ($counter % 3 == 0) {
                                                    $text .= '<div class="col-lg-6">';
                                                }
                                                if ($counter % 3 == 0) { 
                                                    $text .= '  
                                                    <div class="single-courses grid-style wow animate__animated animate__zoomIn delay-0-2s">
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
                                                } elseif ($counter % 3 == 1) {
                                                    $text .= '  
                                                    <div class="single-courses grid-style active wow animate__animated animate__zoomIn delay-0-2s">
                                                        <div class="courses-content mt-0">
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
                                                }else{
                                                    $text .= '  
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-courses grid-style wow animate__animated animate__zoomIn delay-0-2s">
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
                                                        </div>
                                                    </div>';
                                                }
                                                $counter++;
                                            }
                                        }
                                        if ($counter % 3 != 0) {
                                            // If the last group is incomplete, close the div tag
                                            echo '</div>';
                                        }
                                    }
                                    $text .= '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        endif;
        $this->content         =  new stdClass;
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    /**
     * The block can be used repeatedly in a page.
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
        return true;
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