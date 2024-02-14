<?php
global $CFG;
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_partners extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_partners');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();    
            $this->config->class = 'partner-area bg-color-f9f9f9 ptb-100';
            $this->config->body = 'Trusted By Leading Universities & Companies';
        }
    }

    public function get_content() {
        global $CFG, $DB;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
          return $this->content;
        }

        $this->content         =  new stdClass;

        $text = '';
        $text .= '
        <div class="'.$this->config->class.'">
			<div class="container">
                <div class="section-title mw-100">
                    <h2>'.$this->config->body.'</h2>
				</div>

                <div class="partner-slide owl-carousel owl-theme">';
                    $fs = get_file_storage();
                    $files = $fs->get_area_files($this->context->id, 'block_loms_partners', 'content');
                    foreach ($files as $file) {
                        $filename = $file->get_filename();
                        if ($filename <> '.') {
                            $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                            $text .= '
                            <div class="partner-item wow animate__animated animate__zoomIn delay-0-2s">
                                <img src="'. $url.'" alt="'. $filename.'">
                            </div>';
                        }
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