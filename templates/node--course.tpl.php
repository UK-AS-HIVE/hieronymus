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
$image_path = "https://".$_SERVER['HTTP_HOST']."/sites/default/files/styles/medium/public/";
//$image_path ="https://wd2.as.uky.edu/sites/default/files/styles/medium/public/";
$image_name = array("A&S" => "courses_default_1063.jpg",
"AAS" => "courses_default_1063.jpg",
"AC" => "courses_default_1063.jpg",
"AFS" => "dept_afrotc_16.jpg",
"AIS" => "courses_default_1063.jpg",
"AMS" => "dept_rotc.jpg",
"ANT" => "dept_anthropology_463.jpg",
"APP" => "courses_default_1063.jpg",
"AS" => "courses_default_1063.jpg",
"ASK" => "courses_default_1063.jpg",
"AST" => "dept_physastro_7.jpg",
"BIO" => "dept_biology_313.jpg",
"BLK" => "courses_default_1063.jpg",
"BOT" => "courses_default_1063.jpg",
"CEP" => "courses_default_1063.jpg",
"CGS" => "courses_default_1063.jpg",
"CHE" => "dept_chemistry.jpg",
"CHI" => "courses_default_1063.jpg",
"CLA" => "courses_default_1063.jpg",
"CLT" => "courses_default_1063.jpg",
"DSP" => "courses_default_1063.jpg",
"EES" => "dept_earthenviron_73.jpg",
"ENG" => "dept_english_552.jpg",
"ENS" => "courses_default_1063.jpg",
"FR" => "courses_default_1063.jpg",
"GEO" => "dept_geography_77.jpg",
"GER" => "courses_default_1063.jpg",
"GLY" => "dept_earthenviron_73.jpg",
"GWS" => "dept_gwstudies_22.jpg",
"HIS" => "dept_history_113.jpg",
"HJS" => "dept_judaicstudies.jpg",
"INF" => "courses_default_1063.jpg",
"ITA" => "courses_default_1063.jpg",
"JPN" => "courses_default_1063.jpg",
"KTC" => "courses_default_1063.jpg",
"LAS" => "courses_default_1063.jpg",
"LIN" => "dept_linguistics_25.jpg",
"MA" => "dept_math_2.jpg",
"MB" => "courses_default_1063.jpg",
"MCL" => "dept_mclanguages.jpg",
"MS" => "courses_default_1063.jpg",
"MSC" => "courses_default_1063.jpg",
"OR" => "courses_default_1063.jpg",
"PHI" => "dept_philosophy_561.jpg",
"PHY" => "dept_physastro.jpg",
"PS" => "dept_polisci.jpg",
"PSY" => "dept_psychology.jpg",
"RAE" => "courses_default_1063.jpg",
"RS" => "courses_default_1063.jpg",
"RUS" => "courses_default_1063.jpg",
"SCI" => "courses_default_1063.jpg",
"SOC" => "dept_sociology_725.jpg",
"SPA" => "courses_default_1063.jpg",
"SPI" => "courses_default_1063.jpg",
"ST" => "dept_socialtheory_4.jpg",
"STA" => "dept_stats.jpg",
"UKC" => "courses_default_1063.jpg",
"WRD" => "dept_writing_1.jpg",
"WS" => "courses_default_1063.jpg",
"ZOO" => "courses_default_1063.jpg",
"DEFAULT" => "courses_default_1063.jpg");
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <span style="float: right; width: 500px">
    <h1 class="title" id="page-title"><?php print $title ?></h1>
  <?php
      print render($content['field_department']);
      print render($content['field_course_prefix']);
      print render($content['field_course_number']);
      if (!empty($content['field_promotional_description'])) {
        print render($content['field_promotional_description']);
      } else {
	print render($content['body']);
      }
  ?>
  </span>

  <!--<div><?php print render($content['field_image']); ?></div>-->
  <?php
     $course_prefix = $node->field_course_prefix['und'][0]['value'];
     //print "<div>". $course_prefix. "</div>";
     if (array_key_exists($course_prefix, $image_name)) {
        //print "<div>Key exists.</div>";
        print "<div><img typeof=\"foaf:Image\" src=\"". $image_path .
          $image_name[$course_prefix].
          "\" width=\"220\" height=\"152\" /></div>";
      } else {
        //print "<div>Key does not exist.</div>";
        print "<div><img typeof=\"foaf:Image\" src=\"". $image_path .
          $image_name['DEFAULT']."\" width=\"220\" height=\"152\" /></div>";
      }
  ?>
  <div style="clear: both;">
  </div>

  <div>
    <h2 class="title" id="page-title">Sections</h2>
    <?php
      //print render($content);
      print views_embed_view('courses_course_sections', 'default', $field_course_prefix[0]['value'], $field_course_number[0]['safe_value']);
    ?>

  </div>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($name);
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
