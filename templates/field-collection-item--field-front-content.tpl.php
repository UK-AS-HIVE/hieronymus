<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */

hide($content['field_scrollable']);
hide($content['field_restricted_width']);
hide($content['field_classes']);


if ($content['field_divider']['#items'][0]['value'] == 1) {
  $classes .= ' divider';
}
if ($content['field_more_button']['#items'][0]['value'] == 1) {
  $classes .= ' more-button';
}
if (!empty($content['field_classes']['#items'][0]['value'])) {
  $classes .= ' ' . check_plain($content['field_classes']['#items'][0]['value']);
}

$block_classes = 'block-wrapper';
if ($content['field_scrollable']['#items'][0]['value'] == 1) {
  $block_classes .= ' visible-arrows';
}
if ($content['field_restricted_width']['#items'][0]['value'] == 1) {
  $block_classes .= ' restricted-width';
}

$content_classes = 'content-wrapper';
if ($content['field_badges']['#items'][0]['value'] == 1) {
  $content_classes .= ' badges';
}



?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="<?php print $block_classes;?>">
    <div class="width-container">
      <?php print render($title_prefix); ?>
      <?php if ($block->subject): ?>
          <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
      <?php endif;?>
      <?php print render($title_suffix); ?>
      <div class="<?php print $content_classes ?>">
        <div class="content"<?php print $content_attributes; ?> >
          <?php print render($content) ?>
        </div>
      </div>
      <div class="back-arrow arrows"></div>
      <div class="forward-arrow arrows"></div>
    </div>
  </div>
</div>
