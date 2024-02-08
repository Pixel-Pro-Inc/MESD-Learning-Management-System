<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_instructor_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_instructor_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Classes Taught By Real Creators';
            $this->config->body = 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.';
     
            $this->config->instructor_name1 = 'William James';
            $this->config->instructor_designation1 = 'Full Stack Developer';
            $this->config->instructor_img1 = LOMS_IMG .'instructor/instructor-1.webp';

            $this->config->instructor_name2 = 'Sally Welch';
            $this->config->instructor_designation2 = 'Art Director';
            $this->config->instructor_img2 = LOMS_IMG .'instructor/instructor-2.webp';

            $this->config->instructor_name3 = 'Willie Mcdonagh';
            $this->config->instructor_designation3 = 'Photographer';
            $this->config->instructor_img3 = LOMS_IMG .'instructor/instructor-3.webp';

            $this->config->instructor_name4 = 'Jesse Joslin';
            $this->config->instructor_designation4 = 'Content Strategist';
            $this->config->instructor_img4 = LOMS_IMG .'instructor/instructor-4.webp';

            $this->config->instructor_name5 = 'Jennifer Waston';
            $this->config->instructor_designation5 = 'Web Developer';
            $this->config->instructor_img5 = LOMS_IMG .'instructor/instructor-5.webp';
            $this->config->border_img = '';
            $this->config->class = 'instructor-area ptb-100';
            $this->config->style = 1;
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $itemNumber = 5;
        if(isset($this->config->itemNumber)){
            $itemNumber = $this->config->itemNumber;
        }

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        $text = '';
        if($style == 2):
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="section-title">
                    <h2 class="mb-0">'.$this->config->title.'</h2>
                        <p>'.$this->config->body.'</p>
                    </div>

                    <div class="row row-space justify-content-center">';
                        for($i = 1; $i <= $itemNumber; $i++) {
                            $instructor_name         = 'instructor_name' . $i;
                            $instructor_designation  = 'instructor_designation' . $i;
                            $instructor_img          = 'instructor_img' . $i;

                            if(isset($this->config->$instructor_name)) { $instructor_name = $this->config->$instructor_name; }else{ $instructor_name = ''; }

                            if(isset($this->config->$instructor_designation)) { $instructor_designation = $this->config->$instructor_designation; }else{ $instructor_designation = ''; }

                            if(isset($this->config->$instructor_img)) { $instructor_img = $this->config->$instructor_img; }else{ $instructor_img = ''; }
                            $text .= '
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-instructor me-0 mt-0 ms-0">';
                                        if($instructor_img):
                                            $text .= '
                                            <img src="'.loms_block_image_process($instructor_img).'" alt="'.$instructor_name.'">';
                                        endif;
                                        $text .= '
                                        <ul class="instructor-info">
                                            <li>
                                                <h3>'.$instructor_name.'</h3>
                                                <span>'.$instructor_designation.'</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>';
                        } $text .= '
                    </div>
                </div>
            </div>';
        else:
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="section-title">
                    <h2 class="mb-0">'.$this->config->title.'</h2>
                        <p>'.$this->config->body.'</p>
                    </div>

                    <div class="owl-carousel owl-theme instructor-slide">';
                        for($i = 1; $i <= $itemNumber; $i++) {
                            $instructor_name         = 'instructor_name' . $i;
                            $instructor_designation  = 'instructor_designation' . $i;
                            $instructor_img          = 'instructor_img' . $i;

                            if(isset($this->config->$instructor_name)) { $instructor_name = $this->config->$instructor_name; }else{ $instructor_name = ''; }

                            if(isset($this->config->$instructor_designation)) { $instructor_designation = $this->config->$instructor_designation; }else{ $instructor_designation = ''; }

                            if(isset($this->config->$instructor_img)) { $instructor_img = $this->config->$instructor_img; }else{ $instructor_img = ''; }
                            $text .= '
                                <div class="single-instructor">';
                                    if($instructor_img):
                                        $text .= '
                                        <img src="'.loms_block_image_process($instructor_img).'" alt="'.$instructor_name.'">';
                                    endif;
                                    $text .= '
                                    <ul class="instructor-info">
                                        <li>
                                            <h3>'.$instructor_name.'</h3>
                                            <span>'.$instructor_designation.'</span>
                                        </li>
                                    </ul>
                                </div>';
                        } $text .= '
                    </div>
                </div>
            </div>';
        endif;

        if($this->config->border_img):
            $text .= '
            <div class="borer text-center">
			    <div class="container">
                    <img src="'.loms_block_image_process($this->config->border_img).'" class="border-shape text-center">
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