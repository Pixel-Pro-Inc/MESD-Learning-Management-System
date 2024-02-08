<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_features_area_two extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_features_area_two');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();

            $this->config->shape_img    = LOMS_IMG .'features-shape.svg';
            $this->config->features_title1          = 'Learn The Essential Skills';
            $this->config->img1    = LOMS_IMG .'about-icon/1.svg';
            $this->config->features_title2          = 'Earn Certificates & Degrees';
            $this->config->img2    = LOMS_IMG .'about-icon/2.svg';
            $this->config->features_title3          = 'Lifetime Slack & Chat Support';
            $this->config->img3    = LOMS_IMG .'about-icon/3.svg';
            $this->config->features_title4          = 'Research & Innovation';
            $this->config->img4    = LOMS_IMG .'about-icon/4.svg';
        }
    }

    public function get_content() {
        global $CFG, $DB;
        $this->content  =  new stdClass;
        $features_number = 4;
        if(isset($this->config->features_number)){
            $features_number = $this->config->features_number;
        }
        $text = '';
        $text .='
        <div class="features-area pt-0 pb-70">
			<div class="container-fluid">
				<div class="row">';
                    for($i = 1; $i <= $features_number; $i++) {
                        $img                    = 'img' . $i;
                        $features_title         = 'features_title' . $i;

                        // Image
                        if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                        // Title
                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }
                        $text .= '
                        <div class="col-xl-3 col-sm-6 p-0">';
                            if($i == 1):
                                $text .= '<div class="single-features wow animate__animated animate__fadeInUp delay-0-2s">';
                            elseif($i == 2):
                                $text .= '<div class="single-features bg-color-dd246e wow animate__animated animate__fadeInDown delay-0-2s">';
                            elseif($i == 3):
                                $text .= '<div class="single-features bg-color-8007e6 wow animate__animated animate__fadeInUp delay-0-2s">';
                            elseif($i == 4):
                                $text .= '<div class="single-features bg-color-0cae74 wow animate__animated animate__fadeInDown delay-0-2s">';
                            else:
                                $text .= '<div class="single-features wow animate__animated animate__fadeInDown delay-0-2s">';
                            endif;
                            $text .= '
                                <div class=" text-start">
                                    <div class="icon">';
                                        if($img):
                                            $text .= '<img src="'.loms_block_image_process($img).'" alt="'.$features_title.'" >';
                                        endif;
                                        $text .= '
                                    </div>
                                    <h3>'.$features_title.'</h3>
                                </div>';
                                if($this->config->shape_img):
                                    $text .= '<img class="features-shape" src="'.loms_block_image_process($this->config->shape_img).'" alt="'.$features_title.'" >';
                                endif;
                                $text .= '
                            </div>
                        </div>';
                    } $text .= '
				</div>
			</div>
		</div>';
        
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