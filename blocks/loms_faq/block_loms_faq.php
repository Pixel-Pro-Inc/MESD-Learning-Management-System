<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_faq extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_faq');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->faqnumber = 5;
            $this->config->title = 'Find The Answer Of Your Questions            ';
            $this->config->content = 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.';
            $this->config->item_title1 = 'How Do We Create Course Content?';
            $this->config->item_content1 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.';
            $this->config->item_title2 = 'How Do I Reset My Account Password?';
            $this->config->item_content2 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.';
            $this->config->item_title3 = 'How Can I Manage My Account?';
            $this->config->item_content3 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.';
            $this->config->item_title4 = 'What Are The Benefits Of Lemy Learning?';
            $this->config->item_content4 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.';
            $this->config->item_title5 = 'Is Support For Learners Included?';
            $this->config->item_content5 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas facilisis metus vitae mattis velit ac amet, mattis an Quam eu aliquam quisque commodo feugiat placerat elit. Eget mi, morbi tincidunt dolor. Placerat enim rid iculus idemer feugiat faucibus non pulvinar tincidunt. Vulputate tincidunt sed interdum interdum porta enim.';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        $faqnumber = 5;
        if(isset($this->config->faqnumber)){
            $faqnumber = $this->config->faqnumber;
        } 
        $text = '';
        $text .= '
		<div class="faq-area ptb-100">
			<div class="container">
				<div class="section-title">
					<h2>'.$this->config->title.'</h2>
                    <p>'.$this->config->content.'</p>
				</div>
                <div class="accordion" id="accordionExample">';
                    for($i = 1; $i <= $faqnumber; $i++) {
                        $item_title     = 'item_title' . $i;
                        $item_content   = 'item_content' . $i;

                        if(isset($this->config->$item_title)) {
                            $item_title = $this->config->$item_title;
                        }else{
                            $item_title = '';
                        }
                        if(isset($this->config->$item_content)) {
                            $item_content = $this->config->$item_content;
                        }else{
                            $item_content = '';
                        }
                        if($i == 1):
                            $text .= '
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading'.$i.'">
                                    <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">
                                        '.$item_title.'
                                    </button>
                                </h2>
                                <div id="collapse'.$i.'" class="accordion-collapse collapse show" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>'.$item_content.'</p>
                                    </div>
                                </div>
                            </div>';
                        else:
                            $text .= '
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading'.$i.'">
                                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'">
                                        '.$item_title.'
                                    </button>
                                </h2>
                                <div id="collapse'.$i.'" class="accordion-collapse collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>'.$item_content.'</p>
                                    </div>
                                </div>
                            </div>';
                        endif;
                    }
                    $text .= '
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