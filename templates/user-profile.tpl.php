<?php
// $Id: user-profile.tpl.php,v 1.13 2010/01/08 07:04:09 webchick Exp $

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($content['field_example']). Always call render($user_profile)
 * at the end in order to print all remaining items. If the item is a category,
 * it will contain all its profile items. By default, $user_profile['summary']
 * is provided which contains data on the user's history. Other data can be
 * included by modules. $user_profile['user_picture'] is available
 * for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $user->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $user->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */
?>
<section class="profile"<?php print $attributes; ?>>
	
    <header class="profile-main">
		<?php
			print render($user_profile['field_research_interests']);
		?>
	</header>
	
	
	<div class="profile-body clearfix">
	<?php
		print render($user_profile['field_profile_block']);
		print render($user_profile['field_selected_publications']);

		global $user;
		$current_path = reset(drupal_get_destination());
		$uid = array_pop(preg_split('/\//', $current_path));

	
	if (!empty($user_profile['field_pubmed']) ):  ?>
		<div>
			<div class="field field-name-field-selected-publications field-type-text-with-summary field-label-above">
				<div class="field-label">PubMed Publications*:&nbsp;</div>
			</div>
			<?php 
			  
			  
			  $permit = ($uid == $user->uid || in_array('administrator', $user->roles) || in_array('content moderator', $user->roles));
			  $page = $permit ? 'page_1' : 'page'; //Page_1 includes the show/hide button for biblio nodes
			  print views_embed_view('user_pubmed_publications', $page, array($uid));
			  print '<div class="pubmed-notice"><em>* Publications are automatically pulled from pubmed.gov based on a user-specific query.  Results may include incorrect citations.  See: <a href="http://www.as.uky.edu/tutorials/importing-pubmed-publications">Tutorial on improving PubMed results.</em></div>';
			  if($permit) {
			    print views_embed_view('user_pubmed_publications', 'page_2', array($uid));
			  }
				
			?>
		</div>
	<?php endif; ?>
	</div>
		
	<?  
    //Profile Extras
    print views_embed_view('profile_extras_main_body', 'block', array($uid));
	?>

</section>

