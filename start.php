<?php

/* * ************************************************
 * iZAP Web Solutions				  *
 * Copyrights (c) 2005-2009. iZAP Web Solutions.	  *
 * All rights reserved				  *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Kumar<tarun@izap.in>"
 */
if (elgg_is_active_plugin(GLOBAL_IZAP_ELGG_BRIDGE))
elgg_register_event_handler('init', 'system', 'init_izap_uploadify');
define('GLOBAL_IZAP_UPLOADIFY_PLUGIN', 'izap-uploadify');

function init_izap_uploadify() {
  global $CONFIG;

  izap_plugin_init(GLOBAL_IZAP_UPLOADIFY_PLUGIN);
  // temp upload folder
  $CONFIG->izapUploadify['uploadFolder'] = $CONFIG->dataroot;

  // lets include the javascript files
  elgg_extend_view('css/screen', 'izap-uploadify/css');

  // lets register some actions
  elgg_register_js('izap-uploadify', 'mod/' . GLOBAL_IZAP_UPLOADIFY_PLUGIN . '/vendors/jquery.progress.js');
  elgg_load_js('izap-uploadify');

}

function izapGetUploadedFiles_izap_uploadify() {
  $uploadedFiles = $_SESSION['uploadFolder'];
  unset($_SESSION['uploadFolder']);

  return $uploadedFiles;
}

function izap_get_progress_bar_settings($name) {
  $value = elgg_get_plugin_setting($name, GLOBAL_IZAP_UPLOADIFY_PLUGIN);

  switch ($name) {
    case 'progressbar_background_color':
      if (empty($value) || $value === FALSE) {
        $value = 'FFC536';
      }
      $value = '#' . $value;
      break;

    case 'progressbar_foreground_color':
      if (empty($value) || $value === FALSE) {
        $value = 'D9ECFF';
      }
      $value = '#' . $value;
      break;

    case 'progressbar_height':
      if (empty($value) || $value === FALSE) {
        $value = '15px';
      }
      break;

    case 'progressbar_width':
      if (empty($value) || $value === FALSE) {
        $value = '100%';
      }
      break;

    default:
      return FALSE;
      break;
  }

  return $value;
}