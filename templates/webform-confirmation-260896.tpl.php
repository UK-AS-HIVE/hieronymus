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
$duedate = 'February 15, 2015 12:00am';

$name = $submission->data[1][0];

$cost = 0;
switch ($submission->data[4][0]) {
  case 'regular':
    $cost = strtotime($duedate) > time() ? 85 : 100;
    break;
  case 'grad':
    $cost = 25;
    break;
  case 'undergrad':
    $cost = 15;
    break;
}

foreach (array('banquet' => 55, 'lunch' => 20, 'tour' => 35,) as $event => $price) {
  if (in_array($event, $submission->data[5])) {
    $cost += $price;
  }
}

switch ($submission->data[10][0]) {
  case 'life':
    $cost += 200;
    break;
  case 'over40k':
    $cost += 20;
    break;
  case 'under40k':
    $cost += 10;
    break;
  case 'student':
    $cost += 5;
    break;
}

switch ($submission->data[11][0]) {
  case 'life':
    $cost += 300;
    break;
  case 'regular':
    $cost += 30;
    break;
  case 'student':
    $cost += 10;
    break;
  case 'joint':
    $cost += 35;
    break;
  case 'international':
    $cost += 10;
    break;
}

?>

<div class="webform-confirmation">
  <p>Thank you for registering! Your total cost will be $<?php print $cost; ?>.</p>
  <?php if ($submission->data[13][0] != 'credit'): ?>
      <h2>Pay by Credit Card</h2>
      <p>Make registration checks payable to: <strong>University of Kentucky</strong></p>
      <p>Make annual dues checks payable to: <strong>SCSS</strong> or <strong>AWSS</strong></p>
      <p>Mail to:<br>Karen Petrone<br/>Department of History<br/>University of Kentucky<br/>1713 Patterson Office Tower<br/>Lexington, KY 40506-0027</p>
  <?php else: ?>
      <h2>Pay by Credit Card</h2>
      <p>To complete your registration please click below on "Complete Online Payment" to pay by credit card.</p>
       - Registration closed -

      <p><em>Your registration is not complete until your payment is received.</em></p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>
