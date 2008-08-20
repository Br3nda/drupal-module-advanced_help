<?php
// $Id: template.php,v 1.1.2.1 2008/08/20 00:18:18 ff1 Exp $

function phptemplate_advanced_help_popup($content) {
  // Add favicon.
  if (theme_get_setting('toggle_favicon')) {
    drupal_set_html_head('<link rel="shortcut icon" href="'. check_url(theme_get_setting('favicon')) .'" type="image/x-icon" />');
  }

  global $theme;
  // Construct page title.
  if (drupal_get_title()) {
    $head_title = array(strip_tags(drupal_get_title()), variable_get('site_name', 'Drupal'));
  }
  else {
    $head_title = array(variable_get('site_name', 'Drupal'));
    if (variable_get('site_slogan', '')) {
      $head_title[] = variable_get('site_slogan', '');
    }
  }

  drupal_add_css(drupal_get_path('module', 'advanced_help') .'/help-popup.css');
  drupal_add_css(drupal_get_path('module', 'advanced_help') .'/help.css');

  $variables['head_title']        = implode(' | ', $head_title);
  $variables['base_path']         = base_path();
  $variables['front_page']        = url();
  $variables['breadcrumb']        = theme('breadcrumb', drupal_get_breadcrumb());
  $variables['feed_icons']        = drupal_get_feeds();
  $variables['head']              = drupal_get_html_head();
  $variables['language']          = $GLOBALS['language'];
  $variables['language']->dir     = $GLOBALS['language']->direction ? 'rtl' : 'ltr';
  $variables['logo']              = theme_get_setting('logo');
  $variables['messages']          = theme('status_messages');
  $variables['site_name']         = (theme_get_setting('toggle_name') ? variable_get('site_name', 'Drupal') : '');
  $variables['css']               = drupal_add_css();
  $css = drupal_add_css();

  // Remove theme css.
  foreach ($css as $media => $types) {
    if (isset($css[$media]['theme'])) {
      $css[$media]['theme'] = array();
    }
  }

  $variables['styles']            = drupal_get_css($css);
  $variables['scripts']           = drupal_get_js();
  $variables['title']             = drupal_get_title();
  $variables['content']           = $content;

  // Closure should be filled last.
  $variables['closure']           = theme('closure');

  return _phptemplate_callback('advanced-help-popup', $variables);
}