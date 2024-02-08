<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_about_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_about_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Become A Successful Instructor Of Our Community​';
            $this->config->body = 'Instructors from around the world teach millions of students on Loms. We provide the tools and skills to teach what you love. And you can also achieve your goal with us.';
            $this->config->btn = 'Start Teaching Today';
            $this->config->btn_link = $CFG->wwwroot .'/course';
            $this->config->video_title = 'Watch Video From The Leaders How Apply For Teaching';
            $this->config->video = 'https://www.youtube.com/watch?v=_aB9Tg6SRA0';
            $this->config->student_name = 'Magneta dsuza, ';
            $this->config->student_content = 'Loms Top Author';
            $this->config->class = 'successful-area bg-color-fdfdfd pt-100 pb-100';
            $this->config->shape_img = LOMS_IMG .'successful-shape.svg';
            $this->config->img = LOMS_IMG .'successful-img.webp';
            $this->config->video_img = LOMS_IMG .'successful.webp';
            $this->config->border_shape_img = LOMS_IMG .'border-shape-1.svg';
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

        $text = '';

        if($style == 2):
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="successful-content ml-70 wow animate__animated animate__fadeInLeft delay-0-8s">
                                <h2>'.$this->config->title.'</h2>
                                <p>'.$this->config->body.'</p>

                                <div class="single-successful d-flex align-items-center">
                                    <div class="successful-video-img flex-shrink-0">';
                                    if($this->config->video_img):
                                        $video_img = $this->config->video_img;
                                        $text .= '<img class="rounded-1" src="'.loms_block_image_process($video_img).'" alt="'.$this->config->video_title.'">';
                                    endif;
                                    $text .= '
                                        <a href="'.$this->config->video.'" class="video-btns popup-youtube">
                                            <i class="ri-play-circle-fill"></i>
                                        </a>
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
                                            '.$this->config->student_content.'
                                            </li>
                                        </ul>
                                    </div>
                                </div>';

                                if($this->config->btn): $text .= '
                                    <a href="'.$this->config->btn_link.'" class="default-btn"> '.$this->config->btn.'</a>'; 
                                endif;  $text .= '
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="successful-img wow animate__animated animate__fadeInRight delay-0-8s">';
                                if($this->config->img):
                                    $img = $this->config->img;
                                    $text .= '
                                    <img src="'.loms_block_image_process($img).'" alt="'.$this->config->title.'">';
                                endif;
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>';
                if($this->config->border_shape_img):
                    $border_shape_img = $this->config->border_shape_img;
                    $text .= '<img src="'.loms_block_image_process($border_shape_img).'" class="border-shape" alt="'.$this->config->video_title.'">';
                endif;

                if($this->config->shape_img):
                    $shape_img = $this->config->shape_img;
                    $text .= '<img src="'.loms_block_image_process($shape_img).'" class="shape shape-1" alt="'.$this->config->video_title.'">';
                endif;
                $text .= '
            </div>';
        else:
            $text .= '
            <div class="'.$this->config->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="successful-img wow animate__animated animate__fadeInLeft delay-0-8s">';
                                if($this->config->img):
                                    $img = $this->config->img;
                                    $text .= '
                                    <img src="'.loms_block_image_process($img).'" alt="'.$this->config->title.'">';
                                endif;
                                $text .= '
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="successful-content ml-70 wow animate__animated animate__fadeInRight delay-0-8s">
                                <h2>'.$this->config->title.'</h2>
                                <p>'.$this->config->body.'</p>

                                <div class="single-successful d-flex align-items-center">
                                    <div class="successful-video-img flex-shrink-0">';
                                    if($this->config->video_img):
                                        $video_img = $this->config->video_img;
                                        $text .= '<img class="rounded-1" src="'.loms_block_image_process($video_img).'" alt="'.$this->config->video_title.'">';
                                    endif;
                                    $text .= '
                                        <a href="'.$this->config->video.'" class="video-btns popup-youtube">
                                            <i class="ri-play-circle-fill"></i>
                                        </a>
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
                                            '.$this->config->student_content.'
                                            </li>
                                        </ul>
                                    </div>
                                </div>';

                                if($this->config->btn): $text .= '
                                    <a href="'.$this->config->btn_link.'" class="default-btn"> '.$this->config->btn.'</a>'; 
                                endif;  $text .= '
                            </div>
                        </div>
                    </div>
                </div>';
                if($this->config->border_shape_img):
                    $border_shape_img = $this->config->border_shape_img;
                    $text .= '<img src="'.loms_block_image_process($border_shape_img).'" class="border-shape" alt="'.$this->config->video_title.'">';
                endif;

                if($this->config->shape_img):
                    $shape_img = $this->config->shape_img;
                    $text .= '<img src="'.loms_block_image_process($shape_img).'" class="shape shape-1" alt="'.$this->config->video_title.'">';
                endif;
                $text .= '
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