<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/course_handler/loms_course_handler.php');
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_categories extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_categories');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $lomsCourseHandler = new lomsCourseHandler();
            $lomsCategories = $lomsCourseHandler->lomsGetExampleCategoriesIds(8);
            $this->config = new \stdClass();
            $this->config->class            = 'categories-area pb-100';
            $this->config->title            = 'Unlimited Access To <span>400+</span> Courses And <span>1,800+</span> Hands-On Labs';
            $this->config->img1 = LOMS_IMG.'categories/categories-1.svg';
            $this->config->img2 = LOMS_IMG.'categories/categories-2.svg';
            $this->config->img3 = LOMS_IMG.'categories/categories-3.svg';
            $this->config->img4 = LOMS_IMG.'categories/categories-4.svg';
            $this->config->img5 = LOMS_IMG.'categories/categories-5.svg';
            $this->config->img6 = LOMS_IMG.'categories/categories-6.svg';
            $this->config->img7 = LOMS_IMG.'categories/categories-7.svg';
            $this->config->img8 = LOMS_IMG.'categories/categories-8.svg';
            $this->config->shape_img1  = LOMS_IMG .'categories-shape.svg';
            $this->config->img  = LOMS_IMG .'border-shape-4.svg';
            $this->config->shape_class  = 'borer text-center';
            $this->config->body  = 'Browse All Different <a href="#">124+ Categories <img src="'.LOMS_IMG.'icon/arrow-rights.svg"></a>';
        }
    }

    public function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        if (isset($this->config->items)) {
            $data = $this->config;
            $data->items = is_numeric($data->items) ? (int)$data->items : 5;
        } else {
            $data = new stdClass();
            $data->items = '0';
        }

        $this->content         =  new stdClass;

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        $text = '';
        $text .= '
        <div class="'.$this->config->class.'">
            <div class="container">
                <div class="section-title">
                    <h2>'.$this->config->title.'</h2>
                </div>

                <div class="row justify-content-center">';
                    $topcategory = core_course_category::top();
                    
                    if ($data->items > 0) {
                        for ($i = 1; $i <= $data->items; $i++) {
                            $img            = 'img' . $i;
                            $categoryID     = 'category' . $i;
                            $category       = $DB->get_record('course_categories',array('id' => $data->$categoryID));

                            // Image
                            if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                            if ($DB->record_exists('course_categories', array('id' => $data->$categoryID))) {
                                $chelper = new coursecat_helper();
                                $categoryID = $category->id;
                                $category = core_course_category::get($categoryID);
                                $categoryname = $category->get_formatted_name();
                                $text .= '
                                <div class="col-lg-3 col-sm-6 col-md-4">
                                    <a href="'.$CFG->wwwroot .'/course/index.php?categoryid='.$categoryID.'" class="single-categories d-block wow animate__animated animate__fadeInLeft delay-0-2s">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="icon">';
                                                    if($img):
                                                        $text .= '
                                                            <img src="'.loms_block_image_process($img).'" alt="'.$categoryname.'">';
                                                    endif;
                                                    $text .= '
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-4">
                                                <h3 class="m-0">'.$categoryname.'</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                            }
                        }
                    }
                    $text .= '

                    <div class="col-lg-12">
                        <p class="text-center browse-all-btn">
                            '.$this->config->body.'
                        </p>
                    </div>
                </div>
            </div>';
            if($this->config->shape_img1):
                $text .= '
                <img src="'.loms_block_image_process($this->config->shape_img1).'" class="shape shape-1" alt="'.strip_tags($this->config->title).'">';
            endif;
            $text .= '
        </div>';

        if($this->config->img):
            $text .= '
            <div class="'.$this->config->shape_class.'">
                <div class="container">
                    <img src="'.loms_block_image_process($this->config->img).'" alt="'.strip_tags($this->config->title).'" class="border-shape text-center">
                </div>
            </div>';
        endif;
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    function instance_allow_config() {
        return true;
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