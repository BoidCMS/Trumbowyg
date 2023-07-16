<?php defined( 'App' ) or die( 'BoidCMS' );
/**
 *
 * Trumbowyg – WYSIWYG editor
 *
 * @package Plugin_Trumbowyg
 * @author Shuaib Yusuf Shuaib
 * @version 1.0.0
 */

// Ensure the plugin is installed properly
if ( 'trumbowyg' !== basename( __DIR__ ) ) return;

global $App;
$App->set_action( 'admin_head', 'trumbowyg_style' );
$App->set_action( 'admin_end', 'trumbowyg_script' );
$App->set_action( 'slug_taken', 'trumbowyg_slug_taken' );
$App->set_action( 'render', 'trumbowyg_ajax_render' );

/**
 * Editor style import
 * @return string
 */
function trumbowyg_style(): string {
  return ( ! trumbowyg_allowed() ) ? '' : '
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/table/ui/trumbowyg.table.min.css" integrity="sha512-qIa+aUEbRGus5acWBO86jFYxOf4l/mfgb30hNmq+bS6rAqQhTRL5NSOmANU/z5RXc3NJ0aCBknZi6YqD0dqoNw==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/ui/trumbowyg.colors.min.css" integrity="sha512-vw0LMar38zTSJghtmUo0uw000TBbzhsxLZkOgXZG+U4GYEQn+c+FmVf7glhSZUQydrim3pI+/m7sTxAsKhObFA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <style>@media(max-width:600px){.trumbowyg-box{width:100%!important}}.trumbowyg-box{width:60%;margin:auto;margin-bottom:.5em;text-align:left;font-family:Helvetica,Verdana,sans-serif}.trumbowyg-box.trumbowyg-fullscreen,#content{width:100%}table{margin-bottom:1.5em}td,th{height:calc(4px*2 + 1.5em);min-width:calc(8px*2);padding:4px 8px;border:1px solid #e7eaec}</style>';
}

/**
 * Editor script import
 * @return string
 */
function trumbowyg_script(): string {
  return ( ! trumbowyg_allowed() ) ? '' : '
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/preformatted/trumbowyg.preformatted.min.js" integrity="sha512-jbGHfPlSvCf9wKx1/E61iNL+MbzEYB4PKwjlEWfZzHzfThYGqPtNdGNOu0NlxLoQdGt6Vq7PVQXJVtrtNXUy8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/table/trumbowyg.table.min.js" integrity="sha512-StAj4jlQaB7+Ch81cZyms1l21bLyLjjI6YB2m2UP0cVv6ZEKs5egZYhLTNBU96SylBJEqBquyaAUfFhVUrX20Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/history/trumbowyg.history.min.js" integrity="sha512-v0d9RCXjipJ+kkx668PzRjCyAnP75ACp7Bj244PObN+zLIYUtC+bfc3xT+vQhcOrwrRvHON9Ji1dEDzVCx7h4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/upload/trumbowyg.upload.min.js" integrity="sha512-0Ax7SrxNwOb0s4mFVC5Vvn1wC6ts8ysma0OyNsXEXjygtnirRYF9Eg5Z1FPfXyoVRpsslvY/AQgoBY9u4sZKSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/base64/trumbowyg.base64.min.js" integrity="sha512-A8j9MYuFLKhqYNm+ZsylHQY7ah/fqP9ll+93vwjpsuqTs+t3mhzmA7yRkeIK0uscOueIzItaAEkrQmOENQPjCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/insertaudio/trumbowyg.insertaudio.min.js" integrity="sha512-Zsq3EuSmK+mf9Q8UuBs51RwTI9MSUhpiEfpf9jdafZwK9XdTiyVgpJyO12gfa3gbzuGecLExFVOaaVOuRulmyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/noembed/trumbowyg.noembed.min.js" integrity="sha512-nddqNljM+0Sf1ZYdewcP6/xxBH3XXz4m+N4Y57nVgHHePlVWNpXeTMSanARtcFTxHDmajU/huyT0IoPWbc7DOw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/trumbowyg.colors.min.js" integrity="sha512-SHpxBJFbCaHlqGpH13FqtSA+QQkQfdgwtpmcWedAXFCDxAYMgrqj9wbVfwgp9+HgIT6TdozNh2UlyWaXRkiurw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/resizimg/trumbowyg.resizimg.min.js" integrity="sha512-JZOoRxJ64e6kEmiOlPvfvwVHstNxfQkncJUAKUoWfUd20tyGijKV658KH0d2hgmcw0vBPNsGqu/QBs17La+nnA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>$("#content, .editable").trumbowyg(' . trumbowyg_object() . ');</script>';
}

/**
 * Taken slug
 * @return string
 */
function trumbowyg_slug_taken(): string {
  global $App;
  return sprintf( ',trumbowyg/%s,', $App->token() );
}

/**
 * Trumbowyg upload ajax
 * @return void
 */
function trumbowyg_ajax_render(): void {
  global $App;
  $slug = ( 'trumbowyg/' . $App->token() );
  if ( $slug === $App->page ) {
    header( 'Content-Type: application/json' );
    if ( 'POST' !== $_SERVER[ 'REQUEST_METHOD' ] ) {
      exit( '{"file":null,"success":false}' );
    }
    $response = array();
    $success = $App->upload_media( basename: $file );
    $response[ 'file' ] = ( $file ? $App->url( 'media/' . $file ) : null );
    $response[ 'success' ] = $success;
    exit( json_encode( $response ) );
  }
}

/**
 * Tells whether Trumbowyg is needed
 * @return bool
 */
function trumbowyg_allowed(): bool {
  global $App, $page;
  if ( ! $App->logged_in ) return false;
  $pages = array( 'settings', 'create', 'update' );
  $pages = $App->_l( 'editable_pages', $pages );
  return in_array( $page, $pages );
}

/**
 * Trumbowyg options
 * @return string
 */
function trumbowyg_object(): string {
  global $App;
  $option = array();
  $option[ 'autogrowOnEnter' ] = true;
  $option[ 'imageWidthModalEdit' ] = true;
  
  // Button pane
  $option[ 'btns' ] = array();
  $option[ 'btns' ][] = [ 'viewHTML' ];
  $option[ 'btns' ][] = [ 'historyUndo', 'historyRedo' ];
  $option[ 'btns' ][] = [ 'format' ];
  $option[ 'btns' ][] = [ 'strong', 'em', 'del' ];
  $option[ 'btns' ][] = [ 'superscript', 'subscript' ];
  $option[ 'btns' ][] = [ 'foreColor', 'backColor' ];
  $option[ 'btns' ][] = [ 'link' ];
  $option[ 'btns' ][] = [ 'image' ];
  $option[ 'btns' ][] = [ 'insertAudio', 'noembed' ];
  $option[ 'btns' ][] = [ 'table', 'tableCellBackgroundColor', 'tableBorderColor' ];
  $option[ 'btns' ][] = [ 'align' ];
  $option[ 'btns' ][] = [ 'unorderedList', 'orderedList' ];
  $option[ 'btns' ][] = [ 'horizontalRule' ];
  $option[ 'btns' ][] = [ 'removeformat' ];
  $option[ 'btns' ][] = [ 'fullscreen' ];
  
  $option[ 'btnsDef' ] = array();
  $option[ 'btnsDef' ][ 'image' ] = array();
  $option[ 'btnsDef' ][ 'image' ][ 'dropdown' ] = array();
  $option[ 'btnsDef' ][ 'image' ][ 'dropdown' ][] = 'insertImage';
  $option[ 'btnsDef' ][ 'image' ][ 'dropdown' ][] = 'base64';
  $option[ 'btnsDef' ][ 'image' ][ 'dropdown' ][] = 'upload';
  $option[ 'btnsDef' ][ 'image' ][ 'ico' ] = 'insertImage';
  
  $option[ 'btnsDef' ][ 'format' ] = array();
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ] = array();
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'p';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'preformatted';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'blockquote';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h1';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h2';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h3';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h4';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h5';
  $option[ 'btnsDef' ][ 'format' ][ 'dropdown' ][] = 'h6';
  $option[ 'btnsDef' ][ 'format' ][ 'ico' ] = 'p';
  
  $option[ 'btnsDef' ][ 'align' ] = array();
  $option[ 'btnsDef' ][ 'align' ][ 'dropdown' ] = array();
  $option[ 'btnsDef' ][ 'align' ][ 'dropdown' ][] = 'justifyLeft';
  $option[ 'btnsDef' ][ 'align' ][ 'dropdown' ][] = 'justifyCenter';
  $option[ 'btnsDef' ][ 'align' ][ 'dropdown' ][] = 'justifyRight';
  $option[ 'btnsDef' ][ 'align' ][ 'dropdown' ][] = 'justifyFull';
  $option[ 'btnsDef' ][ 'align' ][ 'ico' ] = 'justifyLeft';
  
  // Plugins
  $option[ 'plugins' ] = array();
  $option[ 'plugins' ][ 'upload' ] = array();
  $option[ 'plugins' ][ 'upload' ][ 'serverPath' ] = $App->url( 'trumbowyg/' . $App->token() );
  $option[ 'plugins' ][ 'upload' ][ 'fileFieldName' ] = 'file';
  $option[ 'plugins' ][ 'upload' ][ 'imageWidthModalEdit' ] = true;
  
  $option = $App->get_filter( $option, 'trumbowyg_option' );
  return json_encode( $option );
}
?>
