<?php
/**
 * Block Content Handler
 */

function loms_block_image_process($img) {
    global $CFG;
    $old_url = 'http://localhost/moodle/loms/';
    $old_url2 = 'http://localhost:8888/moodle/loms/';
    $new_url = $CFG->wwwroot.'/';

    if (strpos($img, $old_url) !== false) {
        $img = str_replace($old_url,$new_url,$img);
        return $img;
    }elseif (strpos($img, $old_url2) !== false) {
        $img = str_replace($old_url2,$new_url,$img);
        return $img;
    }else{
        return $img;
    }
}
