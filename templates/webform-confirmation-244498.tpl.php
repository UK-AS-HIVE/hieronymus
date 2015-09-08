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

$name = array();
foreach (array(4, 5, 6) as $key) {
  if (!empty($submission->data[$key][0])) {
    $name[] = $submission->data[$key][0];
  }
}
?>


<div class="webform-confirmation">
  <?php if ($submission->data[41][0] == 'yes'): ?>
    <p>Thank you for registering! Students that qualify for financial aid will not need to pay to participate in StemCats. If you have any questions, please contact <a href="mailto:jessica.pennington@uky.edu">Jessica.Pennington@uky.edu</a>.</p>
  <?php else: ?>
    <p>Thank you for registering! Your total cost will be $99.</p>
      <h2>Pay by Credit</h2>
      To complete your registration please click below on "Complete Online Payment" to pay by credit card.<br/>
      <form name="SkipjackVposGenerator" method="post" action="https://payments.skipjack.com/FormBuilder/VPOS.aspx">
        <input type="hidden" name="VposContent" value="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">
        <input type="hidden" name="studentid" value="<?php print $submission->data[2][0]; ?>"/>
        <input type="hidden" name="studentname" value="<?php print implode(' ', $name) ?>"/>
        <input type="hidden" name="email" value="<?php print $submission->data[12][0]; ?>"/>
        <input type="hidden" name="confid" value="<?php print $submission->data[43][0]; ?>"/>
        <input type="submit" name="DonateButton" value="Complete Online Payment" >
      </form>
      <h2>Pay by Check</h2>
      <p>Make check payable to the <strong>University of Kentucky</strong> and mail to:<br/>
      202 Patterson Office Tower<br/>
      Lexington, KY. 40506-0027<br/></p>
      <em>Your registration is not complete until your payment is received.</em>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>