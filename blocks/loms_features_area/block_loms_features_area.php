<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_features_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_features_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();

            $this->config->title      = 'Our Course Qualities';
            $this->config->content    = 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.';
            
            $this->config->features_title1          = 'Project Based';
            $this->config->features_content1        = 'Build Real Products While Learning The Live Tutorial';
            $this->config->img1    = LOMS_IMG .'qualities/qualities-1.webp';

            $this->config->features_title2          = 'Job-Focused';
            $this->config->features_content2        = 'Learn Industry-relevant Skills To Get Your Dream Job';
            $this->config->img2    = LOMS_IMG .'qualities/qualities-2.webp';

            $this->config->features_title3          = 'Peer-To-Peer';
            $this->config->features_content3        = 'Get Help & Support From Your Peers And Go Higher';
            $this->config->img3    = LOMS_IMG .'qualities/qualities-3.webp';

            $this->config->features_title4          = 'Self Paced';
            $this->config->features_title4        = 'Learn At Your Own Pace & Achieve Your Goal';
            $this->config->img4    = LOMS_IMG .'qualities/qualities-4.webp';
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
        <div class="qualities-area bg-color-f5faff pt-100 pb-70">
			<div class="container">
				<div class="section-title w-550">
                    <h2>'.$this->config->title.'</h2>
                    <p>'.$this->config->content.'</p>
				</div>

				<div class="row justify-content-center">';
                    for($i = 1; $i <= $features_number; $i++) {
                        $img                    = 'img' . $i;
                        $features_title         = 'features_title' . $i;
                        $features_content       = 'features_content' . $i;

                        // Image
                        if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                        // Title
                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                        // Content
                        if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                        $text .= '
                        <div class="col-lg-3 col-sm-6">
                            <div class="single-qualities wow animate__animated animate__fadeInLeft delay-0-2s">';
                                if($img):
                                    $text .= '<img src="'.loms_block_image_process($img).'" alt="'.$features_title.'">';
                                endif;
                                $text .= '
                                <h3>'.$features_title.'</h3>
                                <p>'.$features_content.'</p>
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