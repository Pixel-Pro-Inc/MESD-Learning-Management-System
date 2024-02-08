<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_cta extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_cta');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title    = 'Join Over 5M+ Students';
            $this->config->content  = 'Sign Up For A Free Account Today To Get Access To 400+ Free Courses, A Community Of Learners, And Live Events Every Week.';
            $this->config->class    = 'join-students-area bg-color-f5faff';
            $this->config->btn      = 'Sign Up For Free';
            $this->config->link     = $CFG->wwwroot .'/login/index.php';
            $this->config->img      = LOMS_IMG .'join-students-bg.webp';
            $this->config->shape_img      = LOMS_IMG .'border-shape-2.svg';
        }
    }

    public function get_content() {
        global $CFG, $DB;
        $this->content         =  new stdClass;
        $text = '';
        $text .= '
        <div class="'.$this->config->class.'">
			<div class="container">
				<div class="join-students" style="background-image:url('.loms_block_image_process($this->config->img).');">
					<div class="row align-items-center justify-content-center">
						<div class="col-lg-7">
							<h2>'.$this->config->title.'</h2>
							<p>'.$this->config->content.'</p>
						</div>

						<div class="col-lg-5 text-lg-end">';
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
			</div>';

            if($this->config->shape_img):
                $shape_img = $this->config->shape_img;
                $text .= '			<img src="'.loms_block_image_process($shape_img).'" class="border-shape-2" alt="'.$this->config->title.'">
                ';
            endif; 
            $text .= '
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