<?php
/**************************************************
* iZAP Web Solutions				  *
* Copyrights (c) 2005-2009. iZAP Web Solutions.	  *
* All rights reserved				  *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Kumar<tarun@izap.in>"
 */

function init_izap_uploadify() {
  global $CONFIG;

  // temp upload folder

  $CONFIG->izapUploadify['uploadFolder'] = $CONFIG->dataroot;

  // lets include the javascript files
  extend_view('metatags', 'izap-uploadify/js');
  extend_view('css', 'izap-uploadify/css');

  // lets register some actions
  register_action('izap-uploadify/upload', false, $CONFIG->pluginspath . 'izap-uploadify/actions/izap-uploader.php');
}

register_elgg_event_handler('init', 'system', 'init_izap_uploadify');

function izapGetUploadedFiles_izap_uploadify() {
  $uploadedFiles = $_SESSION['uploadFolder'];
  unset($_SESSION['uploadFolder']);

  return $uploadedFiles;
}

function izap_get_progress_bar_settings($name) {
  $value = get_plugin_setting($name, 'izap-uploadify');

  switch ($name) {
    case 'progressbar_background_color':
      if(empty($value) || $value === FALSE) {
        $value = 'FFC536';
      }
      $value = '#' . $value;
      break;

    case 'progressbar_foreground_color':
      if(empty($value) || $value === FALSE) {
        $value = 'D9ECFF';
      }
      $value = '#' . $value;
      break;

    case 'progressbar_height':
      if(empty($value) || $value === FALSE) {
        $value = '15px';
      }
      break;

    case 'progressbar_width':
      if(empty($value) || $value === FALSE) {
        $value = '100%';
      }
      break;

    default:
      return FALSE;
      break;
  }

  return $value;
}