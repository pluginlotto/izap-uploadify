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

?>
.upload-progress {
}

.upload-progress div.meter {
	width:1px;
	height:<?php echo izap_get_progress_bar_settings('progressbar_height');?>;
	background-color:<?php echo izap_get_progress_bar_settings('progressbar_foreground_color');?>;
<!--	margin:1px;-->
}

.upload-progress div.readout {
	padding:5px 0px 0px 12px;
	font-family:"Courier New", Courier, monospace;
	font-size:12px;
	line-height:12px;
}

.upload-progress div.readout span {
	font-weight:bold;
}
