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

function izapBytesToMB($size = 0, $str = 'str') {
  if(!$size) return 0;

  $bytes = $size;
  $kb = ($size / 1024);
  $mb = ($kb / 1024);

  if($str == 'int')
    return $mb;

  if(round($mb , 2) > 0)
    return round($mb , 2) . 'MB';
  elseif(round($kb , 2) > 0)
    return round($kb , 2) . 'KB';
  else
    return $bytes . 'b';
}

c($upload_id = $_REQUEST['upload_id']);
if ($upload_id) {
  $data = uploadprogress_get_info($upload_id);
  if (!$data)
    $data['error'] = 'upload id not found';
  else {
    $avg_kb = $data['speed_average'] / 1024;
    if ($avg_kb<100)
      $avg_kb = round($avg_kb,1);
    else if ($avg_kb<10)
      $avg_kb = round($avg_kb,2);
    else $avg_kb = round($avg_kb);

    // two custom server calculations added to return data object:
    $data['kb_average'] = $avg_kb;
    $data['kb_uploaded'] = round($data['bytes_uploaded'] /1024);
    $data['mb_uploaded'] = round(izapBytesToMB($data['bytes_uploaded'], 'int'), 2);
    $data['mb_total_size'] = round(izapBytesToMB($data['bytes_total'], 'int'), 2);
    $data['mb_average'] = round(izapBytesToMB($data['speed_average'], 'int'), 2);
    $data['time'] = ($data['est_sec'] > 60) ? round($data['est_sec'] / 60) . ' minutes' : $data['est_sec'] . ' seconds';
  }

  header('Expires: Tue, 08 Oct 1991 00:00:00 GMT');
  header('Cache-Control: no-cache, must-revalidate');
  header("Content-Type: application/json");
  echo json_encode($data);
  exit;
}
