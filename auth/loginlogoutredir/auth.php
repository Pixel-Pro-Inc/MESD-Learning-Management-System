<?php
require_once($CFG->libdir.'/authlib.php');

class auth_plugin_loginlogoutredir extends auth_plugin_base {
    /**
     * Constructor.
     */
    function auth_plugin_loginlogoutredir() {
        $this->authtype = 'loginlogoutredir';
        $this->config = get_config('auth/loginlogoutredir');
    }

    function logoutpage_hook() {
		global $CFG;
		global $redirect;
		if ($CFG->logoutredir) {
			$redirect = $CFG->logoutredir;
		}
		else {
			error_log("'logoutredir' not set in config.php. Not redirecting.");
		}
    }
}

?>
