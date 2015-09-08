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
    <p>Thank you for registering! Your total cost will be $300.</p>
    <?php if ($submission->data[36][0] != 'ccard'): ?>
      Make check payable to the <strong>University of Kentucky</strong> and mail to:<br/>
      202 Patterson Office Tower<br/>
      Lexington, KY. 40506-0027<br/><br/>
      <em>Your registration is not complete until your check is received.</em>
    <?php else: ?>
      To complete your registration please click below on "Complete Online Payment" to pay by credit card.<br/>
      <form name="SkipjackVposGenerator" method="post" action="https://payments.skipjack.com/FormBuilder/VPOS.aspx">
        <input type="hidden" name="VposContent" value="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">
        <input type="hidden" name="studentid" value="<?php print $submission->data[2][0]; ?>"/>
        <input type="hidden" name="studentname" value="<?php print implode(' ', $name) ?>"/>
        <input type="hidden" name="email" value="<?php print $submission->data[12][0]; ?>"/>
        <input type="hidden" name="confid" value="STEMCATS"/>
        <input type="submit" name="DonateButton" value="Complete Online Payment" >
      </form>
    <?php endif; ?>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>