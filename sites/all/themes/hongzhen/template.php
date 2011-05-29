<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can modify or override Drupal's theme
 *   functions, intercept or make additional variables available to your theme,
 *   and create custom PHP logic. For more information, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to hongzhen_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: hongzhen_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override either of the two theme functions used in Zen
 *   core, you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function hongzhen_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function hongzhen_preprocess_page(&$variables, $hook) {
  // Find the title of the menu used by the main links.
  $main_links = variable_get('menu_main_links_source', 'main-menu');
  if ($main_links) {
    $menus = function_exists('menu_get_menus') ? menu_get_menus() : menu_list_system_menus();
    $variables['main_menu_heading'] = $menus[$main_links];
  }
  else {
    $variables['main_menu_heading'] = '';
  }
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function hongzhen_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // hongzhen_preprocess_node_page() or hongzhen_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function hongzhen_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function hongzhen_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  $variables['classes_array'][] = 'count-' . $variables['block_id'];
}
// */

function hongzhen_menu_tree__menu_block__1($variables) {
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/menu-block-1.js', array('group' => JS_THEME));

  $output = '';
  $output .= '<ul class="menu">' . $variables['tree'] . '</ul>';
  
  return $output;
}

function hongzhen_menu_link__menu_block__1($variables) {
  $element = $variables['element'];
  
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  } else {
    $sub_menu = '';
  }

  $output = '';
  $output .= '<li' . drupal_attributes($element['#attributes']) . '>';
  $output .= l($element['#title'], $element['#href'], $element['#localized_options']);
  $output .= $sub_menu;
  $output .= '</li>';
  
  return $output;
}

function hongzhen_menu_tree__menu_block__2($variables) {
  drupal_add_css(drupal_get_path('theme', 'hongzhen') . '/css/superfish.css', array('group' => CSS_THEME));
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/superfish.js', array('group' => JS_THEME));
//  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/hoverIntent.js', array('group' => JS_THEME));
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/menu-block-2.js', array('group' => JS_THEME));
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/jquery.easing.1.3.js', array('group' => JS_THEME));
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/jquery.mousewheel.min.js', array('group' => JS_THEME));
  drupal_add_js(drupal_get_path('theme', 'hongzhen') . '/jscripts/jquery.slidingtabs.pack.js', array('group' => JS_THEME));
  
  $output = '';
  $output .= '<ul class="menu">' . $variables['tree'] . '</ul>';

  return $output;
}

function hongzhen_menu_link__menu_block__2($variables) {
  $element = $variables['element'];

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  } else {
    $sub_menu = '';
  }
  
  $output = '';
  $output .= '<li' . drupal_attributes($element['#attributes']) . '>';
  $output .= '<div class="menu-block-2-a menu-block-2-a-prefix"></div>';
  $output .= l($element['#title'], $element['#href'], $element['#localized_options']);
  $output .= $sub_menu;
  $output .= '<div class="menu-block-2-a menu-block-2-a-surfix"></div>';
  $output .= '</li>';
  
  return  $output;
}

function hongzhen_file_icon($variables) {
  $file = $variables['file'];
  $icon_directory = "sites/all/themes/hongzhen/icons";

  $mime = check_plain($file->filemime);
  $icon_url = file_icon_url($file, $icon_directory);
  return '<img class="file-icon" alt="" title="' . $mime . '" src="' . $icon_url . '" />';
}

function hongzhen_locationmap_block_image_link() {
  return(l('<img src="' . locationmap_static_image_url(300, 250) . '" alt="Location map" />', 'locationmap', array('html' => TRUE)));
}
