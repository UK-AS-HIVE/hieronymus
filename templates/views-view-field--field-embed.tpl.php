<?php
 /**
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php 
$embed = $row->_field_data['nid']['entity']->field_embed['und'][0]['value'];

/*/Find the current width and height
preg_match('/width=\d+/', $embed, $width);
preg_match('/\d+/', $width[0], $width);
$width = reset($width);
preg_match('/height=\d+/', $embed, $height);
preg_match('/\d+/', $height[0], $height);
$height = reset($height);

// Make the video a standard width for easier styling.  If the width is changed here, the height will stay proportional
if($height && $width){
  $new_width = 600;
  $new_height = $new_width * $height / $width;
  $embed = preg_replace('/width=\d+/', 'width=' . $new_width, $embed);
  $embed = preg_replace('/height=\d+/', 'height=' . $new_height, $embed);
}
*/
print $embed;

?>
