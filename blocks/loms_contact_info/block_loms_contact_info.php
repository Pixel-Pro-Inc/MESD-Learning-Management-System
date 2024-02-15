<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_contact_info extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_contact_info');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();

            $this->config->icon1    = 'ri-phone-fill';
            $this->config->features_content1    = 'Phone: <a href="tel:+(323)750-1234">+(323) 750-1234</a>';

            $this->config->icon2    = 'ri-mail-fill';
            $this->config->features_content2    = 'Email: <a href="mailto:hello@loms.com">hello@loms.com</a>';

            $this->config->icon3    = 'ri-map-pin-fill';
            $this->config->features_content3    = 'Address: <span>+711 Vermont Ave, LA, CA</span>';
            $this->config->shape_img    = LOMS_IMG .'info-shape.svg';
        }
    }

    public function get_content() {
        global $CFG, $DB;
        $this->content  =  new stdClass;
        $features_number = 3;
        if(isset($this->config->features_number)){
            $features_number = $this->config->features_number;
        }
        $text = '';
        $text .='
        <div class="contact-info-area pb-70 pt-100">
			<div class="container">
				<div class="row justify-content-center">';
                    for($i = 1; $i <= $features_number; $i++) {
                        $icon                    = 'icon' . $i;
                        $features_content         = 'features_content' . $i;

                        // Icon
                        if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }

                        // Title
                        if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }
                        $text .= '
                        <div class="col-xl-4 col-sm-6 p-0">';
                            if($i == 1):
                                $text .= '<div class="single-contact-info wow animate__animated animate__fadeInUp delay-0-2s">';
                            elseif($i == 2):
                                $text .= '<div class="single-contact-info bg-color-dd246e wow animate__animated animate__fadeInDown delay-0-2s">';
                            elseif($i == 3):
                                $text .= '<div class="single-contact-info bg-color-8007e6 wow animate__animated animate__fadeInUp delay-0-2s">';
                            else:
                                $text .= '<div class="single-contact-info wow animate__animated animate__fadeInUp delay-0-2s">';
                            endif;
                                if($icon):
                                    $text .= '
                                    <div class="icon">
                                        <i class="'.$icon.'"></i>
                                    </div>';
                                endif;
                                $text .= '
                                
                                <h3>'.$features_content.'</h3>';
                                if($this->config->shape_img):
                                    $text .= '<img class="info-shape" src="'.loms_block_image_process($this->config->shape_img).'" alt="'.strip_tags($features_content).'" >';
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