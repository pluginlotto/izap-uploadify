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

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

if (!empty($_FILES)) {
  $fileName = get_input('fileName');
	$tempFile = $_FILES[$fileName]['tmp_name'];
  $targetPath = trim(end(explode('|', get_input('folder'))));
	$extension =  end(explode('.', $_FILES[$fileName]['name']));

  $targetFile = $targetPath . time() . '.' . $extension;

  $file = new ElggFile();
  $file->owner_guid = get_input('userGuid');
  $file->setFilename($targetFile);
  $file->open('write');
  $file->write(get_uploaded_file($fileName));
  $file->close();

  $session_id = get_input('izapElgg');
  session_id($session_id);
  $_COOKIE['Elgg'] = $session_id;
  session_start();

  //  $session_name
//  $session_id = get_input();
//  session_id($session_id);
//  session_start();

  $_SESSION['uploadFolder'][] = $file->getFilenameOnFilestore();
  
}

