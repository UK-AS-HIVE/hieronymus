<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $confirmation_message: The confirmation message input by the webform author.
 * - $sid: The unique submission ID of this submission.
 */
module_load_include('inc', 'webform', 'includes/webform.submissions');
$submission = webform_get_submission($node->nid, $sid);
$account = user_load($submission->uid);
$duedate = 'March 11, 2015 12:00am';

$name = $submission->data[1][0];

$cost = 0;
$sentence = 'The cost for one ';
switch ($submission->data[2][0]) {
  case 'st':
    $cost = strtotime($duedate) > time() ? 0 : 50;
    if ($submission->data[14][0] == 'yes') $cost -= 50;
    $sentence .= 'student admission ';
    break;
  default:
    $cost = strtotime($duedate) > time() ? 80 : 130;
    $sentence .= 'regular admission ';
    break;
}

if ($submission->data[14][0] == 'yes') {
  $cost += 50;
  $sentence .= 'with banquet ';
}
else {
  $sentence .= 'without banquet ';
}
if (!empty($submission->data[15][0])) {
  $cost += (50 * $submission->data[15][0]);
  $sentence .= 'and ' . $submission->data[15][0] . ' guests ';
}

$sentence .= 'is $' . $cost . '.';

?>

<div class="webform-confirmation">
  <p>Thank you for registering! <?php print $sentence; ?></p>
  <?php if ($cost > 0): ?>
    <h2>Pay by Credit Card</h2>
    <p> - Event completed, payment closed - </p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>
