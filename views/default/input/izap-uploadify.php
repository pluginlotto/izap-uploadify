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

/**
 * params for the view to work
 * 
 * $vars['internalname'] input_name
 * $vars['redirect_url'] redirect url after the successfull upload
 * $vars['form_id'] id of the form
 *
 */



$uniqueId = md5(time() . session_id());
?>
<script type="text/javascript">
  jQuery(function () {
    // apply uploadProgress plugin to form element
    // with debug mode and array of data fields to publish to readout:
    jQuery('#<?php echo $vars['form_id']?>').uploadProgress({
      progressURL:'<?php echo $vars['url']?>mod/izap-uploadify/fileStatus.php',
      displayFields : ['mb_uploaded','kb_average','time', 'mb_total_size'],
      waitText : '<?php elgg_echo('izap-uploadify:uploading_wait');?>',
//      debugDisplay: true,
updateDelay:1000,
      start: function() {
        $('#uploadProgress').toggle();
      },
      success: function() {
        $('#uploadProgress').html('File Uploaded');
        window.location = '<?php echo $vars['redirect_url']?>';
      }
    });
  });
</script>
<input type="hidden" name="UPLOAD_IDENTIFIER" value="<?php echo $uniqueId?>">
<input type="file" name="<?php echo $vars['name']?>" id=<?php echo $vars['id']?> >
<div class="upload-progress" id="uploadProgress" style="display:none;">
  <div class="readout">
       <span class="mb_uploaded">0</span>/<span class="mb_total_size">0</span> MB - <span class="kb_average">0</span> kb/sec <br/><span class="time">0</span> <b><?php elgg_echo('izap-uploadify:remaining');?></b>
  </div>
  <div style="background: <?php echo izap_get_progress_bar_settings('progressbar_background_color');?>;border:2px solid #fff; height:<?php echo izap_get_progress_bar_settings('progressbar_height');?>">
    <div class="meter"></div>
    <div class="clearfloat"></div>
  </div>
  <div class="clearfloat"></div>
</div>