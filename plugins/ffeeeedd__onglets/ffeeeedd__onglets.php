<?php
/**
 * Plugin Name: ffeeeedd__onglets
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__onglets
 * Description: Ajout et gestion d’un shortcode pour créer une boîte à onglets accessible.
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if (!defined('ABSPATH')) die();

/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__onglets_init() {
  load_plugin_textdomain( 'ffeeeedd__onglets', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__onglets_init' );


/* == @section Création des shortcodes ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */
function ffeeeedd__shortcode__onglets( $atts, $content = null ) {
  return '<div
    data-function="tabs"
    class="ffeeeedd__onglets">' . do_shortcode( $content ) . '
  </div>';
}
add_shortcode( 'onglets', 'ffeeeedd__shortcode__onglets' );

function ffeeeedd__shortcode__onglet( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'titre' => 'Titre manquant',
  ), $atts ) );
  $label = sanitize_html_class( sanitize_title( strtolower( $titre ) ) );
  return '<h3
    data-role="tab"
    class="inbl h6-like m-reset"
    id="' . esc_attr( $label ) . '-titre"
    data-controls="' . esc_attr( $label ) . '">' . $titre . '
  </h3>
  <div
    data-role="panel"
    data-label="' . esc_attr( $label ) . '-titre"
    id="' . esc_attr( $label ) . '"
    class="w-100">
      <div class="pa1">' . do_shortcode( $content ) . '</div>
  </div>';
}
add_shortcode( 'onglet', 'ffeeeedd__shortcode__onglet' );


/* == @section Injection du javascript ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */

function ffeeeedd__onglets() {
  wp_enqueue_script(
    'simple-tabs',
    plugins_url( 'js/jquery.simple-tabs.min.js', __FILE__ ),
    array( 'jquery' ),
    null,
    true
  );
}
add_action( 'wp_enqueue_scripts', 'ffeeeedd__onglets' );
