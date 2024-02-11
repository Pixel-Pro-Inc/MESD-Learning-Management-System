<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');

class block_loms_banner_1 extends block_base {
    public function init() {
        $this->title = '[Loms] Banner One';
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');

        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Build Your <span>Future</span> With The MESD LMS';
            $this->config->content = 'Delivering the <span>21st</span> <span>Century</span> Learner!';
            $this->config->btn = 'View Your Courses Now';
            $this->config->btn_link = $CFG->wwwroot .'/course';
            $this->config->btn_shape = LOMS_IMG .'banner/more-3.svg';

            $this->config->banner_img1 = LOMS_IMG .'banner/banner-img-1.webp';
            $this->config->image1_content = 'Develop your <span>skills</span> as fast as <span>rocket';
            $this->config->image1_icon = LOMS_IMG .'icon/rocket.svg';
            $this->config->image1_shape = LOMS_IMG .'banner/more-1.svg';

            $this->config->banner_img2 = LOMS_IMG .'banner/banner-img-2.webp';
            $this->config->image2_content = 'World <span>renowned</span> LMS';
            $this->config->image2_icon = LOMS_IMG .'icon/award-2.svg';
            $this->config->image2_shape = LOMS_IMG .'banner/more-2.svg';
            
            $this->config->shape_img1 = LOMS_IMG .'banner/banner-shape-6.svg';
            $this->config->shape_img2 = LOMS_IMG .'banner/banner-shape-4.svg';
            $this->config->shape_img3 = LOMS_IMG .'banner/banner-shape-5.svg';
            $this->config->shape_img4 = LOMS_IMG .'banner/banner-shape-3.svg';
            $this->config->section_bg = LOMS_IMG .'banner/banner-bg-3.webp';
        }
    }

    public function get_content() {
        global $CFG, $DB;
        if ($this->content !== null) {
          return $this->content;
        }
        $this->content  =  new stdClass;

        $text = '';
        $text .= '
        <div class="banner-area bg-3" style="background-image:url('.loms_block_image_process($this->config->section_bg).');">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="banner-content banner-content-three">
							<h1 class="wow animate__animated animate__fadeInUp delay-0-2s">'.$this->config->title.'</h1>
							<p class="wow animate__animated animate__fadeInUp delay-0-4s">'.$this->config->content.'</p>
							<div class="banner-btn wow animate__animated animate__fadeInUp delay-0-6s">';
                                if($this->config->btn):
                                    $text .= '
								    <a href="'.$this->config->btn_link.'" class="default-btn">'.$this->config->btn.'</a>';
                                endif;

                                if($this->config->btn_shape):
                                    $text .= '<img class="more-3" src="'.loms_block_image_process($this->config->btn_shape).'"alt="'.strip_tags($this->config->title).'">';
                                endif; 
                                $text .= '
							</div>';
                            
                            if($this->config->shape_img1):
                                $text .= '<img class="shape shape-1" src="'.loms_block_image_process($this->config->shape_img1).'"alt="'.strip_tags($this->config->title).'">';
                            endif; 
                            $text .= '
						</div>
					</div>

					<div class="col-lg-6">
						<div class="develop-card-wrapper">
							<div class="develop-card d-flex align-items-end">
								<div class="develop-content mr-minus-50 d-flex align-items-center">';
                                    if($this->config->image1_content || $this->config->image1_icon):
                                        $text .= '
                                        <div class="flex-shrink-0">
                                            <div class="icon">';
                                                if($this->config->image1_icon):
                                                    $text .= '<img src="'.loms_block_image_process($this->config->image1_icon).'"alt="'.strip_tags($this->config->title).'">';
                                                endif; 
                                                $text .= '
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <p>'.$this->config->image1_content.'</p>
                                        </div>';
                                    endif;
                                    $text .= '
								</div>';
                                
                                if($this->config->banner_img1):
                                    $text .= '<img class="rounded-1" src="'.loms_block_image_process($this->config->banner_img1).'"alt="'.strip_tags($this->config->title).'">';
                                endif; 

                                if($this->config->image1_shape):
                                    $text .= '<img class="more more-1" src="'.loms_block_image_process($this->config->image1_shape).'"alt="'.strip_tags($this->config->title).'">';
                                endif; 
                                $text .= '
							</div>
	
							<div class="develop-card mr-130 d-flex align-items-end">';
                                if($this->config->banner_img2):
                                    $text .= '<img class="rounded-2" src="'.loms_block_image_process($this->config->banner_img2).'"alt="'.strip_tags($this->config->title).'">';
                                endif; 

                                if($this->config->image2_shape):
                                    $text .= '<img class="more more-2" src="'.loms_block_image_process($this->config->image2_shape).'"alt="'.strip_tags($this->config->title).'">';
                                endif; 
                                $text .= '

								<div class="develop-content ml-minus-50 d-flex align-items-center">';
                                    if($this->config->image2_content || $this->config->image2_icon):
                                        $text .= '
                                        <div class="flex-shrink-0">
										    <div class="icon bg-color-fec400">';
                                                if($this->config->image2_icon):
                                                    $text .= '<img src="'.loms_block_image_process($this->config->image2_icon).'"alt="'.strip_tags($this->config->title).'">';
                                                endif; 
                                                $text .= '
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <p>'.$this->config->image2_content.'</p>
                                        </div>';
                                    endif;
                                    $text .= '
								</div>';

                                if($this->config->shape_img2):
                                    $text .= '<img class="shape shape-2" src="'.loms_block_image_process($this->config->shape_img2).'"alt="'.strip_tags($this->config->title).'">';
                                endif;

                                if($this->config->shape_img3):
                                    $text .= '<img class="shape shape-3" src="'.loms_block_image_process($this->config->shape_img3).'"alt="'.strip_tags($this->config->title).'">';
                                endif;
                                $text .= '
							</div>';

                            if($this->config->shape_img4):
                                $text .= '<img class="shape shape-1" src="'.loms_block_image_process($this->config->shape_img4).'"alt="'.strip_tags($this->config->title).'">';
                            endif;
                            $text .= '
						</div>
					</div>
				</div>
			</div>
		</div>';
        
        $this->content         =  new stdClass;
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