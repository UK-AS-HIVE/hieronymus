<?php
// $Id: node.tpl.php,v 1.2 2010/12/01 00:18:15 webchick Exp $

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
$image_path = "//cdn.as.uky.edu/images/department_circles/";
//$image_path ="https://wd2.as.uky.edu/sites/default/files/styles/medium/public/";
$image_name = array("A&S" => "default-department-circle.png",
"AAS" => "african-american-and-africana-studies.png",
"AC" => "default-department-circle.png",
"AFS" => "afrotc.png",
"AIS" => "default-department-circle.png",
"AMS" => "army-rotc.png",
"ANT" => "anthropology.png",
"APP" => "appalachian-studies.png",
"AS" => "default-department-circle.png",
"ASK" => "default-department-circle.png",
"AST" => "physics-and-astronomy.png",
"BIO" => "biology.png",
"BLK" => "default-department-circle.png",
"BOT" => "default-department-circle.png",
"CEP" => "default-department-circle.png",
"CGS" => "default-department-circle.png",
"CHE" => "chemistry.png",
"CHI" => "default-department-circle.png",
"CLA" => "default-department-circle.png",
"CLT" => "default-department-circle.png",
"DSP" => "default-department-circle.png",
"EES" => "earth-and-environmental-sciences.png",
"ENG" => "english.png",
"ENS" => "environmental-and-sustainability-studies.png",
"FR" => "default-department-circle.png",
"GEO" => "geography.png",
"GER" => "default-department-circle.png",
"GLY" => "default-department-circle.png",
"GWS" => "gws.png",
"HIS" => "history.png",
"HJS" => "default-department-circle.png",
"INF" => "default-department-circle.png",
"ITA" => "default-department-circle.png",
"JPN" => "default-department-circle.png",
"KTC" => "default-department-circle.png",
"LAS" => "lacls.png",
"LIN" => "linguistics.png",
"MA" => "math.png",
"MB" => "default-department-circle.png",
"MCL" => "mcllc.png",
"MS" => "default-department-circle.png",
"MSC" => "default-department-circle.png",
"OR" => "default-department-circle.png",
"PHI" => "philosophy.png",
"PHY" => "physics-and-astronomy.png",
"PS" => "political-science.png",
"PSY" => "psychology.png",
"RAE" => "default-department-circle.png",
"RS" => "default-department-circle.png",
"RUS" => "default-department-circle.png",
"SCI" => "default-department-circle.png",
"SOC" => "sociology.png",
"SPA" => "default-department-circle.png",
"SPI" => "default-department-circle.png",
"ST" => "social-theory.png",
"STA" => "stats.png",
"UKC" => "default-department-circle.png",
"WRD" => "wrd.png",
"WS" => "default-department-circle.png",
"ZOO" => "default-department-circle.png",
"DEFAULT" => "default-department-circle.png");
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="course-section-header views-field">
    <span class="course-section-image">
      <?php

        $course_prefix = $node->field_course_prefix['und'][0]['value'];

        // If there is an associated author with a profile picture, use that
        $user_load = user_load(array('uid' => $node->uid));    
        if (($node->uid != 0) && ($user_load->picture != 0)) {
          print theme('user_picture', array('account' => $user_load)); 
        }
        // Otherwise, use the generic department icon from the list above. 
        else {
          if (array_key_exists($course_prefix, $image_name)) {
            //print "<div>Key exists.</div>";
            print "<img typeof=\"foaf:Image\" src=\"". $image_path .
              $image_name[$course_prefix].
              "\" width=\"220\" />";
          } else {
            //print "<div>Key does not exist.</div>";
            print "<img class=\"as-default-image\" typeof=\"foaf:Image\" src=\"". $image_path .
              $image_name['DEFAULT']."\" width=\"220\" height=\"152\" />";
          }
        }
      ?>
    </span>
    <span class="course-section-floater">

    <?php
        
        // Full Course Number
        print "<h2 class='course-section-title'>".$course_prefix . " " 
          . $node->field_course_number['und'][0]['value'] . "-"
          . $node->field_course_section['und'][0]['value']."</h2>";
          
        // Course Name if not on page
        if (!$page) {
          print '<h4 class="course-section-name">'
           . l($node->title, 'node/' . $node->nid, array('attributes' => array('target' => '_blank'))) 
           . '<span class="uk-only" style="display: none;">' . $title . '</span>'
           . '</h4>';
        }

        if ($node->field_course_section_cancelled['und'][0]['value'] == 1) {
          print "<div><b>This class is cancelled.</b></div>";
        }
        else {
          print '<div class="long-fields">';
          print render($content['field_course_instructor']);  
          print render($content['field_course_section_class_time']);
          print render($content['field_syllabus']);
          print render($content['field_start_date']);
          print render($content['field_end_date']);
          print '</div>';

          print '<div class="short-fields">';
          print render($content['field_semester']);
          print render($content['field_room']);        
          print render($content['field_building']);
          if (isset($node->field_course_section_days['und'][0]['value'])): ?>
            <div class="field field-name-field-course-section-days field-type-text field-label-inline clearfix">
              <div class="field-label">Meeting time:&nbsp;</div>
              <div class="field-items">
                <?php print $node->field_course_section_days['und'][0]['value']; ?> 
                <?php print $node->field_course_section_start_time['und'][0]['value']; ?> - 
                <?php print $node->field_course_section_end_time['und'][0]['value']; ?>
              </div>
            </div>
          <?php endif;
          print render($content['field_credits']);
          print render($content['field_course_section_seats_open']);
          print render($content['field_course_section_wait_list']);
          print '</div>';
        }
    ?>
    </span>
  </div>
    
  <div>
    <h2 class="title section-title" >Course Description</h2>
    <!--
    <div style="float: right">
      <?php print $user_picture; ?>
    </div>
    -->

    <?php
      if (isset($content['field_course_section_description']) && !empty($content['field_course_section_description']['#items'][0]['value'])) {
        print render($content['field_course_section_description']);
      }
      else {
        print views_embed_view('course_section_description', 'page', 
          $node->field_course_prefix['und'][0]['value'], 
          $node->field_course_number['und'][0]['safe_value']);
      }
    ?>
  </div>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
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

 <!-- <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?> -->

</div>
