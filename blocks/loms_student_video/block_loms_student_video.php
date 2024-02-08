<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_student_video extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_student_video');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->class = 'testimonials-area pt-100 pb-70';
            $this->config->title = 'Student All Over The World Love LOMS';
            $this->config->img1            = LOMS_IMG .'testimonials/testimonials-1.webp';
            $this->config->img2            = LOMS_IMG .'testimonials/testimonials-2.webp';
            $this->config->flag1            = LOMS_IMG .'testimonials/flag-1.webp';
            $this->config->flag2            = LOMS_IMG .'testimonials/flag-1.webp';
            $this->config->sm_img1            = LOMS_IMG .'testimonials/thumb/testimonials-1.webp';
            $this->config->sm_img2            = LOMS_IMG .'testimonials/thumb/testimonials-2.webp';
            $this->config->slider_name1         = 'Victor James';
            $this->config->slider_designation1  = 'Solit IT Solution';
            $this->config->slider_name2         = 'Alex Dew';
            $this->config->slider_designation2  = 'Student Captain';
            $this->config->slider_video1  = 'https://www.youtube.com/watch?v=_aB9Tg6SRA0';
            $this->config->slider_video2  = 'https://www.youtube.com/watch?v=_aB9Tg6SRA0';
            $this->config->border_img = '';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $sliderNumber = 2;
        if(isset($this->config->sliderNumber)){
            $sliderNumber = $this->config->sliderNumber;
        }

        $text = '';
        $text .= '
        <section class="'.$this->config->class.'">
            <div class="container-fluid">
                <div class="section-title w-550">
                    <h2>'.$this->config->title.'</h2>
                </div>

                <!-- Start Carousel Thumbs -->
                <div class="thumbs-wrap">
                    <div class="testimonials-inner">
                        <div class="testimonials-slide owl-theme owl-carousel" data-slider-id="1">';
                            for($i = 1; $i <= $sliderNumber; $i++) {
                                $img                    = 'img' . $i;
                                $sm_img                 = 'sm_img' . $i;
                                $flag                 	= 'flag' . $i;
                                $slider_name            = 'slider_name' . $i;
                                $slider_designation     = 'slider_designation' . $i;
                                $slider_video     		= 'slider_video' . $i;

                                // Image
                                if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                                // Small Image
                                if(isset($this->config->$sm_img)) { $sm_img = $this->config->$sm_img; }else{ $sm_img = ''; }

                                // Flag Image
                                if(isset($this->config->$flag)) { $flag = $this->config->$flag; }else{ $flag = ''; }

                                // Name
                                if(isset($this->config->$slider_name)) { $slider_name = $this->config->$slider_name; }else{ $slider_name = ''; }

                                // Slider Video
                                if(isset($this->config->$slider_video)) { $slider_video = $this->config->$slider_video; }else{ $slider_video = ''; }

                                // Designation
                                if(isset($this->config->$slider_designation)) { $slider_designation = $this->config->$slider_designation; }else{ $slider_designation = ''; }
                                $text .= '
                                <div class="single-testimonials">
                                    <div class="testimonials-img">';
                                        if($img):
                                            $text .= '
                                            <img class="rounded-1" src="'.loms_block_image_process($img).'" alt="'.$slider_name.'">';
                                        endif;

                                        if($slider_video):
                                            $text .= '
                                            <div class="video-center">
                                                <a href="'.$slider_video.'" class="video-btn popup-youtube">
                                                    <i class="ri-play-fill"></i>
                                                </a>
                                            </div>';
                                        endif;
                                        $text .= '
                                    </div>

                                    <div class="testimonials-content d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">';
                                                if($sm_img):
                                                    $text .= '
                                                    <img class="rounded-circle" src="'.loms_block_image_process($sm_img).'" alt="'.$slider_name.'">';
                                                endif;
                                                $text .= '
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h4>'.$slider_name.'</h4>
                                                <span>'.$slider_designation.'</span>
                                            </div>
                                        </div>';
                                        if($flag):
                                            $text .= '
                                            <div class="flag">
                                                <img src="'.loms_block_image_process($flag).'" alt="'.$slider_name.'">
                                            </div>';
                                        endif;
                                        $text .= '
                                    </div>
                                </div>';
                            } $text .= '
                        </div>
                    </div>
                    <ul class="list-unstyled owl-thumbs hero-slider-thumb" data-slider-id="1">';
                    for($i = 1; $i <= $sliderNumber; $i++) {
                        $sm_img                 = 'sm_img' . $i;

                        // Small Image
                        if(isset($this->config->$sm_img)) { $sm_img = $this->config->$sm_img; }else{ $sm_img = ''; }
                        $text .= '
                            <li class="owl-thumb-item">';
                                if($sm_img):
                                    $text .= '
                                    <img src="'.loms_block_image_process($sm_img).'" alt="'.$slider_name.'">';
                                endif;
                                $text .= '
                            </li>';
                        } $text .= '
                    </ul>
                </div>
                <!-- End Carousel Thumbs -->
            </div>
        </section>';

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