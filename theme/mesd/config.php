<?php
// This line protects the file from being accessed by a URL directly.                                                               
defined('MOODLE_INTERNAL') || die();

// $THEME is defined before this page is included and we can define settings by adding properties to this global object.            
                                                                                                                                    
// The first setting we need is the name of the theme. This should be the last part of the component name, and the same             
// as the directory name for our theme.                                                                                             
$THEME->name = 'mesd';                                                                                                             
                                                                                                                                    
// This setting list the style sheets we want to include in our theme. Because we want to use SCSS instead of CSS - we won't        
// list any style sheets. If we did we would list the name of a file in the /style/ folder for our theme without any css file      
// extensions.                                                                                                                      
$THEME->sheets = ['styles'];

// This is a critical setting. We want to inherit from theme_loms because it provides a great starting point for SCSS bootstrap4   
// themes. We could add more than one parent here to inherit from multiple parents, and if we did they would be processed in        
// order of importance (later themes overriding earlier ones). Things we will inherit from the parent theme include                 
// styles and mustache templates and some (not all) settings.                                                                       
$THEME->parents = ['loms'];                                                                                                                                                                                                                                                                                                                                                       