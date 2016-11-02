<div id="page-wrapper"><div id="page">
  <div id="shadow"></div>
    <link rel="stylesheet" href="/sites/all/themes/hieronymus/css/patterns.css">
    <div class="uk-global-header">
      <div class="uk-search-bar" aria-hidden="true" id="uk-global-header-searchbar">

        <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
          <symbol id="x" Viewbox="-110.7 118.8 23.3 23.3">
            <path d="M-87.3 121l-2.2-2.2-9.5 9.6-9.5-9.6-2.2 2.2 9.6 9.5-9.6 9.5 2.2 2.2 9.5-9.6 9.5 9.6 2.2-2.2-9.6-9.5"></path>
          </symbol><!--end x-->
        </svg>
        <div class="uk-search-bar__container">
          <div class="uk-search-bar__row">

            <div class="uk-search-bar__menu">
              <a href="http://www.uky.edu/Directory/" class="uk-search-bar__menu-item">People</a>
              <a href="http://maps.uky.edu/campusmap/" class="uk-search-bar__menu-item">Map</a>
            </div>


            <div class="uk-search-bar__form">
              <form action="http://ukcc.uky.edu/cse/">
                <input class="uk-search-bar__input" type="search" name="q" placeholder="search uky.edu">
                <input  class="uk-search-bar__submit" type="submit" value="Search">
              </form>

              <button type="button" title="Close" class="uk-search-bar__dismiss">
                <svg height="30px" width="30px"><use xlink:href="#x"></use></svg>
                <span class="hide">Close</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
        <symbol id="search" viewBox="0 0 16.7 16.8">
        <path d="M9.7 0c-3.9 0-7 3.1-7 7 0 1.6.5 3.1 1.4 4.2L0 15.4l1.4 1.4 4.2-4.2c1.2.9 2.6 1.4 4.1 1.4 3.9 0 7-3.1 7-7s-3.1-7-7-7zm0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z" class="st0"></path>
        </symbol>
      </svg>

      <header>

        <div class="uk-global-header__logo">
          <a href="http://www.as.uky.edu">
            <img src="/sites/all/themes/hieronymus/images/uk-as-white.png" alt="University of Kentucky Logo"/>
          </a>
        </div>

        <div class="uk-global-header__left-nav">

        </div>

        <div class="uk-global-header__right-nav">
          <ul class="uk-global-header__nav-list">
            <li class="uk-global-header__nav-item uk-global-header__myUK"><a href="https://myuk.uky.edu">myUK</a></li>
            <li class="uk-global-header__nav-item uk-global-header__search-button">
              <button aria-expanded="false" aria-controls="uk-global-header-searchbar">
                <svg>
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use>
                </svg>
              </button>
            </li>
          </ul>
        </div>
        <script type="text/javascript" src="/sites/all/themes/hieronymus/js/all.js"></script>
      </header>
    </div>
  
  <div id="header" class="block-wrapper restricted-width <?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>">
    <div class="width-container clearfix">
      <div class="content-wrapper table">
        <div class="table-row">

          <div class="table-cell middle logo-cell">
            <?php print views_embed_view('redesign_site_logo', 'block'); ?>
          </div>

          <div class="table-cell middle header-region-cell">
            <?php print render($page['header']); ?>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- /.section, /#header -->


  <?php print render($page['navigation']); ?>

  <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>

  <?php if ($page['featured']): ?>
    <div id="featured" style="text-align: left;"><div class="section clearfix">
      <?php print render($page['featured']); ?>
    </div></div> <!-- /.section, /#featured -->
  <?php endif; ?>

  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix">

    <div id="content" class="column"><div class="section">
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>

      <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
	  <?php 
	    $get = $_GET;
	    $mPath = url($get['q'], array('absolute' => TRUE));
	    unset($get['q']);
	    $url_args = array();
	    foreach($get as $var => $value)
	      $url_args[] = $var . '=' . $value;
	    if(!empty($url_args))
	      $mPath .= '?' . implode('&', $url_args);
	    $mTitle = $title;
	    global $base_url;
	      print '<div class="sharethis-wrapper"><span class="share-text">Share this page: </span>
	      <div class="share-mail"><a title="mail" alt="mail" href="mailto:?subject=' . str_replace('+', ' ', urlencode($mTitle . ' - College of Arts & Sciences, University of Kentucky')) . '&body=' . urlencode($mPath) . '">
		<img src="' . $base_url . '/' . drupal_get_path('theme', 'hieronymus') . '/images/social/node/social-email.png"/>
	      </a></div>
	      <div class="share-facebook"><a title="facebook" alt="facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode($mPath) . '&t=' . urlencode($mTitle) . '" target="_blank">
		<img src="' . $base_url . '/' . drupal_get_path('theme', 'hieronymus') . '/images/social/node/facebook.png"/>
	      </a></div>
	      <div class="share-twitter"><a title="twitter" alt="twitter" href="https://twitter.com/intent/tweet?url=' . urlencode($mPath) . '&text=' . urlencode($mTitle) . '" target="_blank">
		<img src="' . $base_url . '/' . drupal_get_path('theme', 'hieronymus') . '/images/social/node/twitter-2.png"/>
	      </a></div>
	      </div>';
	    ?>
        </h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>

    </div></div> <!-- /.section, /#content -->
    
    <?php if ($page['sidebar']): ?>
      <div id="sidebar" class="column sidebar"><div class="section">
        <?php print render($page['sidebar']); ?>
      </div></div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>

  </div></div> <!-- /#main, /#main-wrapper -->

  <div id="footer-wrapper"><div class="section">

    <?php if ($page['footer_buttons']): ?>
      <div id="footer-buttons" class="clearfix">
        <?php print render($page['footer_buttons']); ?>
      </div> <!-- /#footer buttons-->
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="footer" class="clearfix">
        <?php print render($page['footer']); ?>
        <div class="uk-footer-text">
          <ul class="uk-footer-text__list">
            <li class="uk-footer-text__list-item">&copy; University of Kentucky</li>
            <!--<li class="uknow-footertext__list-item">Lexington, Kentucky 40506</li>-->
            <li class="uk-footer-text__list-item">An Equal Opportunity University</li>
            <li class="uk-footer-text__list-item"><a href="http://www.uky.edu/accreditation/">Accreditation</a></li>
            <li class="uk-footer-text__list-item"><a href="http://www.uky.edu/Directory/">Directory</a></li>
          </ul>
        </div>
      </div> <!-- /#footer -->
    <?php endif; ?>

  </div></div> <!-- /.section, /#footer-wrapper -->

</div></div> <!-- /#page, /#page-wrapper -->

<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
?>
