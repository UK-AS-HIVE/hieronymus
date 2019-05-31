<?php
  hide($content['field_embed']);
  hide($content['field_audio']);
  hide($content['field_image2']);
  $submitted = date('F j, Y', $created);
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page && !$is_front): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      if(!empty($content['field_audio']['#items'])){
        drupal_add_css('//cdn.as.uky.edu/third-party/mediaelement/mediaelementplayer.min.css');
        drupal_add_js('//cdn.as.uky.edu/third-party/mediaelement/mediaelement-and-player.min.js', 'external');
        $url = file_create_url($content['field_audio']['#items'][0]['uri']);
        print '<audio id="podcast-' . $node->nid . '" src="' . $url . '" type="audio/mp3" controls="controls"></audio>';
        print '<script type="text/javascript">
          <!--//--><![CDATA[//><!-- 
            (function($) {
              $(\'#podcast-' . $node->nid . '\').mediaelementplayer({
                audioWidth:"100%"
              });
            }(jQuery));
        //--><!]]>
          </script>';
      }
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      if (isset($content['field_embed'])): 
        hide($content['field_embed']);
        ?>
        <div class="field field-name-embed field-label-hidden">
          <?php print $content['field_embed']['#items'][0]['value']; ?>
        </div>
      <?php endif; 
      print render($content);
    ?>
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>
