<?php
/**
 * Template: Taxonomy – categoria_vehiculo
 * Redirige a la home con el parámetro ?cat=<slug> para que main.js
 * abra automáticamente el modal de esa categoría de vehículo.
 */

$term = get_queried_object();

if ( $term && ! is_wp_error( $term ) ) {
    $redirect_url = add_query_arg( 'cat', sanitize_key( $term->slug ), home_url( '/' ) );
    $redirect_url .= '#vehiculos';
} else {
    $redirect_url = home_url( '/#vehiculos' );
}

wp_redirect( esc_url_raw( $redirect_url ), 302 );
exit;
