<?php
/*
Plugin Name: Simple Redirect
Author: Dio Affriza
*/

require __DIR__.'/utils/routeutil.php';
require __DIR__.'/utils/config.php';
require ABSPATH.'wp-includes/pluggable.php';

use wpscholar\Url;

class SimpleRedirect {
   public static $redirectscfg;

   public static function init(){
      try {
         self::$redirectscfg = loadconfigfromfile(__DIR__.'/config.json');
      } catch (Exception $e) {

      }
      wp_register_style('simple_redirect_jquerymodal', plugins_url('/assets/css/jquery.modal.min.css', __FILE__ ));
      wp_enqueue_style('simple_redirect_jquerymodal');
      wp_enqueue_script("simple_redirect_jquery", plugins_url('/assets/js/jquery-3.5.1.min.js', __FILE__));
      wp_enqueue_script("simple_redirect_jquerymodal", plugins_url('/assets/js/jquery.modal.min.js', __FILE__));
      wp_enqueue_script('simple_redirect_settingsjs', plugins_url('/assets/js/settings.js', __FILE__));
      add_action('admin_menu', [__CLASS__, 'redirection_createmenu']);
      self::prepare_route();
      self::go_redirect();
   }


   private static function prepare_route(){
      AddRoute('config/read', 'GET', [__CLASS__, 'configread_handler']);
      AddRoute('config/write', 'POST', [__CLASS__, 'configwrite_handler']);
   }

   public static function configwrite_handler( WP_REST_Request $request) {
      try{
         saveconfigtofile(__DIR__.'/config.json', $request->get_body());
      } catch(Exception $e){
         echo $e;
      }
   }

   public static function configread_handler($data) {
      return self::$redirectscfg;
   }

   private static function go_redirect(){
      $current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      try{


         $redirectlist = self::$redirectscfg->redirects;
         foreach ($redirectlist as $key) {
            if (strpos($current_url, $key->oldurl) > -1){
               if ($key->statuscode == ""){
                  wp_safe_redirect($key->newurl, 302);
                  exit();
               } else {
                  wp_safe_redirect($key->newurl, $key->statuscode);
                  exit();
               }
            }
         }
      } catch (Exception $e) {

      }
   }

   public static function render_page() {
      include __DIR__.'/assets/view/settings.php';
   }

   public static function redirection_createmenu() {
      add_options_page('Simple Redirect Settings', 'Simple Redirect Settings', 'manage_options', 'simple_redirect', [__CLASS__, 'render_page']);
   }
} 


SimpleRedirect::init();

?>