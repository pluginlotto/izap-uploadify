<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$plugin = $vars['entity'];
?>
<p>
  <label>
    <?php
    echo elgg_echo('izap-uploadify:progressbar_background_color');
    echo elgg_view('input/text', array('internalname' => 'params[progressbar_background_color]', 'value' => $plugin->progressbar_background_color));
    ?>
  </label>
</p>

<p>
  <label>
    <?php
    echo elgg_echo('izap-uploadify:progressbar_foreground_color');
    echo elgg_view('input/text', array('internalname' => 'params[progressbar_foreground_color]', 'value' => $plugin->progressbar_foreground_color));
    ?>
  </label>
</p>

<p>
  <label>
    <?php
    echo elgg_echo('izap-uploadify:progressbar_height');
    echo elgg_view('input/text', array('internalname' => 'params[progressbar_height]', 'value' => $plugin->progressbar_height));
    ?>
  </label>
</p>