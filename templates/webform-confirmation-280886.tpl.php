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

$name = $submission->data[4][0];

$cost = $submission->data[16][0];
$sentence = '';


if ($submission->data[17][0] != 'na') {
  $cost += $submission->data[17][0];
}

?>

<div class="webform-confirmation">
  <p>Thank you! Your total cost is $<?php print $cost; ?>.</p>
  <?php if ($submission->data[18][0] != 'check'): ?>
    <h2>Pay by Credit Card</h2>
    <p>To complete your registration please click below on "Complete Online Payment" to pay by credit card.</p>
    <p> - event completed, payment disabled -</p>
    <p><em>Your registration is not complete until your payment is received</em></p>
  <?php else: ?>
    <h2>Pay by Check</h2>
    <p>Make checks payable to: University of Kentucky</p>

<p>Mail to:</p>

<p>Arnold J. Stromberg<br/>
Department of Statistics<br/>
University of Kentucky<br/>
313 Multidisciplinary Science Building<br/>
725 Rose Street<br/>
Lexington, KY 40536-0082</p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>
