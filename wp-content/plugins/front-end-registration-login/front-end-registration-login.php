<?php
/*
Plugin Name: Front End Registration and Login
Plugin URI: https://pippinsplugins.com/creating-custom-front-end-registration-and-login-forms
Description: Provides simple front end registration and login forms
Version: 1.1
Author: Itsik Profeta
Author URI: http://profet-ltd.com
*/


class WP_User_Pippin_Setup {
  /**
   * Constructor
   * @since 1.0.0
   */
  public function __construct() {
    $this->_define_constants();
    $this->_load_wp_includes();
    $this->_load_pippin();
  }
  
  private function _define_constants() {
    define('PIPPIN_VERSION', '1.0.0');
    define('PIPPIN_FOLDER', basename(dirname(__FILE__)));
    define('PIPPIN_DIR', plugin_dir_path(__FILE__));
    define('PIPPIN_INC', PIPPIN_DIR.'includes'.'/');
    define('PIPPIN_URL', plugin_dir_url(PIPPIN_FOLDER).PIPPIN_FOLDER.'/');
    define('PIPPIN_INC_URL', PIPPIN_URL.'includes'.'/');
  }
  
  private function _load_wp_includes() {
      //
  }
  
  private function _load_pippin() {
      require_once(PIPPIN_INC.'front-end-registration-globals.php');
      require_once(PIPPIN_INC.'front-end-registration-form.php');
      require_once(PIPPIN_INC.'front-end-login-form.php');
      require_once(PIPPIN_INC.'front-end-profile-form.php');
  }
}
/**
 * Initialize
 */
new WP_User_Pippin_Setup();




?>