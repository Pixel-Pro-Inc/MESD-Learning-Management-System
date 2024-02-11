<?php
/*
@lomsRef: @block_loms/block.php
*/

defined('MOODLE_INTERNAL') || die();

// print_object($this);
$lomsBlockType = $this->instance->blockname;

$lomsCollectionFullwidthTop =  array(
    "loms_banner_1",
    "loms_course_filter",
    "loms_categories",
    "loms_about_courses",
    "loms_partners",
    "loms_student_video",
    "loms_cta",
    "loms_features_area",
    "loms_instructor_area",
    "loms_about_area",
    "loms_blog_area",
    "loms_features_area_two",
    "loms_faq",
);

$lomsCollectionAboveContent =  array(
    "loms_contact_form",
    "loms_course_desc",
);

$lomsCollectionBelowContent =  array(
    "loms_course_rating",
    "loms_more_courses",
    "loms_course_instructor",
);

$lomsCollection = array_merge($lomsCollectionFullwidthTop, $lomsCollectionAboveContent, $lomsCollectionBelowContent);

if (empty($this->config)) {
    if(in_array($lomsBlockType, $lomsCollectionFullwidthTop)) {
        $this->instance->defaultregion = 'fullwidth-top';
        $this->instance->region = 'fullwidth-top';
        $DB->update_record('block_instances', $this->instance);
    }
    if(in_array($lomsBlockType, $lomsCollectionAboveContent)) {
        $this->instance->defaultregion = 'above-content';
        $this->instance->region = 'above-content';
        $DB->update_record('block_instances', $this->instance);
    }
    if(in_array($lomsBlockType, $lomsCollectionBelowContent)) {
        $this->instance->defaultregion = 'below-content';
        $this->instance->region = 'below-content';
        $DB->update_record('block_instances', $this->instance);
    }
}
