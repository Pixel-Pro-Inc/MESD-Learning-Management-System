<?php
global $CFG;
require_once($CFG->dirroot .'/blog/lib.php');
require_once($CFG->dirroot .'/blog/locallib.php');
require_once($CFG->dirroot . '/theme/loms/inc/block_handler/get-content.php');
class block_loms_blog_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_loms_blog_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/loms/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title            = 'Want To Learn More? Read Blog';
            $this->config->body            = 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Convallis Vel Feugiat Dolor Nam Ullamcorper.';
            $this->config->button_text      = 'Read More';
        }
    }

    public function get_content() {
        global $CFG, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;

        if(!empty($this->config->posts)){$this->content->posts = $this->config->posts;} else { $this->content->posts = '';}

        $url = new moodle_url('/blog/index.php');

        global $CFG;
        $bloglisting = new blog_listing();

        $entries = $bloglisting->get_entries();
        
        $entrieslist = array();
        $viewblogurl = new moodle_url('/blog/index.php');

        $text = '';
        $text .= '
        <div class="blog-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>'.$this->config->title.'</h2>
                    <p>'.$this->config->body.'</p>
                </div>

                <div class="row justify-content-center">';
                    if($this->content->posts):
                        foreach ($entries as $entryid => $entry) {
                            $viewblogurl->param('entryid', $entryid);
                            $entrylink = html_writer::link($viewblogurl, shorten_text($entry->subject));
                            $entrieslist[] = $entrylink;
            
                            $blogentry = new blog_entry($entryid);
                            $blogattachments = $blogentry->get_attachments();

                            $short_summary = $entry->summary;
                            $short_summary = strip_tags( $short_summary);
                            $short_summary = implode(' ', array_slice(str_word_count($short_summary,1), 0, 15));

                            if(in_array($entry->id, $this->content->posts)):
                                $text .= '
                                
                                <div class="col-xl-3 col-sm-6">
                                    <div class="single-blog">
                                        <a href="'.$viewblogurl.'" class="d-block blog-img">
                                            <img src="'.$blogattachments[0]->url.'" alt="'.$entry->subject.'">
                                            <span class="date">'. userdate($entry->created, '%d %b', 0) .'</span>
                                        </a>

                                        <div class="blog-content">
                                            <h3>
                                                <a href="'.$viewblogurl.'">'.$entry->subject.'</a>
                                            </h3>

                                            <div class="d-flex align-items-center user">
                                                <div class="flex-shrink-0">
                                                    <div class="icon">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h4 class="m-0"> <a href="'.$viewblogurl.'">'.$entry->firstname.' '.$entry->lastname.'</a></h4>';
                                                        if($this->config->button_text):
                                                            $text .= '
                                                            <a href="'.$viewblogurl.'" class="read-more">
                                                                '.$this->config->button_text.'
                                                            </a>';
                                                        endif;
                                                        $text .= '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            endif;
                        }
                    endif;
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