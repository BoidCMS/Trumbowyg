<?php defined( 'App' ) or die( 'BoidCMS' );
/**
 *
 * Trumbowyg
 *
 * @package BoidCMS
 * @subpackage Trumbowyg
 * @author Shoaiyb Sysa
 * @version 1.0.0
 */

global $App;
$App->set_action( 'admin_head', 'trumbowyg_style' );
$App->set_action( 'admin_end', 'trumbowyg_script' );

/**
 * Editor style
 * @return string
 */
function trumbowyg_style(): string {
  if ( ! trumbowyg_allowed() ) {
    return '';
  }
  return '
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.2/dist/ui/trumbowyg.min.css" integrity="sha256-vQMN/vO+6qqmEYSvMl6sA0mxN2elc7GaeWghYw0KYsg=" crossorigin="anonymous">
  <style type="text/css">@media(max-width:600px){.trumbowyg-box{width:100%!important}}.trumbowyg-box{width:60%;margin:auto;text-align:left}.trumbowyg-box.trumbowyg-fullscreen{width:100%}</style>';
}

/**
 * Trumbowyg import
 * @return string
 */
function trumbowyg_script(): string {
  global $App;
  if ( ! trumbowyg_allowed() ) {
    return '';
  }
  return '
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.2/dist/trumbowyg.min.js" integrity="sha256-jQQQdUjo21bhs9Gms7raWQJ094BPYk5FN6U5VAXJrhA=" crossorigin="anonymous"></script>
  <script type="text/javascript">$("' . $App->_( '#content', 'trumbowyg' ) . '").trumbowyg({' . trumbowyg_obj() . '});</script>';
}

/**
 * Tells whether Trumbowyg is needed
 * @return bool
 */
function trumbowyg_allowed(): bool {
  global $App, $page;
  $pages = array( 'create', 'update' );
  $pages = $App->_l( 'editable_pages', $pages );
  return in_array( $page, $pages );
}

/**
 * Trumbowyg options
 * @return string
 */
function trumbowyg_obj(): string {
  global $App;
  $options = $App->_l( 'trumbowyg',
    array(
      'resetCss:true',
      'autogrowOnEnter:true',
      'imageWidthModalEdit:true'
    )
  );
  $obj = implode( ',', $options );
  return $obj;
}
?>
